<?php
require_once("./components/toast.php");
require_once("./functions.php");

$id_admin = $_SESSION['id_admin'];
$admin = query("SELECT * FROM admin WHERE id_admin = $id_admin")[0];

if (isset($_POST['edit_admin'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "UPDATE admin SET username = '$username', password = '$password' WHERE id_admin = $id_admin";
  if (!mysqli_query($conn, $query)) {
    $_SESSION['error'] = 'Gagal mengedit admin.';
    header("Location: app.php?page=admin");
    exit();
  }

  $_SESSION['success'] = 'Admin berhasil diedit.';
?>
  <script type="text/javascript">
    window.location.href = 'dashboard.php?page=admin';
  </script>
<?php
  exit();
}
?>

<div class="p-2 sm:p-4">
  <h2 class="font-semibold text-gray-600 mb-2 text-center sm:text-left">Edit Admin</h2>
  <form action="" method="post" enctype="multipart/form-data" class="grid gap-2 sm:gap-4 [&>div>label]:text-xs sm:[&>div>label]:text-sm">
    <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
      <label for="username" class="text-blue-500 font-semibold">Username</label>
      <input type="text" name="username" id="username" required value="<?= $admin['username'] ?>" class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent" spellcheck="false">
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
      <label for="password" class="text-blue-500 font-semibold">Password</label>
      <input type="text" name="password" id="password" required value="<?= $admin['password'] ?>" class="p-1 border-2 border-gray-200 focus:border-gray-400 text-gray-400 focus:text-gray-800 outline-none transition-all duration-300 ease-in-out bg-transparent" spellcheck="false">
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 sm:items-center gap-1 sm:gap-2">
      <div class="flex sm:flex-row flex-col gap-2 sm:col-span-2 place-self-end w-full sm:w-fit mt-2">
        <button type="reset" class="bg-gray-200 text-gray-600 p-2 px-4 rounded text-xs font-normal outline-none hover:text-gray-400 transition duration-300 ease-in-out sm:w-fit w-full ring-gray-300 focus:ring">Reset</button>
        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengedit admin?')" name="edit_admin" class="bg-blue-500 text-white p-2 px-4 rounded text-xs font-semibold outline-none hover:bg-blue-400 transition duration-300 ease-in-out sm:w-fit w-full focus:ring">
          Edit Admin
        </button>
      </div>
    </div>
  </form>
</div>