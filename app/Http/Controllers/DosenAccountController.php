<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenAccountController extends Controller
{
    private function ensureAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
    }

    public function index()
    {
        $this->ensureAdmin();

        $dosens = User::where('role', 'dosen')
            ->latest()
            ->get();

        $totalDosen = $dosens->count();

        $jumlahJurnal = $dosens->mapWithKeys(function ($dosen) {
            return [
                $dosen->id => Journal::where('nama_dosen', $dosen->name)->count()
            ];
        });

        return view('admin.lecturers', compact(
            'dosens',
            'totalDosen',
            'jumlahJurnal'
        ));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nidn' => 'nullable|string|max:50',
            'program_studi' => 'nullable|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nidn' => $request->nidn,
            'program_studi' => $request->program_studi,
            'password' => Hash::make($request->password),
            'role' => 'dosen',
        ]);

        return redirect()->route('admin.lecturers')
            ->with('success', 'Akun dosen berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $this->ensureAdmin();

        if ($user->role !== 'dosen') {
            abort(403, 'Akun ini bukan akun dosen.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nidn' => 'nullable|string|max:50',
            'program_studi' => 'nullable|string|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nidn = $request->nidn;
        $user->program_studi = $request->program_studi;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.lecturers')
            ->with('success', 'Akun dosen berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->ensureAdmin();

        if ($user->role !== 'dosen') {
            abort(403, 'Akun ini bukan akun dosen.');
        }

        $user->delete();

        return redirect()->route('admin.lecturers')
            ->with('success', 'Akun dosen berhasil dihapus.');
    }
}