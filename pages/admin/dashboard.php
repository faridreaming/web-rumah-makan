<?php
require_once "./functions.php";

// Ambil data dari tabel
$sql_menu = "SELECT sum(stok) as total_stok FROM menu";
$sql_pesanan = "SELECT sum(jumlah) as total_pembelian FROM pesanan";
$sql_penghasilan = "SELECT sum(total) as total_penghasilan FROM pesanan";

$result_menu = mysqli_query($conn, $sql_menu);
$result_menu = mysqli_fetch_assoc($result_menu);
$result_pesanan = mysqli_query($conn, $sql_pesanan);
$result_pesanan = mysqli_fetch_assoc($result_pesanan);
$result_penghasilan = mysqli_query($conn, $sql_penghasilan);
$result_penghasilan = mysqli_fetch_assoc($result_penghasilan);

// Data untuk chart
$total_stok = $result_menu['total_stok'];
$total_pembelian = $result_pesanan['total_pembelian'];
$total_penghasilan = $result_penghasilan['total_penghasilan'];

// Ambil data pembelian harian dari tabel pesanan
$sql_pembelian_harian = "SELECT DATE(tanggal_pesanan) as tanggal, SUM(jumlah) as total_pembelian 
                        FROM pesanan 
                        GROUP BY DATE(tanggal_pesanan) 
                        ORDER BY DATE(tanggal_pesanan) ASC";
$result_pembelian_harian = mysqli_query($conn, $sql_pembelian_harian);

// Periksa koneksi dan hasil query
if (!$result_pembelian_harian) {
    die("Query Error: " . mysqli_error($conn));
}

// Siapkan data untuk chart
$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($result_pembelian_harian)) {
    $labels[] = $row['tanggal']; // Tanggal sebagai label
    $data[] = $row['total_pembelian']; // Jumlah pembelian sebagai data
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="grid grid-cols-3 gap-4 text-center h-56">
        <div class='bg-blue-500 text-white py-16'>
            <h2 class='text-2xl font-bold'>Produk</h2>
            <p class='text-4xl font-bold'><?= number_format($total_stok, 0, ',', '.'); ?></p>
            <p class='text-sm'>Total Jumlah Stok Yang Tersedia</p>
        </div>
        <div class='bg-yellow-500 text-white py-16'>
            <h2 class='text-2xl font-bold'>Pembelian</h2>
            <p class='text-4xl font-bold'><?= number_format($total_pembelian, 0, ',', '.'); ?></p>
            <p class='text-sm'>Total Pembelian 30 Hari Kebelakang</p>
        </div>
        <div class='bg-green-500 text-white py-16'>
            <h2 class='text-2xl font-bold'>Penghasilan</h2>
            <p class='text-4xl font-bold'>Rp. <?= number_format($total_penghasilan, 0, ',', '.'); ?></p>
            <p class='text-sm'>Total Penghasilan Dalam Rupiah</p>
        </div>
    </div>

    <!-- Canvas untuk Chart -->
    <div style="width: 80%; margin: 50px auto;">
        <canvas id="pembelianChart"></canvas>
    </div>

    <!-- Script Chart.js -->
    <script>
        const ctx = document.getElementById('pembelianChart').getContext('2d');
        const pembelianChart = new Chart(ctx, {
            type: 'bar', // Jenis chart
            data: {
                labels: <?= json_encode($labels); ?>, // Data tanggal (sumbu X)
                datasets: [{
                    label: 'Jumlah Pembelian Harian',
                    data: <?= json_encode($data); ?>, // Data jumlah pembelian (sumbu Y)
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true, // Sumbu Y dimulai dari 0
                        title: {
                            display: true,
                            text: 'Jumlah Pembelian'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
