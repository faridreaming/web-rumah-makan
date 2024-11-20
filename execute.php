<?php
session_start();
require_once("./functions.php");

// Login
if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Cek ke tabel admin
    $queryAdmin = "SELECT * FROM admin WHERE username = '$username'";
    $resultAdmin = mysqli_query($conn, $queryAdmin);

    if ($resultAdmin && mysqli_num_rows($resultAdmin) > 0) {
        $rowAdmin = mysqli_fetch_assoc($resultAdmin);
        if ($password === $rowAdmin['password']) {
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
        if ($password === $rowUser['password']) {
            $_SESSION["username"] = $username;
            $_SESSION["role"] = "user";
            header("Location: main.php");
            exit();
        }
    }

    // Jika username atau password salah
    $_SESSION["error"] = "Username atau password salah.";
    $_SESSION["errorType"] = "login";
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    header("Location: index.php");
    exit();
}