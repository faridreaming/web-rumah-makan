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

$menus = query("SELECT * FROM menu");

$user = query("SELECT id_user FROM user WHERE username = '$username'")[0];
$id_user = $user['id_user'];
$keranjang = query("SELECT k.*, m.nama_menu, m.harga_menu FROM keranjang k JOIN menu m ON k.id_menu = m.id_menu WHERE k.id_user = '$id_user'");

foreach ($menus as $menu) {
  if (isset($_POST["tambah-{$menu['id_menu']}"])) {
    $id_menu = $menu['id_menu'];
    $jumlah = (int)$_POST["jumlah-{$menu['id_menu']}"];

    $existing = query("SELECT * FROM keranjang WHERE id_user = '$id_user' AND id_menu = '$id_menu'");

    if ($existing) {
      mysqli_query($conn, "UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE id_user = $id_user AND id_menu = $id_menu");
    } else {
      mysqli_query($conn, "INSERT INTO keranjang (id_user, id_menu, jumlah) VALUES ($id_user, $id_menu, $jumlah)");
    }
?>
    <script type="text/javascript">
      window.location.href = '<?= $_SERVER['PHP_SELF'] ?>';
    </script>
  <?php
    exit();
  }
}

foreach ($keranjang as $item) {
  if (isset($_POST["hapus-$item[id_keranjang]"])) {
    if (mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = $item[id_keranjang]")) {
      $_SESSION["success"] = "Item {$item['nama_menu']} berhasil dihapus dari keranjang.";
    } else {
      $_SESSION["error"] = "Gagal menghapus item dari keranjang. Silakan coba lagi.";
    }
  ?>
    <script type="text/javascript">
      window.location.href = '<?= $_SERVER['PHP_SELF'] ?>';
    </script>
<?php
  }
}
?>
<div class="p-2 sm:p-4">
  <div class="flex flex-col gap-2 px-2 sm:px-0 pt-6 pb-8 sm:pb-10 border-b-2 border-gray-200 text-center sm:text-left">
    <h2 class="text-xl sm:text-3xl font-bold text-gray-700">Halo, <?= ucfirst($username) ?>!</h2>
    <p class="text-xs sm:text-sm">
      Selamat datang di Rumah Makan Padang Bunga ACC. Silakan pilih menu favorit Anda.
    </p>
  </div>
  <h2 class="mt-4 font-semibold text-gray-600 mb-2">Menu Hari Ini:</h2>
  <div class="overflow-x-auto scrollbar-none border-b-2 border-gray-200">
    <div class="flex space-x-2 pb-4">
      <?php foreach ($menus as $menu): ?>
        <div class="flex-shrink-0 w-36 bg-white sm:w-fit rounded-md border-2 border-gray-200 overflow-hidden">
          <img
            src="<?= $menu['gambar'] ? './dist/imgs/menu/' . $menu['gambar'] : './dist/imgs/blank.webp' ?>"
            alt="<?= $menu['nama_menu'] ?>"
            class="w-36 h-36 sm:w-48 sm:h-48 object-cover">
          <div class="p-2 flex flex-col gap-1 sm:gap-2">
            <div class="flex flex-col sm:gap-1">
              <h3 class="font-semibold text-sm sm:text-base text-gray-700"><?= $menu['nama_menu'] ?></h3>
              <p class="text-xs sm:text-sm text-gray-500 font-semibold">Rp <?= number_format($menu['harga_menu'], 0, ',', '.') ?></p>
              <p class="text-[10px] sm:text-xs font-medium text-gray-500"><span>Stok: <?= $menu['stok'] ?></span></p>
            </div>
            <form action="" method="post" class="flex gap-2 flex-col">
              <input
                type="number"
                name="jumlah-<?= $menu['id_menu'] ?>"
                id="jumlah-<?= $menu['id_menu'] ?>"
                min="1"
                max="<?= $menu['stok'] ?>"
                placeholder="Jumlah"
                required
                class="input-jumlah rounded font-medium border-2 border-gray-200 px-2 py-1 text-gray-500 outline-none transition-all ease-in-out duration-[250ms] focus:border-gray-400 focus:text-gray-800 text-xs sm:text-sm w-full">
              <button type="submit" name="tambah-<?= $menu['id_menu'] ?>" id="tambah-<?= $menu['id_menu'] ?>" class="bg-green-500 px-2 py-1 rounded text-white font-medium text-xs sm:text-sm w-fit outline-none hover:bg-green-400 focus:bg-green-400 transition ease-in-out duration-300">Tambah</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <h2 class="mt-4 font-semibold text-gray-600 mb-2">Keranjang:</h2>
  <div class="text-xs">
    <!-- Keranjang -->
    <?php if (!empty($keranjang)): ?>
      <form action="./execute.php" method="post">
        <div class="overflow-auto">
          <table class="font-medium [&_tr>*]:py-2 [&_tr>*]:w-max [&_tr>*:not(:first-child)]:px-8 w-full [&_tr]:border-b-2 [&_tr]:border-gray-200 sm:text-sm">
            <thead class="uppercase text-gray-500 text-left text-[10px]">
              <tr class="whitespace-nowrap">
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $totalKeseluruhan = 0;
              foreach ($keranjang as $item):
                $totalKeseluruhan += $item['harga_menu'] * $item['jumlah'];
              ?>
                <tr>
                  <td class="whitespace-nowrap"><?= $item['nama_menu'] ?></td>
                  <td><?= $item['jumlah'] ?></td>
                  <td class="whitespace-nowrap"><?= "Rp " . number_format($item['harga_menu'] * $item['jumlah'], 0, ",", ".") ?></td>
                  <td>
                    <form action="" method="post">
                      <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $item['nama_menu'] ?> dari keranjang?')" name="hapus-<?= $item['id_keranjang'] ?>"
                        class="rounded bg-red-500 p-2 hover:bg-red-400 transition duration-300 ease-in-out"
                        title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#FFFFFF">
                          <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                        </svg>
                      </button>
                    </form>
                  </td>
                </tr>
                <input type="hidden" name="id_menu" value="<?= $item['id_menu'] ?>">
                <input type="hidden" name="jumlah" value="<?= $item['jumlah'] ?>">
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div>

        </div>
        <div class="sm:mt-4 flex justify-end">
          <div class="flex flex-col items-center w-full sm:w-fit gap-1">
            <span class="text-xs sm:text-sm font-medium hidden sm:inline">
              <span class="text-gray-500">Total:</span> Rp <?= number_format($totalKeseluruhan, 0, ",", ".") ?>
            </span>
            <button type="submit" name="checkout" id="checkout" onclick="return confirm('Checkout sekarang?')" class="font-semibold rounded bg-green-500 p-4 sm:px-4 sm:p-2 hover:bg-green-400 transition duration-300 ease-in-out flex items-center text-white gap-2 mt-2 sm:mt-0 w-full justify-center sm:text-sm sm:w-fit text-right">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-4 sm:w-5" fill="#FFFFFF">
                <path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
              </svg>
              Checkout<span class="sm:hidden"> Rp <?= number_format($totalKeseluruhan, 0, ",", ".") ?></span>
            </button>
          </div>
        </div>
      </form>
    <?php else: ?>
      <div id="cart-message" class="w-full bg-blue-100 p-4 text-center rounded border-2 border-blue-200">
        <p>Keranjang masih kosong.</p>
      </div>
    <?php endif; ?>
  </div>

</div>