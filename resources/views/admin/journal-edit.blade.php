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
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: #ffd400;
        color: #001f4d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 900;
    }

    .form-title h3 {
        font-size: 24px;
        font-weight: 900;
        color: #001f4d;
    }

    .form-title p {
        color: #64748b;
        margin-top: 3px;
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

    .file-info {
        background: #eaf2ff;
        color: #003b8f;
        padding: 12px 14px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
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
    <h1>Edit Jurnal Dosen</h1>
    <p>Perbarui data jurnal akademik dosen di sistem SIJAD.</p>
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
        <div class="form-icon">✏️</div>
        <div>
            <h3>Form Edit Jurnal</h3>
            <p>Ubah data jurnal sesuai kebutuhan.</p>
        </div>
    </div>

    <form action="{{ route('admin.journals.update', $journal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group full">
                <label for="judul">Judul Jurnal</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $journal->judul) }}">
            </div>

            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" id="nama_dosen" name="nama_dosen" value="{{ old('nama_dosen', $journal->nama_dosen) }}">
            </div>

            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" id="nidn" name="nidn" value="{{ old('nidn', $journal->nidn) }}">
            </div>

            <div class="form-group">
                <label for="program_studi">Program Studi</label>
                <select id="program_studi" name="program_studi">
                    <option value="">Pilih Program Studi</option>
                    @foreach (['Manajemen', 'Akuntansi', 'Sistem Informasi', 'Teknik Informatika', 'Ilmu Hukum', 'Administrasi Bisnis'] as $prodi)
                        <option value="{{ $prodi }}" {{ old('program_studi', $journal->program_studi) == $prodi ? 'selected' : '' }}>
                            {{ $prodi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tahun">Tahun Publikasi</label>
                <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $journal->tahun) }}">
            </div>

            <div class="form-group">
                <label for="nama_jurnal">Nama Jurnal / Prosiding</label>
                <input type="text" id="nama_jurnal" name="nama_jurnal" value="{{ old('nama_jurnal', $journal->nama_jurnal) }}">
            </div>

            <div class="form-group">
                <label for="kategori">Kategori Publikasi</label>
                <select id="kategori" name="kategori">
                    <option value="">Pilih Kategori</option>
                    @foreach (['Jurnal Nasional', 'Jurnal Nasional Terakreditasi', 'Jurnal Internasional', 'Prosiding Nasional', 'Prosiding Internasional'] as $kategori)
                        <option value="{{ $kategori }}" {{ old('kategori', $journal->kategori) == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status Verifikasi</label>
                <select id="status" name="status">
                    @foreach (['Menunggu', 'Review', 'Diterima', 'Ditolak'] as $status)
                        <option value="{{ $status }}" {{ old('status', $journal->status) == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="file_jurnal">Ganti File Jurnal</label>
                <input type="file" id="file_jurnal" name="file_jurnal">

                @if ($journal->file_jurnal)
                    <div class="file-info">
                        File saat ini:
                        <a href="{{ asset('storage/' . $journal->file_jurnal) }}" target="_blank">
                            Lihat File
                        </a>
                    </div>
                @endif
            </div>

            <div class="form-group full">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan">{{ old('keterangan', $journal->keterangan) }}</textarea>
            </div>
        </div>

        <div class="button-area">
            <a href="{{ route('admin.journals') }}" class="btn-back">Kembali</a>
            <button type="submit" class="btn-save">Update Jurnal</button>
        </div>
    </form>
</div>
@endsection