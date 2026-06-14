<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\DosenAccountController;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('dosen.dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dosen.dashboard');
        }

        // HITUNG DOSEN DARI AKUN USER, BUKAN DARI TABEL JOURNALS
        $totalDosen = User::where('role', 'dosen')->count();

        // HITUNG JURNAL TETAP DARI TABEL JOURNALS
        $totalJurnal = Journal::count();
        $pending = Journal::where('status', 'Menunggu')->count();
        $accepted = Journal::where('status', 'Diterima')->count();
        $rejected = Journal::where('status', 'Ditolak')->count();

        $recentJournals = Journal::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalDosen',
            'totalJurnal',
            'pending',
            'accepted',
            'rejected',
            'recentJournals'
        ));
    })->name('admin.dashboard');

    Route::get('/admin/settings', [AuthController::class, 'settings'])->name('admin.settings');
    Route::put('/admin/settings', [AuthController::class, 'updateSettings'])->name('admin.settings.update');

    Route::get('/admin/lecturers', [DosenAccountController::class, 'index'])->name('admin.lecturers');
    Route::post('/admin/lecturers', [DosenAccountController::class, 'store'])->name('admin.lecturers.store');
    Route::put('/admin/lecturers/{user}', [DosenAccountController::class, 'update'])->name('admin.lecturers.update');
    Route::delete('/admin/lecturers/{user}', [DosenAccountController::class, 'destroy'])->name('admin.lecturers.destroy');

    Route::get('/admin/reports', [JournalController::class, 'reports'])->name('admin.reports');

    Route::get('/admin/journals', [JournalController::class, 'index'])->name('admin.journals');
    Route::get('/admin/journals/create', [JournalController::class, 'create'])->name('admin.journals.create');
    Route::post('/admin/journals', [JournalController::class, 'store'])->name('admin.journals.store');

    Route::get('/admin/journals/{journal}/edit', [JournalController::class, 'edit'])->name('admin.journals.edit');
    Route::put('/admin/journals/{journal}', [JournalController::class, 'update'])->name('admin.journals.update');

    Route::get('/admin/journals/{journal}', [JournalController::class, 'show'])->name('admin.journals.show');
    Route::patch('/admin/journals/{journal}/accept', [JournalController::class, 'accept'])->name('admin.journals.accept');
    Route::patch('/admin/journals/{journal}/reject', [JournalController::class, 'reject'])->name('admin.journals.reject');
    Route::delete('/admin/journals/{journal}', [JournalController::class, 'destroy'])->name('admin.journals.destroy');

    Route::get('/dosen/dashboard', [JournalController::class, 'dosenDashboard'])->name('dosen.dashboard');
    Route::get('/dosen/journals/create', [JournalController::class, 'dosenCreate'])->name('dosen.journals.create');
    Route::post('/dosen/journals', [JournalController::class, 'dosenStore'])->name('dosen.journals.store');
});