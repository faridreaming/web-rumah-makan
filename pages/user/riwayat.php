<?php
require_once("./functions.php");

$user = query("SELECT username FROM user WHERE id_user = $id_user")[0]["username"];

$riwayat = query("SELECT pesanan.*, user.username FROM pesanan
                    JOIN user ON pesanan.id_user = user.id_user
                    WHERE user.username = '$username'");
?>


<div class="p-2 sm:p-4">
  <h2 class="font-semibold text-gray-600 mb-2 text-center sm:text-left">Riwayat Pemesanan</h2>
  <?php if (!empty($riwayat)): ?>
    <div class="overflow-auto">
      <table class="font-medium [&_tr>*]:py-2 [&_tr>*]:w-max [&_tr>*:not(:first-child)]:px-8 w-full [&_tr]:border-b-2 [&_tr]:border-gray-200 sm:text-sm">
        <thead class="uppercase text-gray-500 text-left text-[10px]">
          <tr class="whitespace-nowrap">
            <th>Tanggal</th>
            <th>Jumlah Menu</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody class="text-xs sm:text-sm">
          <?php foreach ($riwayat as $item): ?>
            <tr class="text-gray-600">
              <td class="whitespace-nowrap"><?= $item['tanggal_pesanan'] ?></td>
              <td><?= $item['jumlah_menu'] ?></td>
              <td>Rp <?= number_format($item['total_harga'], 0, ",", ".") ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="w-full bg-blue-100 p-4 text-center rounded border-2 border-blue-200 sm:text-sm">
      <p>Riwayat masih kosong.</p>
    </div>
  <?php endif; ?>
</div>