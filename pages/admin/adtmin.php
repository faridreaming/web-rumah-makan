<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="shortcut icon"
    href="./dist/assets/logo-white.svg"
    type="image/x-icon" />
  <title>Dashboard Admin</title>
</head>

<body class="bg-gray-100">
  <div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 text-white">
      <div class="p-4 text-center font-bold text-xl">Admin Rumah Makan Padang</div>
      <nav class="mt-6">
        <ul>
          <li class="px-4 py-2 hover:bg-green-600">
            <a href="#" class="block">🏠 Dashboard</a>
          </li>
          <li class="px-4 py-2 hover:bg-green-600">
            <a href="#" class="block">🍛 Kelola Menu</a>
          </li>
          <li class="px-4 py-2 hover:bg-green-600">
            <a href="#" class="block">📦 Kelola Pesanan</a>
          </li>
          <li class="px-4 py-2 hover:bg-green-600">
            <a href="#" class="block">⚙️ Pengaturan</a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Header -->
      <header class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Dashboard Admin</h1>
        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
      </header>

      <!-- Stats -->
      <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-lg font-bold">Total Penjualan</h2>
          <p class="text-2xl font-semibold mt-2">Rp 15,000,000</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-lg font-bold">Pesanan Hari Ini</h2>
          <p class="text-2xl font-semibold mt-2">25</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-lg font-bold">Menu Tersedia</h2>
          <p class="text-2xl font-semibold mt-2">50</p>
        </div>
      </div>

      <!-- Recent Orders -->
      <div class="mt-6 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Pesanan Terbaru</h2>
        <table class="w-full text-left">
          <thead>
            <tr class="border-b">
              <th class="pb-2">#</th>
              <th class="pb-2">Nama Pelanggan</th>
              <th class="pb-2">Menu</th>
              <th class="pb-2">Total</th>
              <th class="pb-2">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Ahmad</td>
              <td>Rendang</td>
              <td>Rp 50,000</td>
              <td class="text-green-600">Selesai</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Reza</td>
              <td>Ayam Pop</td>
              <td>Rp 45,000</td>
              <td class="text-yellow-500">Diproses</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>

</html>