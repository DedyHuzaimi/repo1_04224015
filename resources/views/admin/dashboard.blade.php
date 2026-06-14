@extends('layouts.admin')

@section('content')
<style>
    .page-title {
        margin-bottom: 24px;
    }

    .page-title h1 {
        font-size: 34px;
        font-weight: 900;
        color: #001f4d;
        margin-bottom: 8px;
    }

    .page-title p {
        color: #64748b;
        font-size: 15px;
    }

    .hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #001f4d, #003b8f, #0052cc);
        border-radius: 28px;
        padding: 35px;
        margin-bottom: 26px;
        box-shadow: 0 18px 35px rgba(0, 31, 77, 0.25);
    }

    .hero::before {
        content: "";
        position: absolute;
        width: 250px;
        height: 250px;
        right: -80px;
        top: -80px;
        background: #ffd400;
        opacity: 0.25;
        border-radius: 50%;
    }

    .hero::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        right: 120px;
        bottom: -70px;
        background: white;
        opacity: 0.12;
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero span {
        background: #ffd400;
        color: #001f4d;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 900;
        display: inline-block;
        margin-bottom: 18px;
    }

    .hero h2 {
        color: white;
        font-size: 42px;
        font-weight: 900;
        margin-bottom: 12px;
    }

    .hero p {
        color: #fff4bd;
        font-size: 17px;
        max-width: 800px;
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
        padding: 24px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
        transition: 0.25s;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.12);
    }

    .card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .blue {
        background: #eaf2ff;
        color: #003b8f;
    }

    .yellow {
        background: #fff4bd;
        color: #b38b00;
    }

    .orange {
        background: #ffedd5;
        color: #ea580c;
    }

    .green {
        background: #dcfce7;
        color: #15803d;
    }

    .red {
        background: #fee2e2;
        color: #b91c1c;
    }

    .card p {
        color: #64748b;
        font-size: 14px;
        font-weight: 700;
    }

    .card h3 {
        font-size: 34px;
        color: #001f4d;
        font-weight: 900;
        margin-top: 8px;
    }

    .progress {
        width: 100%;
        height: 9px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
        margin-top: 18px;
    }

    .progress div {
        height: 100%;
        border-radius: 999px;
    }

    .main-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 22px;
    align-items: flex-start;
    }

    .panel {
        background: white;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
    }

    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .panel-header h3 {
        font-size: 22px;
        font-weight: 900;
        color: #001f4d;
    }

    .btn {
        background: #003b8f;
        color: white;
        padding: 10px 15px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 800;
        font-size: 13px;
        transition: 0.25s;
    }

    .btn:hover {
        background: #001f4d;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 14px 12px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
        font-size: 14px;
    }

    th {
        background: #f8fafc;
        color: #001f4d;
        font-weight: 900;
    }

    td {
        color: #334155;
    }

    .badge {
        padding: 6px 11px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        display: inline-block;
    }

    .badge-green {
        background: #dcfce7;
        color: #15803d;
    }

    .badge-blue {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .badge-yellow {
        background: #fef3c7;
        color: #b45309;
    }

    .badge-red {
        background: #fee2e2;
        color: #b91c1c;
    }

    .quick-list {
        display: grid;
        gap: 12px;
    }

    .quick-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        text-decoration: none;
        color: #0f172a;
        transition: 0.25s;
    }

    .quick-item:hover {
        border-color: #ffd400;
        background: #fffbea;
        transform: translateX(5px);
    }

    .quick-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .quick-icon {
        width: 40px;
        height: 40px;
        background: #ffd400;
        color: #001f4d;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
    }

    .activity {
        margin-top: 20px;
        background: #001f4d;
        color: white;
    }

    .activity h3 {
        color: white;
    }

    .activity-item {
        display: flex;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid rgba(255,255,255,0.12);
    }

    .dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: #ffd400;
        margin-top: 6px;
        flex-shrink: 0;
    }

    .activity-item small {
        color: #bfdbfe;
    }

    .activity-item p {
        margin-top: 4px;
        font-size: 14px;
        line-height: 1.5;
    }

    @media (max-width: 1200px) {
        .cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .main-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .cards {
            grid-template-columns: 1fr;
        }

        .hero h2 {
            font-size: 30px;
        }

        .panel {
            overflow-x: auto;
        }

        table {
            min-width: 750px;
        }
    }

    .journal-panel {
    padding: 0;
    overflow: hidden;
    }

    .journal-panel .panel-header {
        padding: 26px 30px 22px;
        margin-bottom: 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .journal-panel .panel-header h3 {
        font-size: 26px;
        font-weight: 900;
        color: #001f4d;
        margin-bottom: 5px;
    }

    .journal-panel .panel-header p {
        color: #64748b;
        font-size: 14px;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dashboard-table thead {
        background: #f8fafc;
    }

    .dashboard-table th {
        padding: 17px 18px;
        color: #001f4d;
        font-size: 14px;
        font-weight: 900;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .dashboard-table td {
        padding: 18px;
        color: #334155;
        font-size: 14px;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    .dashboard-table tbody tr {
        transition: 0.25s;
    }

    .dashboard-table tbody tr:hover {
        background: #f8fafc;
    }

    .number-cell {
        font-weight: 900;
        color: #003b8f;
    }

    .journal-title {
        font-weight: 900;
        color: #001f4d;
        line-height: 1.5;
        max-width: 420px;
    }

    .journal-subtitle {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-weight: 600;
    }

    .lecturer-name {
        font-weight: 700;
        color: #0f172a;
        line-height: 1.5;
        max-width: 180px;
    }

    .year-badge {
        background: #eaf2ff;
        color: #003b8f;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }

    .status-badge {
        padding: 8px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        display: inline-block;
        white-space: nowrap;
    }

    .status-accepted {
        background: #dcfce7;
        color: #15803d;
    }

    .status-review {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-pending {
        background: #fef3c7;
        color: #b45309;
    }

    .status-rejected {
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-detail {
        background: #eaf2ff;
        color: #003b8f;
        padding: 9px 14px;
        border-radius: 11px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 900;
        transition: 0.25s;
        display: inline-block;
    }

    .btn-detail:hover {
        background: #003b8f;
        color: white;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 35px 20px;
    }

    .empty-icon {
        font-size: 42px;
        margin-bottom: 10px;
    }

    .empty-state h4 {
        font-size: 20px;
        color: #001f4d;
        font-weight: 900;
        margin-bottom: 6px;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 18px;
    }

    .btn-empty {
        background: #ffd400;
        color: #001f4d;
        padding: 11px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 900;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .dashboard-table {
            min-width: 850px;
        }

        .journal-panel .panel-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

    .journal-panel {
        height: auto;
        min-height: unset;
        align-self: flex-start;
        }

        .journal-panel table {
            margin-bottom: 0;
        }

        .journal-panel tbody tr:last-child td {
            border-bottom: none;
        }

        .dashboard-table td {
            padding: 18px;
        }

        .dashboard-table tbody tr {
            height: auto;
        }
    
}


</style>

<div class="page-title">
    <h1>Dashboard Admin SIJAD</h1>
    <p>Sistem Repository Jurnal Dosen Universitas Narotama</p>
</div>

<div class="hero">
    <div class="hero-content">
        <span>Repository Akademik Dosen</span>
        <h2>Universitas Narotama</h2>
        <p>
            Panel administrasi publikasi dan verifikasi jurnal dosen untuk mendukung dokumentasi,
            pelaporan, serta pengelolaan karya ilmiah kampus secara profesional.
        </p>
    </div>
</div>

<div class="cards">
    <div class="card">
        <div class="card-top">
            <div class="icon blue">👨‍🏫</div>
        </div>
        <p>Total Dosen</p>
        <h3>{{ $totalDosen }}</h3>
        <div class="progress">
            <div style="width: 70%; background:#003b8f;"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-top">
            <div class="icon yellow">📚</div>
        </div>
        <p>Total Jurnal</p>
        <h3>{{ $totalJurnal }}</h3>
        <div class="progress">
            <div style="width: 90%; background:#ffd400;"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-top">
            <div class="icon orange">⏳</div>
        </div>
        <p>Menunggu</p>
        <h3>{{ $pending }}</h3>
        <div class="progress">
            <div style="width: 45%; background:#f97316;"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-top">
            <div class="icon green">✅</div>
        </div>
        <p>Diterima</p>
        <h3>{{ $accepted }}</h3>
        <div class="progress">
            <div style="width: 75%; background:#16a34a;"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-top">
            <div class="icon red">❌</div>
        </div>
        <p>Ditolak</p>
        <h3>{{ $rejected }}</h3>
        <div class="progress">
            <div style="width: 30%; background:#dc2626;"></div>
        </div>
    </div>
</div>

<div class="main-grid">
    <div class="panel journal-panel">
    <div class="panel-header">
        <div>
            <h3>Jurnal Akademik Terbaru</h3>
            <p>Daftar jurnal dosen yang baru masuk ke sistem SIJAD.</p>
        </div>

        <a href="{{ route('admin.journals') }}" class="btn">
            Lihat Semua
        </a>
    </div>

    <div class="table-responsive">
        <table class="dashboard-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Judul Jurnal</th>
                <th>Nama Dosen</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($recentJournals as $index => $journal)
                <tr>
                    <td class="number-cell">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        <div class="journal-title">
                            {{ $journal->judul }}
                        </div>

                        <small class="journal-subtitle">
                            {{ $journal->program_studi ?? 'Program studi belum diisi' }}
                        </small>
                    </td>

                    <td>
                        <div class="lecturer-name">
                            {{ $journal->nama_dosen }}
                        </div>
                    </td>

                    <td>
                        <span class="year-badge">
                            {{ $journal->tahun }}
                        </span>
                    </td>

                    <td>
                        @if ($journal->status == 'Diterima')
                            <span class="status-badge status-accepted">Diterima</span>
                        @elseif ($journal->status == 'Ditolak')
                            <span class="status-badge status-rejected">Ditolak</span>
                        @elseif ($journal->status == 'Review')
                            <span class="status-badge status-review">Review</span>
                        @else
                            <span class="status-badge status-pending">Menunggu</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.journals.show', $journal->id) }}"
                           class="btn-detail">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">📚</div>
                            <h4>Belum ada jurnal terbaru</h4>
                            <p>Tambahkan data jurnal terlebih dahulu agar tampil di dashboard.</p>

                            <a href="{{ route('admin.journals', ['status' => 'Menunggu']) }}" class="btn-add">
                                Lihat Pengajuan
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
    <div>
            <div class="panel">
                <div class="panel-header">
                    <h3>Menu Cepat</h3>
                </div>

                <div class="quick-list">
                    <a href="{{ route('admin.journals', ['status' => 'Menunggu']) }}" class="quick-item">
                        <div class="quick-left">
                            <div class="quick-icon">✓</div>
                            <div>
                                <strong>Pengajuan Jurnal</strong><br>
                                <small>Verifikasi jurnal dari dosen</small>
                            </div>
                        </div>
                        <span>›</span>
                    </a>

                    <a href="{{ route('admin.lecturers') }}" class="quick-item">
                        <div class="quick-left">
                            <div class="quick-icon">D</div>
                            <div>
                                <strong>Data Dosen</strong><br>
                                <small>Kelola data dosen</small>
                            </div>
                        </div>
                        <span>›</span>
                    </a>

                    <a href="{{ route('admin.journals', ['status' => 'Menunggu']) }}" class="quick-item">
                        <div class="quick-left">
                            <div class="quick-icon">✓</div>
                            <div>
                                <strong>Verifikasi Jurnal</strong><br>
                                <small>Periksa jurnal masuk</small>
                            </div>
                        </div>
                        <span>›</span>
                    </a>

                    <a href="{{ route('admin.reports') }}" class="quick-item">
                        <div class="quick-left">
                            <div class="quick-icon">P</div>
                            <div>
                                <strong>Cetak Laporan</strong><br>
                                <small>Laporan publikasi</small>
                            </div>
                        </div>
                        <span>›</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="panel activity">
            <div class="panel-header">
                <h3>Aktivitas Terbaru</h3>
            </div>

            <div class="activity-item">
                <span class="dot"></span>
                <div>
                    <small>10:24</small>
                    <p>Admin melakukan verifikasi jurnal dosen.</p>
                </div>
            </div>

            <div class="activity-item">
                <span class="dot"></span>
                <div>
                    <small>09:58</small>
                    <p>Pengajuan jurnal baru masuk ke sistem.</p>
                </div>
            </div>

            <div class="activity-item">
                <span class="dot"></span>
                <div>
                    <small>09:15</small>
                    <p>Data repository akademik diperbarui.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection