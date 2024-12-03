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

// Logout
if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit();
}

// Hapus menu
if (isset($_POST["hapus_menu"])) {
  $idMenu = mysqli_real_escape_string($conn, $_POST["id_menu"]);


  $queryGetImage = "SELECT gambar FROM menu WHERE id_menu = '$idMenu'";
  $resultGetImage = mysqli_query($conn, $queryGetImage);
  $rowImage = mysqli_fetch_assoc($resultGetImage);
  $namaGambar = $rowImage['gambar'];

  $queryDelete = "DELETE FROM menu WHERE id_menu = '$idMenu'";
  $resultDelete = mysqli_query($conn, $queryDelete);

  if ($resultDelete) {

    $pathGambar = "./dist/imgs/menu/" . $namaGambar;
    if (file_exists($pathGambar)) {
      unlink($pathGambar);
    }

    $_SESSION["success"] = "Menu berhasil dihapus.";
    header("Location: dashboard.php?page=menu");
    exit();
  } else {
    $_SESSION["error"] = "Terjadi kesalahan saat menghapus menu.";
    header("Location: dashboard.php?page=menu");
    exit();
  }
}

// Tambah menu
if (isset($_POST["tambah_menu"])) {
  $namaMenu = mysqli_real_escape_string($conn, $_POST["nama_menu"]);
  $hargaMenu = mysqli_real_escape_string($conn, $_POST["harga_menu"]);
  $jenisMenu = mysqli_real_escape_string($conn, $_POST["jenis_menu"]);
  $stok = mysqli_real_escape_string($conn, $_POST["stok"]);

  $gambar = $_FILES["gambar"];
  $gambarName = $gambar["name"];
  $gambarTmp = $gambar["tmp_name"];
  $gambarSize = $gambar["size"];
  $gambarError = $gambar["error"];


  $gambarNameNew = null;


  if ($gambarError === UPLOAD_ERR_OK && !empty($gambarName)) {
    $gambarExt = explode(".", $gambarName);
    $gambarActualExt = strtolower(end($gambarExt));
    $allowed = ["jpg", "jpeg", "png", "webp"];


    $uploadDir = "./dist/imgs/menu/";
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    if (in_array($gambarActualExt, $allowed)) {
      if ($gambarSize < 5000000) {
        $gambarNameNew = uniqid("", true) . "." . $gambarActualExt;
        $gambarDestination = $uploadDir . $gambarNameNew;


        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $detectedMimeType = mime_content_type($gambarTmp);

        if (in_array($detectedMimeType, $allowedMimeTypes)) {
          if (!move_uploaded_file($gambarTmp, $gambarDestination)) {
            $_SESSION["error"] = "Gagal memindahkan file gambar.";
            header("Location: dashboard.php?page=menu&action=add");
            exit();
          }
        } else {
          $_SESSION["error"] = "Tipe file gambar tidak valid.";
          header("Location: dashboard.php?page=menu&action=add");
          exit();
        }
      } else {
        $_SESSION["error"] = "Ukuran gambar terlalu besar.";
        header("Location: dashboard.php?page=menu&action=add");
        exit();
      }
    } else {
      $_SESSION["error"] = "Format gambar tidak didukung.";
      header("Location: dashboard.php?page=menu&action=add");
      exit();
    }
  }


  $gambarValue = is_null($gambarNameNew) ? "NULL" : "'$gambarNameNew'";
  $queryInsert = "
    INSERT INTO menu (nama_menu, harga_menu, jenis_menu, stok, gambar) 
    VALUES ('$namaMenu', '$hargaMenu', '$jenisMenu', '$stok', $gambarValue)
  ";
  $resultInsert = mysqli_query($conn, $queryInsert);

  if ($resultInsert) {
    $_SESSION["success"] = "Menu berhasil ditambahkan.";
    header("Location: dashboard.php?page=menu");
    exit();
  } else {

    if (!is_null($gambarNameNew)) {
      unlink($uploadDir . $gambarNameNew);
    }
    $_SESSION["error"] = "Terjadi kesalahan saat menambahkan menu.";
    header("Location: dashboard.php?page=menu&action=add");
    exit();
  }
}


