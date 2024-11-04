<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNGA ACC</title>
    <meta name="description" content="Rumah Makan Padang">
    <meta name="keywords" content="Rumah Makan Padang">
    <meta name="author" content="Reza,Farid,Shiddiq TRPL 3C">
    <link rel="shortcut icon" href="./assets/logo-bunga-acc.svg" type="image/x-icon">
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="#">
			<h1>Daftar Akun</h1>
			<input type="text" placeholder="Username" />
			<input type="password" placeholder="Password" />
			<input type="password" placeholder="Konfirmaasi Password" />
			<button>Daftar</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="proses.php" method="post">
			<h1>Masuk Akun</h1>
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<a href="#">Kesulitan Masuk?</a>
			<button>Masuk</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Halo, Pecinta Masakan Padang!</h1>
				<p>Login untuk menikmati sajian khas Padang kami.</p>
				<button class="ghost" id="signIn">Masuk</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Selamat Datang di BUNGA ACC</h1>
				<p>Daftar untuk merasakan kelezatan masakan Padang dengan cara yang berbeda.</p>
				<button class="ghost" id="signUp">Daftar</button>
			</div>
		</div>
	</div>
</div>
<script src="login.js"></script>
</body>
</html>