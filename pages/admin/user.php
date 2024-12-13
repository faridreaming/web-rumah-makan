<?php
require_once("./functions.php");

$users = query("SELECT
                  u.username,
                  u.no_hp,
                  COUNT(p.id_pesanan) AS total_transaksi,
                  SUM(p.total_harga) AS total_pengeluaran,
                  SUM(p.jumlah_menu) AS total_menu
                FROM user u
                LEFT JOIN pesanan p ON u.id_user = p.id_user
                GROUP BY u.id_user");
?>

<div class="p-2 sm:p-4">
  <h2 class="font-semibold text-gray-600 mb-2 text-center sm:text-left">Daftar User</h2>
  <?php if (!empty($users)): ?>
    <div class="overflow-auto">
      <table class="font-medium [&_tr>*]:py-2 [&_tr>*]:w-max [&_tr>*:not(:first-child)]:px-8 w-full [&_tr]:border-b-2 [&_tr]:border-gray-200 sm:text-sm">
        <thead class="uppercase text-gray-500 text-left text-[10px]">
          <tr class="whitespace-nowrap">
            <th>Username</th>
            <th>No. HP</th>
            <th>Total Transaksi</th>
            <th>Total Pengeluaran</th>
            <th>Total Menu Dipesan</th>
          </tr>
        </thead>
        <tbody class="text-xs sm:text-sm">
          <?php foreach ($users as $item): ?>
            <tr class="text-gray-600">
              <td><?= ucfirst($item['username']) ?></td>
              <td><?= $item['no_hp'] ?></td>
              <td><?= $item['total_transaksi'] ?>x</td>
              <td class="whitespace-nowrap">Rp <?= number_format($item['total_pengeluaran'], 0, ",", ".") ?></td>
              <td><?= $item['total_menu'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="w-full bg-blue-100 p-4 text-center rounded border-2 border-blue-200 sm:text-sm">
      <p>Daftar user masih kosong.</p>
    </div>
  <?php endif; ?>
</div>