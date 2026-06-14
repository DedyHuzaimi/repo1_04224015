@extends('layouts.admin')

@section('content')
<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
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

    .btn-add {
        background: #ffd400;
        color: #001f4d;
        padding: 13px 18px;
        border-radius: 14px;
        font-weight: 900;
        text-decoration: none;
        box-shadow: 0 10px 20px rgba(255, 212, 0, 0.25);
        transition: 0.25s;
        white-space: nowrap;
    }

    .btn-add:hover {
        background: #ffea70;
        transform: translateY(-2px);
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

    .filter-box {
        background: white;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
        margin-bottom: 24px;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto auto;
        gap: 14px;
        align-items: center;
    }

    .filter-box input,
    .filter-box select {
        width: 100%;
        padding: 13px 15px;
        border-radius: 14px;
        border: 1px solid #d1d5db;
        outline: none;
        font-size: 14px;
    }

    .filter-box input:focus,
    .filter-box select:focus {
        border-color: #003b8f;
        box-shadow: 0 0 0 3px rgba(0, 59, 143, 0.12);
    }

    .btn-filter {
        border: none;
        background: #003b8f;
        color: white;
        padding: 13px 18px;
        border-radius: 14px;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-reset {
        background: #e5e7eb;
        color: #334155;
        padding: 13px 18px;
        border-radius: 14px;
        font-weight: 900;
        text-decoration: none;
        text-align: center;
    }

    .btn-reset:hover {
        background: #cbd5e1;
    }

    .table-panel {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .table-header {
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .table-header h3 {
        font-size: 24px;
        font-weight: 900;
        color: #001f4d;
    }

    .table-header span {
        background: #eaf2ff;
        color: #003b8f;
        font-weight: 900;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
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

    .judul {
        font-weight: 800;
        color: #001f4d;
        line-height: 1.5;
    }

    .badge {
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        display: inline-block;
        white-space: nowrap;
    }

    .pending {
        background: #fef3c7;
        color: #b45309;
    }

    .accepted {
        background: #dcfce7;
        color: #15803d;
    }

    .rejected {
        background: #fee2e2;
        color: #b91c1c;
    }

    .review {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .action-group {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .action-group form {
        margin: 0;
        padding: 0;
        display: inline-flex;
    }

    .btn-action {
        border: none;
        outline: none;
        padding: 9px 13px;
        border-radius: 10px;
        font-weight: 900;
        cursor: pointer;
        font-size: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.25s;
        line-height: 1;
        font-family: inherit;
        white-space: nowrap;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .detail {
        background: #eaf2ff;
        color: #003b8f;
    }

    .edit {
        background: #ede9fe;
        color: #6d28d9;
    }

    .accept {
        background: #dcfce7;
        color: #15803d;
    }

    .reject {
        background: #fee2e2;
        color: #b91c1c;
    }

    .delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .empty-row {
        text-align: center;
        padding: 35px;
        color: #64748b;
    }

    @media (max-width: 900px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-box {
            grid-template-columns: 1fr;
        }

        .table-panel {
            overflow-x: auto;
        }

        table {
            min-width: 1050px;
        }
    }
</style>

@php
    if (request('status') == 'Menunggu') {
        $pageTitle = 'Pengajuan Jurnal';
        $pageDescription = 'Daftar jurnal dosen yang masih menunggu proses verifikasi admin.';
    } elseif (request('status') == 'Review') {
        $pageTitle = 'Review Jurnal';
        $pageDescription = 'Daftar jurnal dosen yang sedang berada dalam proses review.';
    } elseif (request('status') == 'Diterima') {
        $pageTitle = 'Jurnal Diterima';
        $pageDescription = 'Daftar jurnal dosen yang sudah diterima dan diverifikasi.';
    } elseif (request('status') == 'Ditolak') {
        $pageTitle = 'Jurnal Ditolak';
        $pageDescription = 'Daftar jurnal dosen yang tidak lolos proses verifikasi.';
    } else {
        $pageTitle = 'Data Jurnal Dosen';
        $pageDescription = 'Kelola semua data repository jurnal akademik dosen Universitas Narotama.';
    }
@endphp


@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.journals') }}" method="GET" class="filter-box">
    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari judul jurnal, nama dosen, atau program studi...">

    <select name="tahun">
        <option value="">Semua Tahun</option>
        @foreach ($years ?? [] as $year)
            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                {{ $year }}
            </option>
        @endforeach
    </select>

    <select name="status">
        <option value="">Semua Status</option>
        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
        <option value="Review" {{ request('status') == 'Review' ? 'selected' : '' }}>Review</option>
        <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>

    <button type="submit" class="btn-filter">Filter</button>

    <a href="{{ route('admin.journals') }}" class="btn-reset">
        Reset
    </a>
</form>

<div class="table-panel">
    <div class="table-header">
        <h3>{{ $pageTitle }}</h3>
        <span>{{ $journals->count() }} Data</span>
    </div>

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Judul Jurnal</th>
            <th>Nama Dosen</th>
            <th>Program Studi</th>
            <th>Tahun</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>
        @forelse ($journals as $index => $journal)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td>
                    <div class="judul">
                        {{ $journal->judul }}
                    </div>
                </td>

                <td>{{ $journal->nama_dosen }}</td>
                <td>{{ $journal->program_studi }}</td>
                <td>{{ $journal->tahun }}</td>

                <td>
                    @if ($journal->status == 'Diterima')
                        <span class="badge accepted">Diterima</span>
                    @elseif ($journal->status == 'Ditolak')
                        <span class="badge rejected">Ditolak</span>
                    @elseif ($journal->status == 'Review')
                        <span class="badge review">Review</span>
                    @else
                        <span class="badge pending">Menunggu</span>
                    @endif
                </td>

                <td>
                    <div class="action-group">
                        <a href="{{ route('admin.journals.show', $journal->id) }}"
                           class="btn-action detail">
                            Detail
                        </a>

                        <a href="{{ route('admin.journals.edit', $journal->id) }}"
                           class="btn-action edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.journals.accept', $journal->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-action accept">
                                Terima
                            </button>
                        </form>

                        <form action="{{ route('admin.journals.reject', $journal->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-action reject">
                                Tolak
                            </button>
                        </form>

                        <form action="{{ route('admin.journals.destroy', $journal->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data jurnal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="empty-row">
                    Belum ada data jurnal.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection