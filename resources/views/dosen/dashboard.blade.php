@extends('layouts.dosen')

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

    .hero-user {
        background: linear-gradient(135deg, #001f4d, #003b8f);
        color: white;
        border-radius: 28px;
        padding: 32px;
        margin-bottom: 26px;
        box-shadow: 0 18px 35px rgba(0, 31, 77, 0.25);
        position: relative;
        overflow: hidden;
    }

    .hero-user::before {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        background: #ffd400;
        border-radius: 50%;
        opacity: 0.22;
        right: -80px;
        top: -80px;
    }

    .hero-user h2 {
        position: relative;
        z-index: 2;
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .hero-user p {
        position: relative;
        z-index: 2;
        color: #dbeafe;
        max-width: 780px;
        line-height: 1.7;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 18px;
        margin-bottom: 26px;
    }

    .card {
        background: white;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
    }

    .card span {
        display: inline-flex;
        width: 48px;
        height: 48px;
        border-radius: 15px;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .blue {
        background: #eaf2ff;
    }

    .yellow {
        background: #fff4bd;
    }

    .orange {
        background: #ffedd5;
    }

    .green {
        background: #dcfce7;
    }

    .red {
        background: #fee2e2;
    }

    .card p {
        color: #64748b;
        font-size: 14px;
        font-weight: 800;
    }

    .card h3 {
        font-size: 32px;
        font-weight: 900;
        color: #001f4d;
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
        font-weight: 900;
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

    .empty-row {
        text-align: center;
        padding: 35px;
        color: #64748b;
    }

    @media (max-width: 1100px) {
        .cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .cards {
            grid-template-columns: 1fr;
        }

        .table-panel {
            overflow-x: auto;
        }

        table {
            min-width: 850px;
        }
    }
</style>

<div class="page-header">
    <div>
        <h1>Dashboard Dosen</h1>
        <p>Selamat datang, {{ auth()->user()->name }}. Kelola pengajuan jurnal akademik Anda.</p>
    </div>

    <a href="{{ route('dosen.journals.create') }}" class="btn-add">
        + Ajukan Jurnal
    </a>
</div>

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="hero-user">
    <h2>Repository Jurnal Dosen</h2>
    <p>
        Melalui halaman ini, dosen dapat mengajukan jurnal akademik secara mandiri.
        Jurnal yang diajukan akan diverifikasi oleh admin sebelum dinyatakan diterima atau ditolak.
    </p>
</div>

<div class="cards">
    <div class="card">
        <span class="blue">📚</span>
        <p>Total Jurnal</p>
        <h3>{{ $totalJurnal }}</h3>
    </div>

    <div class="card">
        <span class="yellow">⏳</span>
        <p>Menunggu</p>
        <h3>{{ $menunggu }}</h3>
    </div>

    <div class="card">
        <span class="orange">🔍</span>
        <p>Review</p>
        <h3>{{ $review }}</h3>
    </div>

    <div class="card">
        <span class="green">✅</span>
        <p>Diterima</p>
        <h3>{{ $diterima }}</h3>
    </div>

    <div class="card">
        <span class="red">❌</span>
        <p>Ditolak</p>
        <h3>{{ $ditolak }}</h3>
    </div>
</div>

<div class="table-panel">
    <div class="table-header">
        <h3>Jurnal Saya</h3>
        <span>{{ $journals->count() }} Data</span>
    </div>

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Judul Jurnal</th>
            <th>Program Studi</th>
            <th>Tahun</th>
            <th>Status</th>
            <th>Keterangan</th>
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

                <td>{{ $journal->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="empty-row">
                    Belum ada jurnal yang diajukan.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection