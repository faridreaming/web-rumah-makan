<?php
session_start();
if (!isset($_SESSION["id_admin"]) || !isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
  header("Location: index.php");
  exit();
}

$page = "dashboard";
if (isset($_GET["page"])) {
  $page = $_GET["page"];
}
?>

<?php
require_once('./components/head.php');
?>

<title>Dashboard | Bunga ACC</title>
</head>

<body class="p-2 h-svh flex flex-col gap-2 no-transition">
  <header class="bg-green-500 shadow-[0_4px_0_0_black] mb-[4px] shadow-green-600 rounded-md flex p-2 items-center justify-between">
    <nav class="flex items-center gap-4 w-full sm:w-fit relative">
      <div id="nav-toggle">
        <div class="sm:hidden absolute z-10 rounded h-full aspect-square flex items-center justify-center hover:bg-black/15 transition duration-300 ease-in-out p-1 sm:p-2">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="fill-white">
            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
          </svg>
        </div>

        <div class="rounded h-full aspect-square flex items-center justify-center hover:bg-black/15 transition duration-300 ease-in-out p-1 sm:p-2">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="fill-white">
            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
          </svg>
        </div>
      </div>

      <div class="absolute sm:static w-full flex justify-center">
        <a href="" class="flex gap-2 items-center justify-center cursor-pointer w-fit">
          <img src="./dist/assets/logo-white.svg" alt="Bunga ACC" class="h-6 sm:h-9" />
          <div class="text-white leading-none flex flex-col">
            <h1 class="font-extrabold text-sm sm:text-base">RM Padang</h1>
            <small class="text-[10px] w-max sm:text-xs">Dashboard</small>
          </div>
        </a>
      </div>
    </nav>

    <form action="./execute.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin logout?')" class="h-full">
      <button type="submit" name="logout" title="Logout" class="group outline-none rounded h-full aspect-square sm:flex items-center justify-center bg-white p-2 hidden">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="fill-red-500 group-hover:fill-red-300 transition duration-300 ease-in-out">
          <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
        </svg>
      </button>
    </form>
  </header>

  <div class="flex h-full gap-2 relative overflow-auto">
    <nav id="navbar" class="h-full bg-white border-2 border-gray-200 rounded-md w-fit p-2 font-medium text-xs sm:text-sm text-gray-700 flex flex-col gap-6 justify-between absolute -left-full transition-all duration-500 ease-in-out overflow-auto">
      <ul class="flex flex-col gap-6 p-0 sm:p-2">
        <li class="flex flex-col gap-2">
          <h2 class="uppercase text-[10px] font-bold">Dashboard</h2>
          <ul>
            <li>
              <a href="?page=dashboard" class="group flex items-center gap-1 transition duration-300 ease-in-out hover:text-green-500 <?php echo $page == 'dashboard' ? 'text-green-500 [&>svg]:text-green-500' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="h-4 text-gray-400 fill-current transition duration-300 ease-in-out group-hover:text-green-500">
                  <path d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z" />
                </svg>
                <span>Dashboard</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="flex flex-col gap-2">
          <h2 class="uppercase text-[10px] font-bold">App</h2>
          <ul class="flex flex-col gap-2">
            <li>
              <a href="?page=menu" class="group flex items-center gap-1 transition duration-300 ease-in-out hover:text-green-500 <?php echo $page == 'menu' ? 'text-green-500 [&>svg]:text-green-500' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="h-4 text-gray-400 fill-current transition duration-300 ease-in-out group-hover:text-green-500">
                  <path d="M560-564v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-600q-38 0-73 9.5T560-564Zm0 220v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-380q-38 0-73 9t-67 27Zm0-110v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-490q-38 0-73 9.5T560-454ZM260-320q47 0 91.5 10.5T440-278v-394q-41-24-87-36t-93-12q-36 0-71.5 7T120-692v396q35-12 69.5-18t70.5-6Zm260 42q44-21 88.5-31.5T700-320q36 0 70.5 6t69.5 18v-396q-33-14-68.5-21t-71.5-7q-47 0-93 12t-87 36v394Zm-40 118q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740q51-30 106.5-45T700-800q52 0 102 12t96 36q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59ZM280-494Z" />
                </svg>
                <span>Menu</span>
              </a>
            </li>
            <li>
              <a href="?page=pesanan" class="group flex items-center gap-1 transition duration-300 ease-in-out hover:text-green-500 <?php echo $page == 'pesanan' ? 'text-green-500 [&>svg]:text-green-500' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="h-4 text-gray-400 fill-current transition duration-300 ease-in-out group-hover:text-green-500">
                  <path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                </svg>
                <span>Pesanan</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="flex flex-col gap-2">
          <h2 class="uppercase text-[10px] font-bold">Accounts</h2>
          <ul class="flex flex-col gap-2">
            <li>
              <a href="?page=user" class="group flex items-center gap-1 transition duration-300 ease-in-out hover:text-green-500 <?php echo $page == 'user' ? 'text-green-500 [&>svg]:text-green-500' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="h-4 text-gray-400 fill-current transition duration-300 ease-in-out group-hover:text-green-500">
                  <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                </svg>
                <span>User</span>
              </a>
            </li>
            <li>
              <a href="?page=admin" class="group flex items-center gap-1 transition duration-300 ease-in-out hover:text-green-500 <?php echo $page == 'admin' ? 'text-green-500 [&>svg]:text-green-500' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="h-4 text-gray-400 fill-current transition duration-300 ease-in-out group-hover:text-green-500">
                  <path d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Zm560 40-12-60q-12-5-22.5-10.5T584-204l-58 18-40-68 46-40q-2-14-2-26t2-26l-46-40 40-68 58 18q11-8 21.5-13.5T628-460l12-60h80l12 60q12 5 22.5 11t21.5 15l58-20 40 70-46 40q2 12 2 25t-2 25l46 40-40 68-58-18q-11 8-21.5 13.5T732-180l-12 60h-80Zm40-120q33 0 56.5-23.5T760-320q0-33-23.5-56.5T680-400q-33 0-56.5 23.5T600-320q0 33 23.5 56.5T680-240ZM400-560q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Zm0-80Zm12 400Z" />
                </svg>
                <span>Admin</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>

      <form action="./execute.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin logout?')" class="sm:hidden">
        <button type="submit" name="logout" title="Logout" class="rounded outline-none flex items-center w-full justify-center bg-red-500 p-2 hover:bg-red-400 transition duration-300 ease-in-out">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="fill-white">
            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
          </svg>
        </button>
      </form>
    </nav>

    <main id="dashboard-main" class="border-2 w-full rounded-md border-gray-200 text-sm ml-0 transition-all duration-500 ease-in-out overflow-auto scrollbar-none">
      <?php
      function showBreadCrumb($parent, $children)
      {
        $childrenText = implode(' &rsaquo; ', array_map('ucwords', $children));
        if (isset($_GET["action"])) {
          echo '
            <div class="flex p-2 sm:p-4 border-b-2 border-gray-200 text-xs sm:text-sm justify-between items-center">
              <h3 class="font-medium">
              ' . ucwords($parent) . ' <span class="text-gray-500">&rsaquo; ' . $childrenText . '</span>
              </h3>
              <a href="?page=' . $children[0] . '" class="h-min flex items-center justify-center text-gray-600 hover:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF" class="fill-current transition duration-300 ease-in-out"><path d="M280-200v-80h284q63 0 109.5-40T720-420q0-60-46.5-100T564-560H312l104 104-56 56-200-200 200-200 56 56-104 104h252q97 0 166.5 63T800-420q0 94-69.5 157T564-200H280Z"/></svg>
              </a>
            </div>
          ';
        } else {
          echo '
            <div class="flex p-2 sm:p-4 border-b-2 border-gray-200 text-xs sm:text-sm">
              <h3 class="font-medium">
              ' . ucwords($parent) . ' <span class="text-gray-500">&rsaquo; ' . $childrenText . '</span>
              </h3>
            </div>
          ';
        }
      }
      ?>

      <?php
      switch ($page) {
        case 'dashboard':
          showBreadCrumb("dashboard", [$page]);
          require_once('./pages/admin/dashboard.php');
          break;
        case 'menu':
          if (isset($_GET["action"])) {
            $action = $_GET["action"];
            switch ($action) {
              case 'add':
                showBreadCrumb("app", [$page, "tambah"]);
                require_once('./forms/menu-add.php');
                break;
              case 'edit':
                showBreadCrumb("app", [$page, "edit"]);
                require_once('./forms/menu-edit.php');
                break;
              default:
                showBreadCrumb("app", [$page]);
                require_once('./pages/admin/menu.php');
                break;
            }
          } else {
            showBreadCrumb("app", [$page]);
            require_once('./pages/admin/menu.php');
          }
          break;
        case 'pesanan':
          showBreadCrumb("app", [$page]);
          require_once('./pages/admin/pesanan.php');
          break;
        case 'user':
          showBreadCrumb("accounts", [$page]);
          require_once('./pages/admin/user.php');
          break;
        case 'admin':
          showBreadCrumb("accounts", [$page]);
          require_once('./pages/admin/admin.php');
          break;
        default:
          showBreadCrumb("dashboard", [$page]);
          require_once('./pages/admin/dashboard.php');
          break;
      }
      ?>
    </main>
  </div>

  <script src="./dist/js/script.js"></script>
</body>

</html>