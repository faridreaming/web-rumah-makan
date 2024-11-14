<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rumah Makan Bunga ACC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel="shortcut icon" href="./dist/assets/logo-white.svg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
  </head>

  <body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <header class="bg-green-700 p-5">
      <div class="container mx-auto flex items-center justify-between">
        <a href="#" class="text-white text-2xl font-bold">Rumah Makan Padang</a>
        <nav class="space-x-4 flex items-center">
          <a href="#home" class="text-white hover:text-green-200">Home</a>
          <a href="#about" class="text-white hover:text-green-200">Tentang Kami</a>
          <a href="#menu" class="text-white hover:text-green-200">Menu</a>
          <a href="#lokasi" class="text-white hover:text-green-200"></a>
          <a href="#contact" class="text-white hover:text-green-200">Kontak</a>
          <a href="#login" class="text-white border border-white px-4 py-2 rounded-full hover:bg-white hover:text-green-700 transition">Login</a>
        </nav>
      </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="relative flex items-center justify-center h-screen bg-cover bg-center" style="background-image: url('./dist/assets/hero-bg.jpg');">
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <div class="relative z-10 text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold">Selamat Datang di Rumah Makan Padang</h1>
        <p class="mt-4 text-lg md:text-xl">Rasakan kelezatan masakan khas Minang dengan cita rasa otentik</p>
        <a href="#menu" class="mt-6 inline-block bg-lime-500 hover:bg-lime-600 text-white py-3 px-8 rounded-full font-semibold transition-all duration-300">Explore Menu</a>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-gray-100">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-green-700">Tentang Kami</h2>
        <p class="mt-4 text-center text-gray-700">Rumah Makan Padang menawarkan hidangan khas Minang yang lezat dan otentik. Dibuat dari bahan-bahan pilihan dan resep turun-temurun, kami menyajikan hidangan yang menggugah selera dan mencerminkan budaya kuliner Minangkabau.</p>
      </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-16 bg-white">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-green-700">Menu Spesial</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
          <div class="p-6 border border-gray-200 rounded-lg text-center">
            <h3 class="text-2xl font-semibold text-gray-800">Rendang</h3>
            <p class="mt-4 text-gray-600">Rendang sapi dengan bumbu khas Minang yang kaya rasa dan pedas.</p>
          </div>
          <div class="p-6 border border-gray-200 rounded-lg text-center">
            <h3 class="text-2xl font-semibold text-gray-800">Ayam Pop</h3>
            <p class="mt-4 text-gray-600">Ayam Pop yang lezat dengan sambal dan bumbu khas.</p>
          </div>
          <div class="p-6 border border-gray-200 rounded-lg text-center">
            <h3 class="text-2xl font-semibold text-gray-800">Dendeng Balado</h3>
            <p class="mt-4 text-gray-600">Daging sapi tipis yang digoreng garing dan disajikan dengan sambal balado.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-100">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-green-700">Hubungi Kami</h2>
        <p class="mt-4 text-center text-gray-700">Jika Anda memiliki pertanyaan atau ingin melakukan reservasi, silakan hubungi kami melalui formulir di bawah ini.</p>
        <div class="mt-8 max-w-lg mx-auto">
          <form action="#" method="POST" class="space-y-4">
            <div>
              <label for="name" class="block text-gray-700">Nama</label>
              <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded" required />
            </div>
            <div>
              <label for="email" class="block text-gray-700">Email</label>
              <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded" required />
            </div>
            <div>
              <label for="message" class="block text-gray-700">Pesan</label>
              <textarea id="message" name="message" rows="4" class="w-full p-2 border border-gray-300 rounded" required></textarea>
            </div>
            <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded font-semibold transition-all duration-300">Kirim Pesan</button>
          </form>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-700 text-white py-4">
      <div class="container mx-auto text-center">
        <p>&copy; 2023 Rumah Makan Padang. All Rights Reserved.</p>
      </div>
    </footer>
  </body>
</html>