// Edit menu
if (isset($_POST["edit_menu"])) {
  $idMenu = mysqli_real_escape_string($conn, $_POST["id_menu"]);
  $namaMenu = mysqli_real_escape_string($conn, $_POST["nama_menu"]);
  $hargaMenu = mysqli_real_escape_string($conn, $_POST["harga_menu"]);
  $jenisMenu = mysqli_real_escape_string($conn, $_POST["jenis_menu"]);
  $stok = mysqli_real_escape_string($conn, $_POST["stok"]);


  $querySelect = "SELECT gambar FROM menu WHERE id_menu = '$idMenu'";
  $resultSelect = mysqli_query($conn, $querySelect);

  if ($resultSelect && mysqli_num_rows($resultSelect) > 0) {
    $row = mysqli_fetch_assoc($resultSelect);
    $gambarNameOld = $row["gambar"];
  } else {
    $_SESSION["error"] = "Data menu tidak ditemukan.";
    header("Location: dashboard.php?page=menu&action=edit&id=$idMenu");
    exit();
  }

  $gambar = $_FILES["gambar"];
  $gambarName = $gambar["name"];
  $gambarTmp = $gambar["tmp_name"];
  $gambarSize = $gambar["size"];
  $gambarError = $gambar["error"];

  if ($gambarError === UPLOAD_ERR_NO_FILE) {
    $gambarNameNew = $gambarNameOld;
  } else {
    if ($gambarError === UPLOAD_ERR_OK && !empty($gambarName)) {
      $gambarExt = explode(".", $gambarName);
      $gambarActualExt = strtolower(end($gambarExt));
      $allowed = ["jpg", "jpeg", "png", "webp"];

      $uploadDir = "./dist/imgs/menu/";
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
      }

      if (in_array($gambarActualExt, $allowed)) {
        if ($gambarSize < 5000000) {
          $gambarNameNew = uniqid("", true) . "." . $gambarActualExt;
          $gambarDestination = $uploadDir . $gambarNameNew;

          $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
          $detectedMimeType = mime_content_type($gambarTmp);

          if (in_array($detectedMimeType, $allowedMimeTypes)) {
            if (!move_uploaded_file($gambarTmp, $gambarDestination)) {
              $_SESSION["error"] = "Gagal memindahkan file gambar.";
              header("Location: dashboard.php?page=menu&action=edit&id=$idMenu");
              exit();
            }
          } else {
            $_SESSION["error"] = "Tipe file gambar tidak valid.";
            header("Location: dashboard.php?page=menu&action=edit&id=$idMenu");
            exit();
          }

          if ($gambarNameOld !== "blank.webp" && file_exists($uploadDir . $gambarNameOld)) {
            unlink($uploadDir . $gambarNameOld);
          }
        } else {
          $_SESSION["error"] = "Ukuran gambar terlalu besar.";
          header("Location: dashboard.php?page=menu&action=edit&id=$idMenu");
          exit();
        }
      } else {
        $_SESSION["error"] = "Format gambar tidak didukung.";
        header("Location: dashboard.php?page=menu&action=edit&id=$idMenu");
        exit();
      }
    }
  }

  $queryUpdate = "
    UPDATE menu 
    SET nama_menu = '$namaMenu', harga_menu = '$hargaMenu', jenis_menu = '$jenisMenu', stok = '$stok', gambar = ";
  if ($gambarNameNew === $gambarNameOld) {
    $queryUpdate .= "gambar";
  } else {
    $queryUpdate .= "'$gambarNameNew'";
  }
  $queryUpdate .= " WHERE id_menu = '$idMenu'";

  $resultUpdate = mysqli_query($conn, $queryUpdate);

  if ($resultUpdate) {
    $_SESSION["success"] = "Menu berhasil diperbarui.";
    header("Location: dashboard.php?page=menu");
    exit();
  } else {

    if ($gambarNameNew !== $gambarNameOld && $gambarNameNew !== "blank.webp") {
      unlink($uploadDir . $gambarNameNew);
    }
    $_SESSION["error"] = "Terjadi kesalahan saat memperbarui menu.";
    header("Location: dashboard.php?page=menu&action=edit&id=$idMenu");
    exit();
  }
}
