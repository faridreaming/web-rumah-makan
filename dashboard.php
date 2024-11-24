<?php
session_start();
// if (!isset($_SESSION['login'])) {
//   header('Location: login.php');
//   exit;
// }
?>

<?php
require_once('./components/head.php');
?>

<title>Dashboard | Bunga ACC</title>
</head>

<body class="bg-gray-100 p-2">
  <header class="bg-green-500 rounded-md flex p-2 items-center justify-between">
    <nav class="flex items-center gap-4">
      <div class="rounded h-full aspect-square flex items-center justify-center hover:bg-black/15 transition duration-300 ease-in-out p-2">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
          <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
        </svg>
      </div>

      <a href="" class="flex gap-2 items-center justify-center cursor-pointer">
        <img src="./dist/assets/logo-white.svg" alt="Bunga ACC" class="h-8" />
        <div class="text-white leading-none flex flex-col">
          <h1 class="font-extrabold">Dashboard</h1>
          <small class="text-xs w-max">Rumah Makan Padang</small>
        </div>
      </a>
    </nav>

    <a href="./logout.php" class="rounded h-full aspect-square flex items-center justify-center bg-white p-2 hover:bg-white/75 transition duration-300 ease-in-out">
      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="fill-green-500">
        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
      </svg>
    </a>
  </header>
</body>

</html>