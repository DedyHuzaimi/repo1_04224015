@extends('layouts.admin')

@section('content')
<style>
    .page-header {
        margin-bottom: 26px;
    }

    .page-header h1 {
        font-size: 34px;
        font-weight: 900;
        color: #001f4d;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #64748b;
    }

    .settings-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        align-items: start;
    }

    .settings-panel {
        background: white;
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
    }

    .settings-title {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 26px;
        padding-bottom: 18px;
        border-bottom: 1px solid #e5e7eb;
    }

    .settings-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: #ffd400;
        color: #001f4d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 900;
        flex-shrink: 0;
    }

    .settings-title h3 {
        font-size: 24px;
        font-weight: 900;
        color: #001f4d;
    }

    .settings-title p {
        color: #64748b;
        margin-top: 4px;
    }

    .alert-success {
        background: #dcfce7;
        color: #15803d;
        padding: 14px 18px;
        border-radius: 14px;
        margin-bottom: 20px;
        font-weight: 800;
        border: 1px solid #bbf7d0;
    }

    .error-box {
        background: #fee2e2;
        color: #991b1b;
        padding: 14px 18px;
        border-radius: 14px;
        margin-bottom: 20px;
        border: 1px solid #fecaca;
    }

    .error-box ul {
        margin-left: 20px;
        margin-top: 8px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group.full {
        grid-column: span 2;
    }

    label {
        font-weight: 800;
        color: #001f4d;
        font-size: 14px;
    }

    input {
        width: 100%;
        padding: 14px 16px;
        border-radius: 14px;
        border: 1px solid #d1d5db;
        font-size: 14px;
        outline: none;
        transition: 0.25s;
        background: white;
    }

    input:focus {
        border-color: #003b8f;
        box-shadow: 0 0 0 4px rgba(0, 59, 143, 0.12);
    }

    .note {
        background: #eaf2ff;
        color: #003b8f;
        padding: 14px 16px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        margin-top: 20px;
    }

    .button-area {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-save {
        border: none;
        background: #003b8f;
        color: white;
        padding: 13px 20px;
        border-radius: 14px;
        font-weight: 900;
        cursor: pointer;
        transition: 0.25s;
    }

    .btn-save:hover {
        background: #001f4d;
        transform: translateY(-2px);
    }

    .decor-panel {
        background: linear-gradient(180deg, #003b8f, #001f4d);
        border-radius: 26px;
        padding: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.12);
        min-height: 540px;
    }

    .decor-panel::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 212, 0, 0.25);
        top: -50px;
        right: -50px;
    }

    .decor-panel::after {
        content: "";
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        bottom: -40px;
        left: -40px;
    }

    .decor-content {
        position: relative;
        z-index: 2;
    }

    .decor-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.16);
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 18px;
    }

    .decor-title {
        font-size: 30px;
        font-weight: 900;
        line-height: 1.25;
        margin-bottom: 12px;
    }

    .decor-text {
        color: #dbeafe;
        line-height: 1.8;
        font-size: 14px;
        margin-bottom: 22px;
    }

    .decor-card {
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 20px;
        padding: 18px;
        margin-bottom: 16px;
        backdrop-filter: blur(3px);
    }

    .decor-card h4 {
        font-size: 16px;
        font-weight: 900;
        margin-bottom: 8px;
        color: #ffd400;
    }

    .decor-card p {
        font-size: 13px;
        line-height: 1.7;
        color: #eaf2ff;
    }

    .admin-mini {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .admin-mini-avatar {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        background: #ffd400;
        color: #001f4d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 900;
        flex-shrink: 0;
    }

    .admin-mini h5 {
        font-size: 16px;
        font-weight: 900;
        margin-bottom: 4px;
    }

    .admin-mini small {
        color: #cbd5e1;
        font-size: 13px;
    }

    .tips-list {
        display: grid;
        gap: 12px;
        margin-top: 8px;
    }

    .tip-item {
        background: rgba(255, 255, 255, 0.08);
        padding: 14px 15px;
        border-radius: 14px;
        font-size: 13px;
        line-height: 1.6;
        color: #f8fafc;
        border-left: 4px solid #ffd400;
    }

    .tip-item strong {
        color: #ffd400;
    }

    @media (max-width: 1100px) {
        .settings-layout {
            grid-template-columns: 1fr;
        }

        .decor-panel {
            min-height: auto;
        }
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: span 1;
        }

        .button-area {
            flex-direction: column;
        }

        .btn-save {
            width: 100%;
        }
    }
</style>

<div class="page-header">
    <h1>Pengaturan Admin</h1>
    <p>Kelola informasi akun administrator SIJAD.</p>
</div>

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="error-box">
        <strong>Periksa kembali input berikut:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="settings-layout">

    <div class="settings-panel">
        <div class="settings-title">
            <div class="settings-icon">⚙️</div>
            <div>
                <h3>Profil Administrator</h3>
                <p>Ubah nama, email, atau password admin.</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nama Admin</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           placeholder="Masukkan nama admin">
                </div>

                <div class="form-group">
                    <label for="email">Email Admin</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           placeholder="Masukkan email admin">
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Ulangi password baru">
                </div>
            </div>

            <div class="note">
                Kosongkan kolom password jika hanya ingin mengubah nama atau email.
            </div>

            <div class="button-area">
                <button type="submit" class="btn-save">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    <div class="decor-panel">
        <div class="decor-content">
            <div class="decor-badge">
                ✨ Area Informasi Admin
            </div>

            <div class="decor-title">
                SIJAD Admin Space
            </div>

            <div class="decor-text">
                Panel ini berfungsi sebagai dekorasi sekaligus ringkasan informasi akun
                administrator agar halaman pengaturan terlihat lebih hidup, rapi, dan profesional.
            </div>

            <div class="decor-card">
                <div class="admin-mini">
                    <div class="admin-mini-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5>{{ auth()->user()->name }}</h5>
                        <small>{{ auth()->user()->email }}</small>
                    </div>
                </div>

                <p>
                    Anda sedang login sebagai administrator sistem SIJAD Universitas Narotama.
                </p>
            </div>

            <div class="decor-card">
                <h4>Ringkasan Halaman</h4>
                <p>
                    Di halaman ini Anda dapat memperbarui identitas akun admin, email login,
                    serta password untuk menjaga keamanan sistem.
                </p>
            </div>

            <div class="tips-list">
                <div class="tip-item">
                    <strong>Tips 1:</strong> Gunakan email aktif agar akun admin mudah dikelola.
                </div>

                <div class="tip-item">
                    <strong>Tips 2:</strong> Ubah password secara berkala untuk meningkatkan keamanan akun.
                </div>

                <div class="tip-item">
                    <strong>Tips 3:</strong> Pastikan nama admin sesuai identitas pengelola sistem.
                </div>
            </div>
        </div>
    </div>

</div>
@endsection