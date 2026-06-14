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

    .detail-panel {
        background: white;
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
    }

    .detail-title {
        display: flex;
        gap: 16px;
        align-items: center;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 24px;
    }

    .detail-icon {
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
    }

    .detail-title h2 {
        font-size: 25px;
        color: #001f4d;
        font-weight: 900;
    }

    .detail-title p {
        color: #64748b;
        margin-top: 4px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .detail-item {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 18px;
    }

    .detail-item.full {
        grid-column: span 2;
    }

    .detail-item small {
        display: block;
        color: #64748b;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .detail-item strong {
        color: #001f4d;
        font-size: 16px;
        line-height: 1.6;
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

    .button-area {
        margin-top: 28px;
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        border-top: 1px solid #e5e7eb;
        padding-top: 22px;
    }

    .btn-back,
    .btn-file {
        padding: 13px 18px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 900;
        display: inline-block;
    }

    .btn-back {
        background: #e5e7eb;
        color: #334155;
    }

    .btn-file {
        background: #003b8f;
        color: white;
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-item.full {
            grid-column: span 1;
        }

        .button-area {
            flex-direction: column;
        }
    }
</style>

<div class="page-header">
    <h1>Detail Jurnal Dosen</h1>
    <p>Informasi lengkap data jurnal akademik dosen.</p>
</div>

<div class="detail-panel">
    <div class="detail-title">
        <div class="detail-icon">📚</div>
        <div>
            <h2>{{ $journal->judul }}</h2>
            <p>{{ $journal->nama_dosen }} — {{ $journal->tahun }}</p>
        </div>
    </div>

    <div class="detail-grid">
        <div class="detail-item full">
            <small>Judul Jurnal</small>
            <strong>{{ $journal->judul }}</strong>
        </div>

        <div class="detail-item">
            <small>Nama Dosen</small>
            <strong>{{ $journal->nama_dosen }}</strong>
        </div>

        <div class="detail-item">
            <small>NIDN</small>
            <strong>{{ $journal->nidn ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <small>Program Studi</small>
            <strong>{{ $journal->program_studi }}</strong>
        </div>

        <div class="detail-item">
            <small>Tahun Publikasi</small>
            <strong>{{ $journal->tahun }}</strong>
        </div>

        <div class="detail-item">
            <small>Nama Jurnal / Prosiding</small>
            <strong>{{ $journal->nama_jurnal ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <small>Kategori Publikasi</small>
            <strong>{{ $journal->kategori ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <small>Status</small>

            @if ($journal->status == 'Diterima')
                <span class="badge accepted">Diterima</span>
            @elseif ($journal->status == 'Ditolak')
                <span class="badge rejected">Ditolak</span>
            @elseif ($journal->status == 'Review')
                <span class="badge review">Review</span>
            @else
                <span class="badge pending">Menunggu</span>
            @endif
        </div>

        <div class="detail-item full">
            <small>Keterangan</small>
            <strong>{{ $journal->keterangan ?? '-' }}</strong>
        </div>
    </div>

    <div class="button-area">
        <a href="{{ route('admin.journals') }}" class="btn-back">
            Kembali
        </a>

        @if ($journal->file_jurnal)
            <a href="{{ asset('storage/' . $journal->file_jurnal) }}" target="_blank" class="btn-file">
                Lihat File Jurnal
            </a>
        @endif
    </div>
</div>
@endsection