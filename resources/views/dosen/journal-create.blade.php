@extends('layouts.dosen')

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

    .form-panel {
        background: white;
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
    }

    .form-title {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 26px;
        padding-bottom: 18px;
        border-bottom: 1px solid #e5e7eb;
    }

    .form-icon {
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

    .form-title h3 {
        font-size: 24px;
        font-weight: 900;
        color: #001f4d;
    }

    .form-title p {
        color: #64748b;
        margin-top: 4px;
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

    .info-box {
        background: #eaf2ff;
        color: #003b8f;
        padding: 16px 18px;
        border-radius: 16px;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 24px;
        line-height: 1.7;
        border-left: 5px solid #ffd400;
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

    input,
    select,
    textarea {
        width: 100%;
        padding: 14px 16px;
        border-radius: 14px;
        border: 1px solid #d1d5db;
        font-size: 14px;
        outline: none;
        transition: 0.25s;
        background: white;
    }

    textarea {
        resize: vertical;
        min-height: 120px;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #003b8f;
        box-shadow: 0 0 0 4px rgba(0, 59, 143, 0.12);
    }

    .readonly-box {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        padding: 14px 16px;
        border-radius: 14px;
        color: #334155;
        font-weight: 800;
    }

    .status-preview {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fef3c7;
        color: #b45309;
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 900;
        width: fit-content;
    }

    .button-area {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-back {
        background: #e5e7eb;
        color: #334155;
        padding: 13px 18px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 900;
        transition: 0.25s;
    }

    .btn-back:hover {
        background: #cbd5e1;
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

        .btn-back,
        .btn-save {
            text-align: center;
            width: 100%;
        }
    }
</style>

<div class="page-header">
    <h1>Ajukan Jurnal Dosen</h1>
    <p>Unggah data jurnal akademik Anda untuk diverifikasi oleh admin SIJAD.</p>
</div>

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

<div class="form-panel">
    <div class="form-title">
        <div class="form-icon">📤</div>
        <div>
            <h3>Form Pengajuan Jurnal</h3>
            <p>Lengkapi informasi jurnal dengan benar sebelum diajukan.</p>
        </div>
    </div>

    <div class="info-box">
        Nama dosen akan otomatis menggunakan akun yang sedang login, yaitu
        <strong>{{ auth()->user()->name }}</strong>.
        Status jurnal akan otomatis menjadi <strong>Menunggu</strong> sampai diverifikasi oleh admin.
    </div>

    <form action="{{ route('dosen.journals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            <div class="form-group full">
                <label>Nama Dosen</label>
                <div class="readonly-box">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <div class="form-group full">
                <label for="judul">Judul Jurnal</label>
                <input type="text"
                       id="judul"
                       name="judul"
                       value="{{ old('judul') }}"
                       placeholder="Masukkan judul jurnal">
            </div>

            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text"
                       id="nidn"
                       name="nidn"
                       value="{{ old('nidn') }}"
                       placeholder="Masukkan NIDN">
            </div>

            <div class="form-group">
                <label for="program_studi">Program Studi</label>
                <select id="program_studi" name="program_studi">
                    <option value="">Pilih Program Studi</option>
                    <option value="Manajemen" {{ old('program_studi') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                    <option value="Akuntansi" {{ old('program_studi') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    <option value="Sistem Informasi" {{ old('program_studi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                    <option value="Teknik Informatika" {{ old('program_studi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                    <option value="Ilmu Hukum" {{ old('program_studi') == 'Ilmu Hukum' ? 'selected' : '' }}>Ilmu Hukum</option>
                    <option value="Administrasi Bisnis" {{ old('program_studi') == 'Administrasi Bisnis' ? 'selected' : '' }}>Administrasi Bisnis</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tahun">Tahun Publikasi</label>
                <input type="number"
                       id="tahun"
                       name="tahun"
                       value="{{ old('tahun') }}"
                       placeholder="Contoh: 2024">
            </div>

            <div class="form-group">
                <label for="nama_jurnal">Nama Jurnal / Prosiding</label>
                <input type="text"
                       id="nama_jurnal"
                       name="nama_jurnal"
                       value="{{ old('nama_jurnal') }}"
                       placeholder="Masukkan nama jurnal atau prosiding">
            </div>

            <div class="form-group">
                <label for="kategori">Kategori Publikasi</label>
                <select id="kategori" name="kategori">
                    <option value="">Pilih Kategori</option>
                    <option value="Jurnal Nasional" {{ old('kategori') == 'Jurnal Nasional' ? 'selected' : '' }}>Jurnal Nasional</option>
                    <option value="Jurnal Nasional Terakreditasi" {{ old('kategori') == 'Jurnal Nasional Terakreditasi' ? 'selected' : '' }}>Jurnal Nasional Terakreditasi</option>
                    <option value="Jurnal Internasional" {{ old('kategori') == 'Jurnal Internasional' ? 'selected' : '' }}>Jurnal Internasional</option>
                    <option value="Prosiding Nasional" {{ old('kategori') == 'Prosiding Nasional' ? 'selected' : '' }}>Prosiding Nasional</option>
                    <option value="Prosiding Internasional" {{ old('kategori') == 'Prosiding Internasional' ? 'selected' : '' }}>Prosiding Internasional</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status Pengajuan</label>
                <div class="status-preview">
                    ⏳ Menunggu Verifikasi
                </div>
            </div>

            <div class="form-group">
                <label for="file_jurnal">Upload File Jurnal</label>
                <input type="file" id="file_jurnal" name="file_jurnal">
            </div>

            <div class="form-group full">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan"
                          name="keterangan"
                          placeholder="Tambahkan keterangan jika diperlukan">{{ old('keterangan') }}</textarea>
            </div>
        </div>

        <div class="button-area">
            <a href="{{ route('dosen.dashboard') }}" class="btn-back">
                Kembali
            </a>

            <button type="submit" class="btn-save">
                Ajukan Jurnal
            </button>
        </div>
    </form>
</div>
@endsection