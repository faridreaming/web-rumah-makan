<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="description" content="Rumah Makan Padang">
    <meta name="keywords" content="Rumah Makan Padang">
    <meta name="author" content="Reza,Farid,Shiddiq TRPL 3C">
    <!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> -->
</head>
<body>
    <form action="proses.php" method="post">
        <h1>Menu</h1>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>