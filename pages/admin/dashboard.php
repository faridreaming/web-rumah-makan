<?php
// Konfigurasi Database
$host = 'localhost';
$dbname = 'rm_padang';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Koneksi database gagal: " . $e->getMessage());
}

// Ambil Data untuk Grafik
$daily_revenue = $pdo->query("SELECT tanggal_pesanan, SUM(total_harga) as total_pendapatan 
                               FROM pesanan 
                               GROUP BY tanggal_pesanan 
                               ORDER BY tanggal_pesanan 
                               LIMIT 7")
  ->fetchAll(PDO::FETCH_ASSOC);

$order_status = $pdo->query("SELECT status_pesanan, COUNT(*) as jumlah 
                              FROM pesanan 
                              GROUP BY status_pesanan")
  ->fetchAll(PDO::FETCH_ASSOC);

$top_menu = $pdo->query("SELECT m.nama_menu, SUM(dp.jumlah) as total_terjual 
                         FROM detail_pesanan dp 
                         JOIN menu m ON dp.id_menu = m.id_menu 
                         GROUP BY m.nama_menu 
                         ORDER BY total_terjual DESC 
                         LIMIT 5")
  ->fetchAll(PDO::FETCH_ASSOC);

// Statistik Tambahan
$total_pendapatan = $pdo->query("SELECT SUM(total_harga) as total FROM pesanan")
  ->fetch(PDO::FETCH_ASSOC)['total'];
$total_pesanan = $pdo->query("SELECT COUNT(*) as total FROM pesanan")
  ->fetch(PDO::FETCH_ASSOC)['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Restoran</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Dashboard Restoran</h1>

    <!-- Kartu Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
      <div class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center">
        <h3 class="text-gray-500 text-lg">Total Pendapatan</h3>
        <p class="text-2xl font-bold text-green-600">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
      </div>
      <div class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center">
        <h3 class="text-gray-500 text-lg">Total Pesanan</h3>
        <p class="text-2xl font-bold text-blue-600"><?= $total_pesanan ?></p>
      </div>
      <div class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center">
        <h3 class="text-gray-500 text-lg">Pesanan Diproses</h3>
        <p class="text-2xl font-bold text-yellow-600">
          <?= array_values(array_filter($order_status, fn($item) => $item['status_pesanan'] == 'Diproses'))[0]['jumlah'] ?? 0 ?>
        </p>
      </div>
      <div class="bg-white border-2 border-gray-200 rounded-lg p-6 text-center">
        <h3 class="text-gray-500 text-lg">Pesanan Selesai</h3>
        <p class="text-2xl font-bold text-green-600">
          <?= array_values(array_filter($order_status, fn($item) => $item['status_pesanan'] === 'Selesai'))[0]['jumlah'] ?? 0; ?>
        </p>
      </div>
    </div>

    <!-- Grafik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Grafik Pendapatan Harian -->
      <div class="bg-white border-2 border-gray-200 rounded-lg p-4">
        <h2 class="text-xl font-semibold mb-4">Pendapatan Harian</h2>
        <canvas id="dailyRevenueChart"></canvas>
      </div>

      <!-- Grafik Status Pesanan -->
      <div class="bg-white border-2 border-gray-200 rounded-lg p-4">
        <h2 class="text-xl font-semibold mb-4">Status Pesanan</h2>
        <canvas id="orderStatusChart"></canvas>
      </div>

      <!-- Grafik Menu Terlaris -->
      <div class="bg-white border-2 border-gray-200 rounded-lg p-4">
        <h2 class="text-xl font-semibold mb-4">Top 5 Menu Terlaris</h2>
        <canvas id="topMenuChart"></canvas>
      </div>
    </div>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Data dari PHP
      const dailyRevenueData = <?= json_encode($daily_revenue) ?>;
      const orderStatusData = <?= json_encode($order_status) ?>;
      const topMenuData = <?= json_encode($top_menu) ?>;

      // Grafik Pendapatan Harian
      new Chart(document.getElementById('dailyRevenueChart'), {
        type: 'line',
        data: {
          labels: dailyRevenueData.map(item => item.tanggal_pesanan),
          datasets: [{
            label: 'Pendapatan (Rp)',
            data: dailyRevenueData.map(item => item.total_pendapatan),
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            tooltip: {
              callbacks: {
                label: function(context) {
                  return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                }
              }
            }
          }
        }
      });

      // Grafik Status Pesanan
      new Chart(document.getElementById('orderStatusChart'), {
        type: 'pie',
        data: {
          labels: orderStatusData.map(item => item.status_pesanan),
          datasets: [{
            data: orderStatusData.map(item => item.jumlah),
            backgroundColor: ['#FF6384', '#36A2EB']
          }]
        }
      });

      // Grafik Menu Terlaris
      new Chart(document.getElementById('topMenuChart'), {
        type: 'bar',
        data: {
          labels: topMenuData.map(item => item.nama_menu),
          datasets: [{
            label: 'Total Terjual',
            data: topMenuData.map(item => item.total_terjual),
            backgroundColor: 'rgba(54, 162, 235, 0.5)'
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            }
          }
        }
      });
    });
  </script>
</body>

</html>
```