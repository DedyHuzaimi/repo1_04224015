<?php
$data = include 'api.php';

// FILTER
$tahun = $_GET['tahun'] ?? '';
$kategori = $_GET['kategori'] ?? '';

$filtered = array_filter($data, function($row) use ($tahun, $kategori) {
    if ($tahun && $row['tahun'] != $tahun) return false;
    if ($kategori && $row['kategori'] != $kategori) return false;
    return true;
});

// RANKING
$ranking = [];
foreach ($data as $row) {
    $d = $row['nama_kabupaten_kota'];
    $ranking[$d] = ($ranking[$d] ?? 0) + $row['jumlah'];
}
arsort($ranking);

// CHART
$chart = [];
foreach ($data as $row) {
    $d = $row['nama_kabupaten_kota'];
    $chart[$d] = ($chart[$d] ?? 0) + $row['jumlah'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Bencana Jatim</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-4">

    <h2 class="text-center mb-4">📊 Dashboard Data Bencana Jawa Timur</h2>

    <!-- FILTER -->
    <div class="card p-3 mb-4 shadow">
        <form method="GET" class="row">
            <div class="col-md-4">
                <input type="text" name="tahun" class="form-control" placeholder="Filter Tahun (2026)">
            </div>
            <div class="col-md-4">
                <input type="text" name="kategori" class="form-control" placeholder="Filter Kategori (BANJIR)">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>

    <!-- TABEL -->
    <div class="card p-3 mb-4 shadow">
        <h5>Data Bencana</h5>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Daerah</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach($filtered as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_kabupaten_kota'] ?></td>
                    <td>
                        <span class="badge bg-info text-dark">
                            <?= $row['kategori'] ?>
                        </span>
                    </td>
                    <td><?= $row['jumlah'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- RANKING -->
    <div class="card p-3 mb-4 shadow">
        <h5>🏆 Ranking Daerah Rawan Bencana</h5>
        <ol>
        <?php foreach($ranking as $d => $t): ?>
            <li><b><?= $d ?></b> - <?= $t ?> kejadian</li>
        <?php endforeach; ?>
        </ol>
    </div>

    <!-- CHART -->
    <div class="card p-3 shadow">
        <h5>📈 Grafik Bencana</h5>
        <canvas id="chart"></canvas>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const data = {
    labels: <?= json_encode(array_keys($chart)) ?>,
    datasets: [{
        label: 'Jumlah Bencana',
        data: <?= json_encode(array_values($chart)) ?>,
        borderWidth: 1
    }]
};

new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: data
});
</script>

</body>
</html>
