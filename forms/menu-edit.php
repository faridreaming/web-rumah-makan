<?php
require_once("./functions.php");
$id = $_GET["id"];
$menu = query("SELECT * FROM menu WHERE id_menu = $id")[0];
?>

<div class="p-2 sm:p-4 font-medium whitespace-nowrap mt-2 sm:mt-0">
  <div class="grid gap-4 max-w-xl">
    <div class="flex items-center justify-center sm:justify-start gap-1 sm:gap-2 pb-2">
      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="fill-gray-500 focus:bg-blue-400 h-5 sm:h-7">
        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
      </svg>
      <h4 class="uppercase text-gray-500 focus:bg-blue-400 text-left text-xs font-semibold">Edit menu</h4>
    </div>
    <form action="./execute.php" method="post" enctype="multipart/form-data" class="grid gap-2 sm:gap-4 [&>div>label]:text-xs sm:[&>div>label]:text-sm">
      <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>">
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="nama_menu" class="text-blue-500 font-semibold">Nama Menu</label>
        <input type="text" name="nama_menu" id="nama_menu" value="<?= $menu['nama_menu'] ?>" required class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent" spellcheck="false">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="harga_menu" class="text-blue-500 font-semibold">Harga Menu (Rp.)</label>
        <input type="number" name="harga_menu" id="harga_menu" value="<?= intval($menu['harga_menu']) ?>" required class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent" spellcheck="false">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="jenis_menu" class="text-blue-500 font-semibold">Jenis Menu</label>
        <select name="jenis_menu" id="jenis_menu" class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent">
          <option value="Makanan" <?php echo $menu['jenis_menu'] === 'Makanan' ? "selected" : "" ?>>Makanan</option>
          <option value="Minuman" <?php echo $menu['jenis_menu'] === 'Minuman' ? "selected" : "" ?>>Minuman</option>
        </select>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="stok" class="text-blue-500 font-semibold">Stok</label>
        <input type="number" name="stok" id="stok" value="<?= $menu['stok'] ?>" required class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent" spellcheck="false">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="gambar" class="text-blue-500 font-semibold">Gambar</label>
        <div class="relative group">
          <label for="gambar" id="file-name" class="flex items-center w-full px-2 py-1 border-2 border-gray-200 text-gray-400 cursor-pointer bg-white transition-all duration-300 group-focus-within:border-gray-400 group-focus-within:text-gray-800">
            <?php echo $menu['gambar'] ? $menu['gambar'] : "Pilih Gambar"  ?>
          </label>
          <input type="file" name="gambar" id="gambar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
        </div>
        <div class="flex sm:flex-row flex-col gap-2 sm:col-span-2 place-self-end w-full sm:w-fit mt-2">
          <button type="reset" class="bg-gray-200 text-gray-600 p-2 px-4 rounded text-xs font-normal outline-none hover:text-gray-400 transition duration-300 ease-in-out sm:w-fit w-full ring-gray-300 focus:ring">Reset</button>
          <button type="submit" name="edit_menu" class="bg-blue-500 text-white p-2 px-4 rounded text-xs font-semibold outline-none hover:bg-blue-400 transition duration-300 ease-in-out sm:w-fit w-full focus:ring">Simpan Perubahan</button>
        </div>
      </div>
    </form>
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