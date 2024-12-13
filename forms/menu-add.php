<div class="p-2 sm:p-4 font-medium whitespace-nowrap mt-2 sm:mt-0">
  <div class="grid gap-4 max-w-xl">
    <div class="flex items-center justify-center sm:justify-start gap-1 sm:gap-2 pb-2">
      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="fill-gray-500 focus:bg-blue-400 h-5 sm:h-7">
        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
      </svg>
      <h4 class="uppercase text-gray-500 focus:bg-blue-400 text-left text-xs font-semibold">Menu baru</h4>
    </div>
    <form action="./execute.php" method="post" enctype="multipart/form-data" class="grid gap-2 sm:gap-4 [&>div>label]:text-xs sm:[&>div>label]:text-sm">
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="nama_menu" class="text-blue-500 font-semibold">Nama Menu</label>
        <input type="text" name="nama_menu" id="nama_menu" required class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent" spellcheck="false">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="harga_menu" class="text-blue-500 font-semibold">Harga Menu (Rp.)</label>
        <input type="number" name="harga_menu" id="harga_menu" required class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent" spellcheck="false">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="jenis_menu" class="text-blue-500 font-semibold">Jenis Menu</label>
        <select name="jenis_menu" id="jenis_menu" class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent">
          <option value="Makanan">Makanan</option>
          <option value="Minuman">Minuman</option>
        </select>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="stok" class="text-blue-500 font-semibold">Stok</label>
        <input type="number" name="stok" id="stok" required class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent" spellcheck="false">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
        <label for="gambar" class="text-blue-500 font-semibold">Gambar</label>
        <div class="relative group">
          <label for="gambar" id="file-name" class="flex items-center w-full px-2 py-1 border-2 border-gray-200 text-gray-400 cursor-pointer bg-white transition-all duration-300 group-focus-within:border-gray-400 group-focus-within:text-gray-800">
            Pilih Gambar
          </label>
          <input type="file" name="gambar" id="gambar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
        </div>
        <div class="flex sm:flex-row flex-col gap-2 sm:col-span-2 place-self-end w-full sm:w-fit mt-2">
          <button type="reset" class="bg-gray-200 text-gray-600 p-2 px-4 rounded text-xs font-normal outline-none hover:text-gray-400 transition duration-300 ease-in-out sm:w-fit w-full ring-gray-300 focus:ring">Reset</button>
          <button type="submit" name="tambah_menu" class="bg-blue-500 text-white p-2 px-4 rounded text-xs font-semibold outline-none hover:bg-blue-400 transition duration-300 ease-in-out sm:w-fit w-full focus:ring">Tambah Menu</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
require_once("./components/toast.php");
?>