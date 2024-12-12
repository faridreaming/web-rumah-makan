<?php
require_once("./components/toast.php");
require_once("./functions.php");

$user = query("SELECT username FROM user WHERE id_user = $id_user")[0]["username"];


if (isset($_POST['batalkan_pesanan'])) {
  $id_pesanan = $_POST['id_pesanan'];
  $queryHapusDetailPesanan = "DELETE FROM detail_pesanan WHERE id_pesanan = $id_pesanan";
  $queryHapusPesanan = "DELETE FROM pesanan WHERE id_pesanan = $id_pesanan";

  // Update stok
  $detailPesanan = query("SELECT * FROM detail_pesanan WHERE id_pesanan = $id_pesanan");
  $queryTambahStok = "";
  foreach ($detailPesanan as $item) {
    $id_menu = $item['id_menu'];
    $jumlah = $item['jumlah'];
    $queryTambahStok .= "UPDATE menu SET stok = stok + $jumlah WHERE id_menu = $id_menu;";
  }

  if (!mysqli_query($conn, $queryHapusDetailPesanan) || !mysqli_query($conn, $queryHapusPesanan) || !mysqli_query($conn, $queryTambahStok)) {
    $_SESSION['error'] = 'Gagal membatalkan pesanan.';
    header("Location: app.php?page=pesanan");
    exit();
  }

  $_SESSION['success'] = 'Pesanan berhasil dibatalkan.';
?>
  <script type="text/javascript">
    window.location.href = 'app.php?page=pesanan';
  </script>
<?php
  exit();
}

if (isset($_POST['checkout'])) {
  $keranjang = query("SELECT keranjang.*, menu.stok, menu.harga_menu FROM keranjang
                        JOIN menu ON keranjang.id_menu = menu.id_menu 
                        WHERE keranjang.id_user = $id_user");
  $jumlahMenu = 0;
  $totalHarga = 0;
  $tanggalPesanan = date('Y-m-d');
  foreach ($keranjang as $item) {
    $jumlahMenu += $item['jumlah'];
    $totalHarga += $item['jumlah'] * $item['harga_menu'];
  }

  $queryPesanan = "INSERT INTO pesanan (id_user, jumlah_menu, total_harga, tanggal_pesanan, status_pesanan) 
                    VALUES ($id_user, " . $jumlahMenu . ", $totalHarga, '$tanggalPesanan', 'Diproses')";
  if (!mysqli_query($conn, $queryPesanan)) {
    $_SESSION['error'] = 'Gagal menyimpan pesanan.';
    header("Location: app.php?page=pesanan");
    exit();
  }

  $idPesanan = mysqli_insert_id($conn);

  foreach ($keranjang as $item) {
    $id_menu = $item['id_menu'];
    $jumlah = $item['jumlah'];
    $queryKurangiStok = "UPDATE menu SET stok = stok - $jumlah WHERE id_menu = $id_menu";
    $queryHapusKeranjang = "DELETE FROM keranjang WHERE id_user = $id_user AND id_menu = $id_menu";
    $queryDetailPesanan = "INSERT INTO detail_pesanan (id_pesanan, id_menu, jumlah) VALUES ($idPesanan, $id_menu, $jumlah)";

    if (!mysqli_query($conn, $queryKurangiStok) || !mysqli_query($conn, $queryHapusKeranjang) || !mysqli_query($conn, $queryDetailPesanan)) {
      $_SESSION['error'] = 'Gagal menyimpan detail pesanan.';
      header("Location: app.php?page=pesanan");
      exit();
    }
  }

  $_SESSION['success'] = 'Pesanan sedang diproses. Terima kasih!';
?>
  <script type="text/javascript">
    window.location.href = 'app.php?page=pesanan';
  </script>
<?php
  exit();
}

$pesanan = query("SELECT 
                    p.id_pesanan, 
                    p.jumlah_menu, 
                    p.total_harga, 
                    p.tanggal_pesanan, 
                    p.status_pesanan,
                    GROUP_CONCAT(CONCAT(m.nama_menu, ' x ', dp.jumlah) SEPARATOR '<br>') AS daftar_menu

                  FROM pesanan p
                  JOIN detail_pesanan dp ON p.id_pesanan = dp.id_pesanan
                  JOIN menu m ON dp.id_menu = m.id_menu
                  WHERE p.id_user = $id_user AND p.status_pesanan = 'Diproses'
                  GROUP BY p.id_pesanan");
?>

<div class="p-2 sm:p-4">
  <h2 class="font-semibold text-gray-600 mb-2 text-center sm:text-left">Daftar Pesanan</h2>

  <?php if (!empty($pesanan)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-4">
      <?php foreach ($pesanan as $item): ?>
        <div class="p-2 sm:p-4 rounded-md border-2 border-gray-200 flex flex-col justify-between gap-2 sm:gap-4">
          <div>
            <div class="flex items-center justify-between">
              <h3 class="font-semibold text-sm">Pesanan #<?= $item['id_pesanan'] ?></h3>
              <p class="text-xs sm:text-sm"><?= $item['tanggal_pesanan'] ?></p>
            </div>
            <p class="text-xs mt-2 sm:text-sm"><?= $item['daftar_menu'] ?></p>
          </div>
          <form action="" method="post" class="w-full">
            <p class="text-xs sm:text-sm font-semibold mb-2">Total: Rp <?= number_format($item['total_harga'], 0, ",", ".") ?></p>
            <input type="hidden" name="id_pesanan" value="<?= $item['id_pesanan'] ?>">
            <button type="submit" name="batalkan_pesanan" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="w-fit bg-red-500 text-white text-xs sm:text-sm font-medium px-2 py-1 rounded hover:bg-red-400 transition duration-300 ease-in-out">
              Batalkan
            </button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="w-full bg-blue-100 p-4 text-center rounded border-2 border-blue-200 sm:text-sm">
      <p>
        Belum ada pesanan.
      </p>
    </div>
  <?php endif; ?>

</div>