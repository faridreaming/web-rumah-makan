<?php
require_once "./functions.php";

if (isset($_GET["keyword"])) {
  $keyword = $_GET["keyword"];
  $menus = query("SELECT * FROM menu WHERE nama_menu LIKE '%$keyword%'");
} else {
  $menus = query("SELECT * FROM menu");
}

$totalMenu = count($menus);
?>
<div class="p-2 sm:p-4 flex flex-col gap-4 text-xs sm:text-sm">
  <div class="flex flex-col-reverse sm:flex-row sm:justify-between gap-2 sm:items-center">
    <p class="font-medium"><span class="text-gray-500">Total menu:</span> <span class="font-bold"><?= $totalMenu ?></span></p>

    <form action="" method="get" class="w-full sm:w-1/2 rounded border-2 border-gray-200 flex group focus-within:border-gray-400 transition-all font-medium overflow-hidden">
      <input type="hidden" name="page" value="menu">
      <input
        type="text"
        name="keyword"
        spellcheck="false"
        placeholder="Cari menu..."
        <?php $src = './dist/imgs/menu/default.jpg';
        isset($_GET["keyword"]) ? "value='$keyword'" : ""; ?>
        class="w-full p-1 placeholder:text-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent">
      <button
        type="submit"
        class="p-1 pointer-events-none group-focus-within:pointer-events-auto group-focus-within:hover:bg-gray-400 group-focus-within:[&>svg]:hover:fill-white group-focus-within:focus:bg-gray-400 group-focus-within:[&>svg]:focus:fill-white transition duration-300 ease-in-out outline-none bg-transparent">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          height="24px"
          viewBox="0 -960 960 960"
          width="24px"
          class="fill-gray-200 group-focus-within:fill-gray-400 transition-colors">
          <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
        </svg>
      </button>
    </form>

  </div>

  <div class="font-medium">
    <a href="?page=menu&action=add" class="rounded bg-blue-500 py-1 px-2 hover:bg-blue-400 transition duration-300 ease-in-out flex items-center text-white w-fit gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#FFFFFF" class="h-5">
        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
      </svg>
      Menu baru
    </a>
  </div>

  <div class="overflow-auto text-xs sm:text-sm">
    <table class="font-medium [&_tr>*]:py-2 [&_tr>*]:w-max [&_tr>*:not(:first-child)]:px-8 w-full [&_tr]:border-b-2 [&_tr]:border-gray-200">
      <thead class="uppercase text-gray-500 text-left text-[10px]">
        <tr class="whitespace-nowrap">
          <th>Menu</th>
          <th>Harga</th>
          <th>Jenis Menu</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($menus as $menu): ?>
          <tr>
            <td class="flex items-center gap-2">
              <?php
              if (is_null($menu['gambar'])) {
                $src = './dist/imgs/blank.webp';
              } else {
                $src = './dist/imgs/menu/' . $menu['gambar'];
              }
              ?>
              <img src="<?= $src ?>" alt="<?= $menu['nama_menu'] ?>" class="w-10 h-10 aspect-square object-cover rounded-full">
              <?= $menu["nama_menu"] ?>
            </td>
            <td><?= "Rp " . number_format($menu["harga_menu"], 0, ",", ".") ?></td>
            <td><?= $menu["jenis_menu"] ?></td>
            <td><?= $menu["stok"] ?></td>
            <td>
              <div class="flex gap-1">
                <a href="?page=menu&action=edit&id=<?= $menu['id_menu'] ?>" title="Edit" class="rounded bg-blue-500 p-2 hover:bg-blue-400 transition duration-300 ease-in-out">
                  <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#FFFFFF">
                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                  </svg>
                </a>
                <form action="./execute.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus <?= $menu['nama_menu'] ?>?')">
                  <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>">
                  <button title="Hapus" name="hapus_menu" class="rounded bg-red-500 p-2 hover:bg-red-400 transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="#FFFFFF">
                      <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php
if (isset($_SESSION["success"])) {
  echo '<div id="toast-message" 
    class="bg-gray-800 rounded p-2 fixed right-1/2 translate-x-1/2 bottom-[-100px] text-white font-medium w-fit transition-all duration-500 ease-in-out">'
    . $_SESSION["success"] . '</div>';
  unset($_SESSION["success"]);
} else if (isset($_SESSION["error"])) {
  echo '<div id="toast-message" 
    class="bg-red-500 rounded p-2 fixed right-1/2 translate-x-1/2 bottom-[-100px] text-white font-medium w-fit transition-all duration-500 ease-in-out">'
    . $_SESSION["error"] . '</div>';
  unset($_SESSION["error"]);
}
?>