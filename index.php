<?php 
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome To Our Web!</title>

    <link rel="stylesheet" href="./dist/output.css" />
    <link
      rel="shortcut icon"
      href="./dist/assets/logo-white.svg"
      type="image/x-icon"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
  </head>

  <body class="flex h-svh items-center justify-center bg-gray-100">
    <div
      id="auth_toggle"
      class="group container flex w-full flex-col overflow-hidden bg-white shadow-xl sm:w-fit sm:flex-row sm:rounded-xl"
    >
      <div
        class="relative flex flex-col items-center justify-center gap-2 overflow-hidden p-10"
      >
        <div
          class="absolute bottom-0 left-0 flex h-full w-full flex-col items-center justify-center gap-2 p-10 text-center text-white transition-all"
        >
          <div
            class="absolute -bottom-full right-0 h-full w-full bg-gradient-to-b from-lime-500 to-green-500 transition-all group-target:bottom-0 sm:hidden sm:bg-gradient-to-r"
          ></div>
          <div
            class="absolute -right-full bottom-0 hidden h-full w-full bg-gradient-to-b from-lime-500 to-green-500 transition-all group-target:right-0 sm:block sm:bg-gradient-to-r"
          ></div>
          <div
            class="absolute z-10 flex -translate-y-10 flex-col items-center justify-center gap-2 p-10 text-center opacity-0 transition-[transform,opacity] duration-[500ms,300ms] group-target:translate-y-0 group-target:opacity-100 sm:-translate-x-10 sm:translate-y-0 sm:group-target:translate-x-0"
          >
            <h1 class="heading-1">Welcome To Our Web!</h1>
            <p>Silahkan login jika sudah punya akun.</p>
            <a
              href="#"
              class="mt-2 w-1/2 rounded-full border-2 border-white py-2 font-semibold text-white outline-none transition-all duration-[250ms] hover:border-green-500 hover:bg-white hover:text-green-500 focus:border-green-500 focus:bg-white focus:text-green-500"
            >
              Login
            </a>
            <p class="text-xs">Copyright &copy; 2024</p>
          </div>
        </div>
        <div
          class="z-20 translate-y-0 opacity-100 transition-[transform,opacity] duration-[500ms,500ms] group-target:z-0 group-target:translate-y-10 group-target:opacity-0 group-target:duration-[500ms,300ms] sm:translate-x-0 sm:group-target:translate-x-10 sm:group-target:translate-y-0"
        >
          <h1 class="heading-1 text-center">Login</h1>
          <form
            action="./execute.php"
            method="post"
            class="flex flex-col gap-2"
          >
            <div class="flex flex-col gap-1">
              <label for="username">Username</label>
              <input
                type="text"
                name="username"
                id="username"
                required
                <?php
                if (isset($_SESSION["error"]) && isset($_SESSION["errorType"]) && $_SESSION["errorType"] === "login") {
                  if ($_SESSION["errorType"] === "login") {
                    echo "value=\"{$_SESSION["username"]}\"";
                  }
                }
                ?>
                class="rounded border-2 border-gray-400 p-1 text-gray-400 outline-none transition-all duration-[250ms] focus:border-gray-800 focus:text-gray-800"
                spellcheck="false"
              />
            </div>
            <div class="flex flex-col gap-1">
              <label for="password">Password</label>
              <input
                type="password"
                name="password"
                id="password"
                required
                <?php
                if (isset($_SESSION["error"]) && isset($_SESSION["errorType"]) && $_SESSION["errorType"] === "login") {
                  if ($_SESSION["errorType"] === "login") {
                    echo "value=\"{$_SESSION["password"]}\"";
                  }
                }
                ?>
                class="rounded border-2 border-gray-400 p-1 text-gray-400 outline-none transition-all duration-[250ms] focus:border-gray-800 focus:text-gray-800"
                spellcheck="false"
              />
            </div>
            <?php
            if (isset($_SESSION["error"]) && $_SESSION["errorType"] === "login") {
              echo "<p class='text-center text-sm text-red-500'>" . $_SESSION["error"] . "</p>";
              unset($_SESSION["error"]);
              unset($_SESSION["errorType"]);
            }
            ?>
            <button
              type="submit"
              name="login"
              id="login"
              class="mx-auto mt-2 w-1/2 rounded-full bg-lime-500 py-2 font-semibold text-white outline-none transition-all duration-[250ms] hover:bg-lime-600 focus:bg-lime-600"
            >
              Login
            </button>
          </form>
        </div>
      </div>

      <div
        class="relative flex flex-col items-center justify-center gap-2 overflow-hidden p-10"
      >
        <div
          class="absolute left-0 top-0 flex h-full w-full flex-col items-center justify-center gap-2 p-10 text-center text-white transition-all"
        >
          <div
            class="absolute left-0 top-0 h-full w-full bg-gradient-to-b from-lime-500 to-green-500 transition-all group-target:-top-full sm:hidden sm:bg-gradient-to-r"
          ></div>
          <div
            class="absolute left-0 top-0 hidden h-full w-full bg-gradient-to-b from-lime-500 to-green-500 transition-all group-target:-left-full group-target:top-0 sm:block sm:bg-gradient-to-r"
          ></div>
          <div
            class="absolute z-10 flex flex-col items-center justify-center gap-2 p-10 text-center transition-[transform,opacity] duration-[500ms,300ms] group-target:-translate-y-10 group-target:opacity-0 sm:group-target:-translate-x-10 sm:group-target:translate-y-0"
          >
            <h1 class="heading-1">Welcome To Our Web!</h1>
            <p>Silahkan registrasi akun untuk login.</p>
            <a
              href="./#auth_toggle"
              class="mt-2 w-1/2 rounded-full border-2 border-white py-2 font-semibold text-white outline-none transition-all duration-[250ms] hover:border-green-500 hover:bg-white hover:text-green-500 focus:border-green-500 focus:bg-white focus:text-green-500"
            >
              Register
            </a>
            <p class="text-xs">Copyright &copy; 2024</p>
          </div>
        </div>
        <div
          class="-translate-y-10 opacity-0 transition-[transform,opacity] duration-[500ms,300ms] group-target:z-20 group-target:translate-y-0 group-target:opacity-100 group-target:duration-[500ms,500ms] sm:-translate-x-10 sm:translate-y-0 sm:group-target:translate-x-0"
        >
          <h1 class="heading-1 text-center">Register</h1>
          <form
            action="./execute.php"
            method="post"
            class="flex flex-col gap-2"
          >
            <div class="flex flex-col gap-1">
              <label for="register_username">Username</label>
              <input
                type="text"
                name="register_username"
                id="register_username"
                required
                spellcheck="false"
                class="rounded border-2 border-gray-400 p-1 text-gray-400 outline-none transition-all duration-[250ms] focus:border-gray-800 focus:text-gray-800"
              />
            </div>
            <div class="flex flex-col gap-1">
              <label for="register_password">Password</label>
              <input
                type="password"
                name="register_password"
                id="register_password"
                required
                spellcheck="false"
                class="rounded border-2 border-gray-400 p-1 text-gray-400 outline-none transition-all duration-[250ms] focus:border-gray-800 focus:text-gray-800"
              />
            </div>
            <div class="flex flex-col gap-1">
              <label for="number">Phone Number</label>
              <input
                type="number"
                name="number"
                id="number"
                required
                class="rounded border-2 border-gray-400 p-1 text-gray-400 outline-none transition-all duration-[250ms] [appearance:textfield] focus:border-gray-800 focus:text-gray-800 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                spellcheck="false"
              />
            </div>
            <button
              type="submit"
              name="register"
              id="register"
              class="mx-auto mt-2 w-1/2 rounded-full bg-green-500 py-2 font-semibold text-white outline-none transition-all duration-[250ms] hover:bg-green-600 focus:bg-green-600"
            >
              Register
            </button>
          </form>
        </div>
      </div>
    </div>
    <script src="./dist/js/script.js"></script>
  </body>
</html>
