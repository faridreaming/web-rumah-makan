<div class="p-2 sm:p-4">
  <div class="flex flex-col gap-2 p-2 pb-4 border-b-2 border-gray-200">
    <h2 class="text-xl font-bold text-gray-700">Halo, <?= $username ?>!</h2>
    <p class="text-xs">
      Selamat datang di Rumah Makan Padang Bunga ACC. Silakan pilih menu favorit Anda.
    </p>
  </div>
  <h2 class="mt-4 font-semibold text-gray-600 mb-2">Menu Hari Ini:</h2>
  <div class="overflow-x-auto border-b-2 border-gray-200">
    <div class="flex space-x-2 pb-4">
      <?php foreach ($menus as $menu): ?>
        <div class="flex-shrink-0 w-36 bg-white rounded-md border-2 border-gray-200 overflow-hidden">
          <img
            src="<?= $menu['gambar'] ? './dist/imgs/menu/' . $menu['gambar'] : './dist/imgs/blank.webp' ?>"
            alt="<?= $menu['nama_menu'] ?>"
            class="w-36 h-36 object-cover">
          <div class="p-2 flex flex-col gap-1">
            <div>
              <h3 class="font-semibold text-sm text-gray-700"><?= $menu['nama_menu'] ?></h3>
              <p class="text-xs text-gray-500 font-semibold">Rp <?= number_format($menu['harga_menu'], 0, ',', '.') ?></p>
              <p class="text-[10px] font-medium text-gray-500"><span>Stok: <?= $menu['stok'] ?></span></p>
            </div>
            <form class="flex gap-2 flex-col tambah-menu" data-menu-id="<?= $menu['id_menu'] ?>" data-menu-nama="<?= $menu['nama_menu'] ?>" data-menu-harga="<?= $menu['harga_menu'] ?>">
              <input
                type="number"
                min="1"
                max="<?= $menu['stok'] ?>"
                placeholder="Jumlah"
                required
                class="input-jumlah rounded font-medium border-2 border-gray-200 px-2 py-1 text-gray-500 outline-none transition-all ease-in-out duration-[250ms] focus:border-gray-400 focus:text-gray-800 text-xs w-full">
              <button type="submit" class="bg-green-500 px-2 py-1 rounded text-white font-medium text-xs w-fit">Tambah</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <h2 class="mt-4 font-semibold text-gray-600 mb-2">Keranjang:</h2>
  <div>
    <!-- Keranjang -->
    <div data-cart-container class="border-2 border-gray-200 rounded-md <?= empty($cart) ? 'hidden' : '' ?>">
      <div data-cart-items>
        <!-- Item keranjang akan dimuat di sini -->
      </div>
      <div data-cart-total>
        <!-- Total harga akan dimuat di sini -->
      </div>
      <div class="p-2">
        <button class="w-full bg-blue-500 text-white py-2 rounded-md">
          Pesan Sekarang
        </button>
      </div>
    </div>
  </div>
</div>