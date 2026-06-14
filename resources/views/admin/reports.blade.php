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

    .btn-print {
        background: #ffd400;
        color: #001f4d;
        padding: 13px 18px;
        border-radius: 14px;
        font-weight: 900;
        text-decoration: none;
        border: none;
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(255, 212, 0, 0.25);
    }

    .filter-box {
        background: white;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
        margin-bottom: 24px;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto auto;
        gap: 14px;
        align-items: center;
    }

    .filter-box select {
        width: 100%;
        padding: 13px 15px;
        border-radius: 14px;
        border: 1px solid #d1d5db;
        outline: none;
        font-size: 14px;
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

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .summary-card {
        background: white;
        border-radius: 20px;
        padding: 22px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
    }

    .summary-card p {
        color: #64748b;
        font-weight: 800;
        font-size: 13px;
    }

    .summary-card h3 {
        font-size: 32px;
        color: #001f4d;
        font-weight: 900;
        margin-top: 8px;
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
        justify-content: space-between;
        align-items: center;
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

    .badge {
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        display: inline-block;
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

    .empty-row {
        text-align: center;
        padding: 35px;
        color: #64748b;
    }

    @media print {
        .sidebar,
        .topbar,
        .filter-box,
        .btn-print {
            display: none !important;
        }

        .main {
            margin-left: 0 !important;
            width: 100% !important;
        }

        body {
            background: white !important;
        }

        .table-panel,
        .summary-card {
            box-shadow: none !important;
        }
    }

    @media (max-width: 1000px) {
        .summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filter-box {
            grid-template-columns: 1fr;
        }

        .table-panel {
            overflow-x: auto;
        }

        table {
            min-width: 950px;
        }
    }
</style>

<div class="page-header">
    <div>
        <h1>Laporan Jurnal</h1>
        <p>Rekapitulasi data jurnal akademik dosen Universitas Narotama.</p>
    </div>

    <button onclick="window.print()" class="btn-print">
        Cetak Laporan
    </button>
</div>

<form action="{{ route('admin.reports') }}" method="GET" class="filter-box">
    <select name="tahun">
        <option value="">Semua Tahun</option>
        @foreach ($years as $year)
            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                {{ $year }}
            </option>
        @endforeach
    </select>

    <select name="program_studi">
        <option value="">Semua Program Studi</option>
        @foreach ($programs as $program)
            <option value="{{ $program }}" {{ request('program_studi') == $program ? 'selected' : '' }}>
                {{ $program }}
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

    <a href="{{ route('admin.reports') }}" class="btn-reset">Reset</a>
</form>

<div class="summary-grid">
    <div class="summary-card">
        <p>Total Jurnal</p>
        <h3>{{ $totalJurnal }}</h3>
    </div>

    <div class="summary-card">
        <p>Total Dosen</p>
        <h3>{{ $totalDosen }}</h3>
    </div>

    <div class="summary-card">
        <p>Diterima</p>
        <h3>{{ $diterima }}</h3>
    </div>

    <div class="summary-card">
        <p>Ditolak</p>
        <h3>{{ $ditolak }}</h3>
    </div>

    <div class="summary-card">
        <p>Menunggu</p>
        <h3>{{ $menunggu }}</h3>
    </div>
</div>

<div class="table-panel">
    <div class="table-header">
        <h3>Data Laporan Jurnal</h3>
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
        </tr>
        </thead>

        <tbody>
        @forelse ($journals as $index => $journal)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $journal->judul }}</strong></td>
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
            </tr>
        @empty
            <tr>
                <td colspan="6" class="empty-row">
                    Tidak ada data laporan.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection