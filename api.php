<?php

$url = "https://opendata.jatimprov.go.id/api/cleaned-bigdata/badan_penanggulangan_bencana_daerah_provinsi_jawa_timur/jumlah_kejadian_bencana_berdasarkan_jenisnya?per_page=100";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "User-Agent: Mozilla/5.0"
]);

$response = curl_exec($ch);

$data = json_decode($response, true);

if (!$data || !isset($data['data'])) {
    die("Gagal ambil data API");
}

return $data['data'];
