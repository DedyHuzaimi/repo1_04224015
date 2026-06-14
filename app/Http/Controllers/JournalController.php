<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $query = Journal::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('nama_dosen', 'like', '%' . $request->search . '%')
                ->orWhere('program_studi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $journals = $query->latest()->get();

        $years = Journal::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.journals', compact('journals', 'years'));
    }

    public function create()
    {
        return view('admin.journal-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'nullable|string|max:50',
            'program_studi' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'nama_jurnal' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'file_jurnal' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        $filePath = null;

        if ($request->hasFile('file_jurnal')) {
            $filePath = $request->file('file_jurnal')->store('jurnal', 'public');
        }

        Journal::create([
            'judul' => $request->judul,
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'program_studi' => $request->program_studi,
            'tahun' => $request->tahun,
            'nama_jurnal' => $request->nama_jurnal,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'file_jurnal' => $filePath,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.journals')
            ->with('success', 'Data jurnal berhasil ditambahkan.');
    }

    public function show(Journal $journal)
    {
        return view('admin.journal-detail', compact('journal'));
    }

    public function accept(Journal $journal)
    {
        $journal->update([
            'status' => 'Diterima',
        ]);

        return redirect()->route('admin.journals')
            ->with('success', 'Jurnal berhasil diterima.');
    }

    public function reject(Journal $journal)
    {
        $journal->update([
            'status' => 'Ditolak',
        ]);

        return redirect()->route('admin.journals')
            ->with('success', 'Jurnal berhasil ditolak.');
    }

    

    public function edit(Journal $journal)
    {
        return view('admin.journal-edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
    $request->validate([
        'judul' => 'required|string|max:255',
        'nama_dosen' => 'required|string|max:255',
        'nidn' => 'nullable|string|max:50',
        'program_studi' => 'required|string|max:255',
        'tahun' => 'required|digits:4',
        'nama_jurnal' => 'nullable|string|max:255',
        'kategori' => 'nullable|string|max:255',
        'status' => 'required|string|max:50',
        'file_jurnal' => 'nullable|mimes:pdf,doc,docx|max:5120',
        'keterangan' => 'nullable|string',
    ]);

    $filePath = $journal->file_jurnal;

    if ($request->hasFile('file_jurnal')) {
        if ($journal->file_jurnal && Storage::disk('public')->exists($journal->file_jurnal)) {
            Storage::disk('public')->delete($journal->file_jurnal);
        }

        $filePath = $request->file('file_jurnal')->store('jurnal', 'public');
    }

    $journal->update([
        'judul' => $request->judul,
        'nama_dosen' => $request->nama_dosen,
        'nidn' => $request->nidn,
        'program_studi' => $request->program_studi,
        'tahun' => $request->tahun,
        'nama_jurnal' => $request->nama_jurnal,
        'kategori' => $request->kategori,
        'status' => $request->status,
        'file_jurnal' => $filePath,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('admin.journals')
        ->with('success', 'Data jurnal berhasil diperbarui.');
    }

    public function destroy(Journal $journal)
    {
        if ($journal->file_jurnal && Storage::disk('public')->exists($journal->file_jurnal)) {
            Storage::disk('public')->delete($journal->file_jurnal);
        }

        $journal->delete();

        return redirect()->route('admin.journals')
            ->with('success', 'Data jurnal berhasil dihapus.');
    }

    public function lecturers()
    {
        $lecturers = Journal::select('nama_dosen', 'nidn', 'program_studi')
            ->selectRaw('COUNT(*) as total_jurnal')
            ->groupBy('nama_dosen', 'nidn', 'program_studi')
            ->orderBy('nama_dosen', 'asc')
            ->get();

        return view('admin.lecturers', compact('lecturers'));
    }

    public function reports(Request $request)
    {
        $query = Journal::query();

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program_studi')) {
            $query->where('program_studi', $request->program_studi);
        }

        $journals = $query->latest()->get();

        $years = Journal::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $programs = Journal::select('program_studi')->distinct()->orderBy('program_studi')->pluck('program_studi');

        $totalJurnal = $journals->count();
        $totalDosen = $journals->pluck('nama_dosen')->unique()->count();
        $diterima = $journals->where('status', 'Diterima')->count();
        $ditolak = $journals->where('status', 'Ditolak')->count();
        $menunggu = $journals->where('status', 'Menunggu')->count();

        return view('admin.reports', compact(
            'journals',
            'years',
            'programs',
            'totalJurnal',
            'totalDosen',
            'diterima',
            'ditolak',
            'menunggu'
        ));
    }

    public function dosenDashboard()
    {
        $journals = Journal::where('nama_dosen', auth()->user()->name)
            ->latest()
            ->get();

        $totalJurnal = $journals->count();
        $menunggu = $journals->where('status', 'Menunggu')->count();
        $review = $journals->where('status', 'Review')->count();
        $diterima = $journals->where('status', 'Diterima')->count();
        $ditolak = $journals->where('status', 'Ditolak')->count();

        return view('dosen.dashboard', compact(
            'journals',
            'totalJurnal',
            'menunggu',
            'review',
            'diterima',
            'ditolak'
        ));
    }

    public function dosenCreate()
    {
        return view('dosen.journal-create');
    }

    public function dosenStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nidn' => 'nullable|string|max:50',
            'program_studi' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'nama_jurnal' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'file_jurnal' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        $filePath = null;

        if ($request->hasFile('file_jurnal')) {
            $filePath = $request->file('file_jurnal')->store('jurnal', 'public');
        }

        Journal::create([
            'judul' => $request->judul,
            'nama_dosen' => auth()->user()->name,
            'nidn' => $request->nidn,
            'program_studi' => $request->program_studi,
            'tahun' => $request->tahun,
            'nama_jurnal' => $request->nama_jurnal,
            'kategori' => $request->kategori,
            'status' => 'Menunggu',
            'file_jurnal' => $filePath,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('dosen.dashboard')
            ->with('success', 'Jurnal berhasil diajukan dan menunggu verifikasi admin.');
    }
}