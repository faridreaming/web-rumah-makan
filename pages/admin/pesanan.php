<?php
require_once("./components/toast.php");
require_once("./functions.php");

if (isset($_POST['selesaikan_pesanan'])) {
  $id_pesanan = $_POST['id_pesanan'];
  $queryUpdateStatusPesanan = "UPDATE pesanan SET status_pesanan = 'Selesai' WHERE id_pesanan = $id_pesanan";

  if (!mysqli_query($conn, $queryUpdateStatusPesanan)) {
    $_SESSION['error'] = 'Gagal menyelesaikan pesanan.';
    header("Location: app.php?page=pesanan");
    exit();
  }

  $_SESSION['success'] = 'Pesanan berhasil diselesaikan.';
?>
  <script type="text/javascript">
    window.location.href = 'dashboard.php?page=pesanan';
  </script>
<?php
  exit();
}

if (isset($_POST['batalkan_selesai'])) {
  $id_pesanan = $_POST['id_pesanan'];
  $queryUpdateStatusPesanan = "UPDATE pesanan SET status_pesanan = 'Diproses' WHERE id_pesanan = $id_pesanan";

  if (!mysqli_query($conn, $queryUpdateStatusPesanan)) {
    $_SESSION['error'] = 'Gagal mengganti status pesanan.';
    header("Location: app.php?page=pesanan");
    exit();
  }

  $_SESSION['success'] = 'Status pesanan berhasil diganti.';
?>
  <script type="text/javascript">
    window.location.href = 'dashboard.php?page=pesanan';
  </script>
<?php
  exit();
}

$pesananDiproses = query("SELECT 
                    p.id_pesanan,
                    u.username,
                    p.jumlah_menu, 
                    p.total_harga, 
                    p.tanggal_pesanan, 
                    GROUP_CONCAT(CONCAT(m.nama_menu, ' x ', dp.jumlah) SEPARATOR '<br>') AS daftar_menu

                  FROM pesanan p
                  JOIN detail_pesanan dp ON p.id_pesanan = dp.id_pesanan
                  JOIN user u ON p.id_user = u.id_user
                  JOIN menu m ON dp.id_menu = m.id_menu
                  WHERE p.status_pesanan = 'Diproses'
                  GROUP BY p.id_pesanan");

$pesananSelesai = query("SELECT 
                    p.id_pesanan,
                    u.username,
                    p.jumlah_menu, 
                    p.total_harga, 
                    p.tanggal_pesanan, 
                    GROUP_CONCAT(CONCAT(m.nama_menu, ' x ', dp.jumlah) SEPARATOR '<br>') AS daftar_menu

                  FROM pesanan p
                  JOIN detail_pesanan dp ON p.id_pesanan = dp.id_pesanan
                  JOIN user u ON p.id_user = u.id_user
                  JOIN menu m ON dp.id_menu = m.id_menu
                  WHERE p.status_pesanan = 'Selesai'
                  GROUP BY p.id_pesanan");
?>

<div class="p-2 sm:p-4">
  <!-- Diproses -->
  <h2 class="font-semibold text-gray-600 mb-2 text-center sm:text-left">Diproses:</h2>
  <?php if (!empty($pesananDiproses)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-4">
      <?php foreach ($pesananDiproses as $item): ?>
        <div class="p-2 sm:p-4 rounded-md border-2 border-gray-200 flex flex-col justify-between gap-2 sm:gap-4">
          <div>
            <div class="flex items-center justify-between">
              <h3 class="font-semibold text-sm">Pesanan #<?= $item['id_pesanan'] ?> : <span class="text-green-500 font-bold uppercase"><?= $item['username'] ?></span></h3>
              <p class="text-xs sm:text-sm"><?= $item['tanggal_pesanan'] ?></p>
            </div>
            <p class="text-xs mt-2 sm:text-sm"><?= $item['daftar_menu'] ?></p>
          </div>
          <form action="" method="post" class="w-full">
            <p class="text-xs sm:text-sm font-semibold mb-2">Total: Rp <?= number_format($item['total_harga'], 0, ",", ".") ?></p>
            <input type="hidden" name="id_pesanan" value="<?= $item['id_pesanan'] ?>">
            <button type="submit" name="selesaikan_pesanan" onclick="return confirm('Apakah Anda ingin menyelesaikan pesanan ini?')" class="w-fit bg-blue-500 text-white text-xs sm:text-sm font-medium px-2 py-1 rounded hover:bg-blue-400 transition duration-300 ease-in-out">
              Selesaikan
            </button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="w-full bg-blue-100 p-4 text-center rounded border-2 border-blue-200 sm:text-sm">
      <p>
        Belum ada pesanan yang diproses.
      </p>
    </div>
  <?php endif; ?>

  <!-- Selesai -->
  <h2 class="font-semibold text-gray-600 mb-2 mt-2 sm:mt-4 pt-4 border-t-2 text-center sm:text-left">
    Selesai:
  </h2>
  <?php if (!empty($pesananSelesai)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-4">
      <?php foreach ($pesananSelesai as $item): ?>
        <div class="p-2 sm:p-4 rounded-md border-2 border-gray-200 flex flex-col justify-between gap-2 sm:gap-4">
          <div>
            <div class="flex items-center justify-between">
              <h3 class="font-semibold text-sm">Pesanan #<?= $item['id_pesanan'] ?> : <span class="text-green-500 font-bold uppercase"><?= $item['username'] ?></span></h3>
              <p class="text-xs sm:text-sm"><?= $item['tanggal_pesanan'] ?></p>
            </div>
            <p class="text-xs mt-2 sm:text-sm line-through text-gray-500 font-medium decoration-[1.25px] decoration-red-500"><?= $item['daftar_menu'] ?></p>
          </div>
          <form action="" method="post" class="w-full">
            <p class="text-xs sm:text-sm font-semibold mb-2">Total: Rp <?= number_format($item['total_harga'], 0, ",", ".") ?></p>
            <input type="hidden" name="id_pesanan" value="<?= $item['id_pesanan'] ?>">
            <button type="submit" name="batalkan_selesai" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="w-fit bg-stone-400 text-white text-xs sm:text-sm font-semibold px-2 py-1 rounded hover:bg-stone-300 transition duration-300 ease-in-out">
              Batalkan selesai
            </button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="w-full bg-blue-100 p-4 text-center rounded border-2 border-blue-200 sm:text-sm">
      <p>
        Belum ada pesanan yang selesai.
      </p>
    </div>
  <?php endif; ?>


</div>