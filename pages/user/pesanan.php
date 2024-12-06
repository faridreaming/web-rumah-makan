<?php
if (isset($_SESSION["success"])) {
  echo '<div id="toast-message" 
    class="bg-gray-800 rounded p-2 fixed right-1/2 translate-x-1/2 bottom-[-100px] text-white font-medium w-fit transition-all duration-500 ease-in-out text-center">'
    . $_SESSION["success"] . '</div>';
  unset($_SESSION["success"]);
} else if (isset($_SESSION["error"])) {
  echo '<div id="toast-message" 
    class="bg-red-500 rounded p-2 fixed right-1/2 translate-x-1/2 bottom-[-100px] text-white font-medium w-fit transition-all duration-500 ease-in-out text-center">'
    . $_SESSION["error"] . '</div>';
  unset($_SESSION["error"]);
}
require_once("./functions.php");

$user = query("SELECT id_user FROM user WHERE username = '$username'")[0];
$id_user = $user['id_user'];

if (isset($_POST['checkout'])) {
  $keranjang = query("SELECT k.*, m.stok, m.harga_menu FROM keranjang k 
                        JOIN menu m ON k.id_menu = m.id_menu 
                        WHERE k.id_user = $id_user");
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
?>
    <script type="text/javascript">
      window.location.href = 'app.php?page=pesanan';
    </script>
    <?php
    exit();
  }

  $idPesanan = mysqli_insert_id($conn);

  foreach ($keranjang as $item) {
    $id_menu = $item['id_menu'];
    $jumlah = $item['jumlah'];
    $queryKurangiStok = "UPDATE menu SET stok = stok - $jumlah WHERE id_menu = $id_menu";
    $queryHapusKeranjang = "DELETE FROM keranjang WHERE id_user = $id_user AND id_menu = $id_menu";

    if (!mysqli_query($conn, $queryKurangiStok) || !mysqli_query($conn, $queryHapusKeranjang)) {
      $_SESSION['error'] = 'Gagal memperbarui data stok atau menghapus keranjang.';
    ?>
      <script type="text/javascript">
        window.location.href = 'app.php?page=pesanan';
      </script>
  <?php
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

$pesanan = query("SELECT * FROM pesanan WHERE id_user = $id_user");

if (!empty($pesanan)): ?>
  <table class="table-auto w-full">
    <thead>
      <tr>
        <th>ID Pesanan</th>
        <th>Jumlah Menu</th>
        <th>Total Harga</th>
        <th>Tanggal Pesanan</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pesanan as $item): ?>
        <tr>
          <td><?= $item['id_pesanan'] ?></td>
          <td><?= $item['jumlah_menu'] ?></td>
          <td>Rp <?= number_format($item['total_harga'], 0, ",", ".") ?></td>
          <td><?= $item['tanggal_pesanan'] ?></td>
          <td><?= $item['status_pesanan'] ?></td>
          <td>
            <?php if ($item['status_pesanan'] == 'Diproses'): ?>
              <form action="ubah_status.php" method="post">
                <input type="hidden" name="id_pesanan" value="<?= $item['id_pesanan'] ?>">
                <button type="submit" name="selesai" class="bg-green-500 text-white px-2 py-1 rounded">Tandai Selesai</button>
                <button type="submit" name="batalkan" class="bg-red-500 text-white px-2 py-1 rounded">Batalkan</button>
              </form>
            <?php else: ?>
              <span class="text-gray-500">Tidak Ada Aksi</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>Tidak ada pesanan.</p>
<?php endif; ?>