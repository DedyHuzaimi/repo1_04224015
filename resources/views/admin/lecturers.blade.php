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

    .hero {
        background: linear-gradient(135deg, #001f4d, #003b8f);
        color: white;
        border-radius: 28px;
        padding: 30px;
        margin-bottom: 26px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 18px 35px rgba(0, 31, 77, 0.22);
    }

    .hero::before {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        background: #ffd400;
        border-radius: 50%;
        opacity: 0.18;
        right: -80px;
        top: -80px;
    }

    .hero h2 {
        position: relative;
        z-index: 2;
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .hero p {
        position: relative;
        z-index: 2;
        color: #dbeafe;
        line-height: 1.7;
    }

    .layout-grid {
        display: grid;
        grid-template-columns: 1.25fr 2fr;
        gap: 24px;
        align-items: start;
    }

    .panel {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .panel-header {
        padding: 22px 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .panel-header h3 {
        font-size: 23px;
        font-weight: 900;
        color: #001f4d;
    }

    .badge-count {
        background: #eaf2ff;
        color: #003b8f;
        font-weight: 900;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
    }

    .form-area {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    label {
        display: block;
        font-size: 14px;
        color: #001f4d;
        font-weight: 900;
        margin-bottom: 8px;
    }

    input,
    select {
        width: 100%;
        padding: 13px 15px;
        border-radius: 14px;
        border: 1px solid #d1d5db;
        outline: none;
        font-size: 14px;
        transition: 0.25s;
        background: white;
    }

    input:focus,
    select:focus {
        border-color: #003b8f;
        box-shadow: 0 0 0 4px rgba(0, 59, 143, 0.12);
    }

    .btn-primary {
        width: 100%;
        border: none;
        background: #ffd400;
        color: #001f4d;
        padding: 14px;
        border-radius: 14px;
        font-weight: 900;
        cursor: pointer;
        transition: 0.25s;
        font-size: 14px;
    }

    .btn-primary:hover {
        background: #ffea70;
        transform: translateY(-2px);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px 16px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
        font-size: 14px;
        vertical-align: middle;
    }

    th {
        background: #f8fafc;
        color: #001f4d;
        font-weight: 900;
    }

    td {
        color: #334155;
    }

    .name-text {
        font-weight: 900;
        color: #001f4d;
    }

    .email-text {
        font-size: 13px;
        color: #64748b;
        margin-top: 4px;
    }

    .jurnal-badge {
        background: #fff4bd;
        color: #8a6d00;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
        display: inline-block;
    }

    .action-area {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-edit {
        border: none;
        background: #eaf2ff;
        color: #003b8f;
        padding: 9px 12px;
        border-radius: 11px;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-delete {
        border: none;
        background: #fee2e2;
        color: #b91c1c;
        padding: 9px 12px;
        border-radius: 11px;
        font-weight: 900;
        cursor: pointer;
    }

    .empty-row {
        text-align: center;
        padding: 34px;
        color: #64748b;
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 9999;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-card {
        width: 100%;
        max-width: 560px;
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0,0,0,0.25);
    }

    .modal-header {
        padding: 22px 24px;
        background: linear-gradient(135deg, #001f4d, #003b8f);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        font-size: 22px;
        font-weight: 900;
    }

    .modal-close {
        border: none;
        background: #ffd400;
        color: #001f4d;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        font-weight: 900;
    }

    .modal-body {
        padding: 24px;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 18px;
    }

    .btn-cancel {
        width: 100%;
        border: none;
        background: #e5e7eb;
        color: #334155;
        padding: 13px;
        border-radius: 14px;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-save {
        width: 100%;
        border: none;
        background: #003b8f;
        color: white;
        padding: 13px;
        border-radius: 14px;
        font-weight: 900;
        cursor: pointer;
    }

    @media (max-width: 1100px) {
        .layout-grid {
            grid-template-columns: 1fr;
        }

        .panel {
            overflow-x: auto;
        }

        table {
            min-width: 900px;
        }
    }
</style>

<div class="page-header">
    <h1>Kelola Akun Dosen</h1>
    <p>Admin dapat menambahkan, mengubah, dan menghapus akun dosen SIJAD.</p>
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

<div class="hero">
    <h2>{{ $totalDosen }} Akun Dosen Terdaftar</h2>
    <p>
        Data di halaman ini berasal dari akun user dengan role dosen.
        Admin dapat membuat akun dosen baru, memperbarui identitas dosen,
        dan menghapus akun dosen yang tidak digunakan.
    </p>
</div>

<div class="layout-grid">
    <div class="panel">
        <div class="panel-header">
            <h3>Tambah Akun Dosen</h3>
        </div>

        <div class="form-area">
            <form action="{{ route('admin.lecturers.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Dosen</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama dosen" required>
                </div>

                <div class="form-group">
                    <label>Email Dosen</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email dosen" required>
                </div>

                <div class="form-group">
                    <label>NIDN</label>
                    <input type="text" name="nidn" value="{{ old('nidn') }}" placeholder="Masukkan NIDN">
                </div>

                <div class="form-group">
                    <label>Program Studi</label>
                    <select name="program_studi">
                        <option value="">Pilih Program Studi</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Ilmu Hukum">Ilmu Hukum</option>
                        <option value="Administrasi Bisnis">Administrasi Bisnis</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn-primary">
                    + Tambah Akun Dosen
                </button>
            </form>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h3>Daftar Akun Dosen</h3>
            <span class="badge-count">{{ $dosens->count() }} Data</span>
        </div>

        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Dosen</th>
                <th>NIDN</th>
                <th>Program Studi</th>
                <th>Total Jurnal</th>
                <th>Aksi</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($dosens as $index => $dosen)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>
                        <div class="name-text">{{ $dosen->name }}</div>
                        <div class="email-text">{{ $dosen->email }}</div>
                    </td>

                    <td>{{ $dosen->nidn ?? '-' }}</td>
                    <td>{{ $dosen->program_studi ?? '-' }}</td>

                    <td>
                        <span class="jurnal-badge">
                            {{ $jumlahJurnal[$dosen->id] ?? 0 }} Jurnal
                        </span>
                    </td>

                    <td>
                        <div class="action-area">
                            <button type="button"
                                    class="btn-edit"
                                    onclick="openEditModal(
                                        '{{ route('admin.lecturers.update', $dosen->id) }}',
                                        '{{ addslashes($dosen->name) }}',
                                        '{{ addslashes($dosen->email) }}',
                                        '{{ addslashes($dosen->nidn ?? '') }}',
                                        '{{ addslashes($dosen->program_studi ?? '') }}'
                                    )">
                                Edit
                            </button>

                            <form action="{{ route('admin.lecturers.destroy', $dosen->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus akun dosen ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-row">
                        Belum ada akun dosen terdaftar.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal-overlay" id="editModal">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Edit Akun Dosen</h3>
            <button type="button" class="modal-close" onclick="closeEditModal()">×</button>
        </div>

        <div class="modal-body">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Dosen</label>
                    <input type="text" name="name" id="edit_name" required>
                </div>

                <div class="form-group">
                    <label>Email Dosen</label>
                    <input type="email" name="email" id="edit_email" required>
                </div>

                <div class="form-group">
                    <label>NIDN</label>
                    <input type="text" name="nidn" id="edit_nidn">
                </div>

                <div class="form-group">
                    <label>Program Studi</label>
                    <select name="program_studi" id="edit_program_studi">
                        <option value="">Pilih Program Studi</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Ilmu Hukum">Ilmu Hukum</option>
                        <option value="Administrasi Bisnis">Administrasi Bisnis</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru">
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">
                        Batal
                    </button>

                    <button type="submit" class="btn-save">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(action, name, email, nidn, programStudi) {
        document.getElementById('editForm').action = action;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_nidn').value = nidn;
        document.getElementById('edit_program_studi').value = programStudi;

        document.getElementById('editModal').classList.add('show');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('show');
    }
</script>
@endsection