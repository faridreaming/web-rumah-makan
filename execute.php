<?php
session_start();
require_once "./functions.php";

// Login
if (isset($_POST["login"])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  // Cek ke tabel admin
  $queryAdmin = "SELECT * FROM admin WHERE username = '$username'";
  $resultAdmin = mysqli_query($conn, $queryAdmin);

  if ($resultAdmin && mysqli_num_rows($resultAdmin) > 0) {
    $rowAdmin = mysqli_fetch_assoc($resultAdmin);
    if ($password === $rowAdmin["password"]) {
      $_SESSION["username"] = $username;
      $_SESSION["role"] = "admin";
      header("Location: dashboard.php");
      exit();
    }
  }

  // Cek ke tabel user
  $queryUser = "SELECT * FROM user WHERE username = '$username'";
  $resultUser = mysqli_query($conn, $queryUser);

  if ($resultUser && mysqli_num_rows($resultUser) > 0) {
    $rowUser = mysqli_fetch_assoc($resultUser);
    if ($password === $rowUser["password"]) {
      $_SESSION["username"] = $username;
      $_SESSION["role"] = "user";
      header("Location: app.php");
      exit();
    }
  }

  // Jika username atau password salah
  $_SESSION["errorAuth"] = [
    "message" => "Username atau password salah.",
    "type" => "login",
    "username" => $username,
    "password" => $password,
  ];
  header("Location: index.php");
  exit();
}

// Register
if (isset($_POST["register"])) {
  $username = mysqli_real_escape_string($conn, $_POST["register_username"]);
  $password = mysqli_real_escape_string($conn, $_POST["register_password"]);
  $number = mysqli_real_escape_string($conn, $_POST["number"]);

  // Cek apakah username sudah ada di tabel admin atau user
  $queryCheck = "SELECT username FROM (
        SELECT username FROM admin
        UNION
        SELECT username FROM user
    ) AS combined WHERE username = '$username'";

  $resultCheck = mysqli_query($conn, $queryCheck);

  if ($resultCheck && mysqli_num_rows($resultCheck) > 0) {
    $_SESSION["errorAuth"] = [
      "message" => "Username sudah terdaftar.",
      "type" => "register",
      "username" => $username,
      "password" => $password,
      "number" => $number,
    ];
    header("Location: index.php#auth_toggle");
    exit();
  }

  // Insert ke tabel user
  $queryInsert = "INSERT INTO user (username, no_hp, password) VALUES ('$username', '$number', '$password')";
  $resultInsert = mysqli_query($conn, $queryInsert);

  if ($resultInsert) {
    $_SESSION["successAuth"] = [
      "message" => "Pendaftaran berhasil! Silakan login.",
      "type" => "register",
    ];
    header("Location: index.php#auth_toggle");
    exit();
  } else {
    $_SESSION["errorAuth"] = [
      "message" => "Terjadi kesalahan saat pendaftaran. Silakan coba lagi.",
      "type" => "register",
      "username" => $username,
      "password" => $password,
      "number" => $number,
    ];
    header("Location: index.php#auth_toggle");
    exit();
  }
}
