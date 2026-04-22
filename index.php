<?php
$data = include 'api.php';

// ambil filter
$kategori_filter = $_GET['kategori'] ?? '';
$tahun_filter = $_GET['tahun'] ?? '';

// normalisasi function
function normalize($str) {
    return strtolower(trim($str));
}

// filter data
$data_filtered = array_filter($data, function ($item) use ($kategori_filter, $tahun_filter) {
    return 
        ($kategori_filter == '' || normalize($item['kategori']) == normalize($kategori_filter)) &&
        ($tahun_filter == '' || normalize($item['tahun']) == normalize($tahun_filter));
});

// ambil kategori unik (dinamis)
$kategori_list = array_unique(array_column($data, 'kategori'));
sort($kategori_list);

// ambil tahun unik (dinamis)
$tahun_list = array_unique(array_column($data, 'tahun'));
sort($tahun_list);

// ranking
$ranking = [];
foreach ($data_filtered as $item) {
    $daerah = $item['nama_kabupaten_kota'];
    $ranking[$daerah] = ($ranking[$daerah] ?? 0) + $item['jumlah'];
}
arsort($ranking);

// data chart
$chart_labels = array_keys($ranking);
$chart_values = array_values($ranking);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Bencana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="text-center mb-4">📊 Dashboard Bencana Jawa Timur</h2>

    <!-- FILTER -->
    <div class="card p-3 mb-4">
        <form method="GET" class="row g-3">

            <div class="col-md-4">
                <label>Kategori</label>
                <select name="kategori" class="form-control">
                    <option value="">Semua</option>
                    <?php foreach ($kategori_list as $k): ?>
                        <option value="<?= $k ?>" <?= ($kategori_filter==$k?'selected':'') ?>>
                            <?= $k ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label>Tahun</label>
                <select name="tahun" class="form-control">
                    <option value="">Semua</option>
                    <?php foreach ($tahun_list as $t): ?>
                        <option value="<?= $t ?>" <?= ($tahun_filter==$t?'selected':'') ?>>
                            <?= $t ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary me-2">Filter</button>
                <a href="index.php" class="btn btn-secondary">Reset</a>
            </div>

        </form>
    </div>

    <!-- TABEL -->
    <div class="card p-3 mb-4">
        <h5>📋 Data</h5>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Daerah</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($data_filtered as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_kabupaten_kota'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- GRAFIK -->
    <div class="card p-3 mb-4">
        <h5>📊 Grafik Ranking</h5>
        <canvas id="chart"></canvas>
    </div>

    <!-- RANKING -->
    <div class="card p-3">
        <h5>🏆 Ranking</h5>
        <ul class="list-group">
            <?php foreach ($ranking as $d => $j): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <?= $d ?>
                    <span class="badge bg-danger"><?= $j ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($chart_labels) ?>,
        datasets: [{
            label: 'Jumlah Bencana',
            data: <?= json_encode($chart_values) ?>,
        }]
    }
});
</script>

</body>
</html>
