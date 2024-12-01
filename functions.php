<?php
// File ini berisi fungsi-fungsi atau utilitas-utilitas yang digunakan selama pengembangan

// Koneksi
$conn = mysqli_connect("localhost", "root", "", "rm_padang");
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Query data
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)):
    $rows[] = $row;
  endwhile;
  return $rows;
}
