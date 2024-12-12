<?php
require_once('./components/head.php');
?>

<title>Bunga ACC - Selera Minang</title>
</head>

<body class="bg-gray-100">
  <!-- Navbar -->
  <header class="bg-green-700 p-5">
    <div class="container mx-auto flex items-center justify-between">
      <!-- Image next to the brand name -->
      <div class="flex items-center">
        <img src="./dist/assets/logo-white.svg" alt="Logo" class="h-10 w-auto mr-3" />
        <a href="#" class="text-white text-2xl font-bold">Rumah Makan Padang</a>
      </div>

      <!-- Navbar aligned to the right -->
      <nav class="space-x-4 flex items-center">
        <a href="#home" class="text-white hover:text-green-200">Beranda</a>
        <a href="#about" class="text-white hover:text-green-200">Tentang</a>
        <a href="#menu" class="text-white hover:text-green-200">Menu</a>
        <a href="#contact" class="text-white hover:text-green-200">Kontak</a>
        <a href="./" class="text-white border border-white px-4 py-2 rounded-full hover:bg-white hover:text-green-700 transition">Login</a>
      </nav>
    </div>
  </header>

  <section id="home" class="relative flex items-center justify-center h-screen bg-cover bg-center transition-all duration-1000 ease-in-out">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 text-center text-white px-4">
      <h1 class="text-4xl md:text-5xl font-bold">Selamat Datang di Rumah Makan Padang</h1>
      <p class="mt-4 text-lg md:text-xl">Rasakan kelezatan masakan khas Minang dengan cita rasa otentik</p>
      <a href="#menu"
        class="mt-6 inline-block border-2 border-lime-500 hover:border-lime-600 bg-transparent hover:bg-lime-500 text-lime-500 hover:text-white py-3 px-8 rounded-full font-semibold transition-all duration-300">
        Explore Menu
      </a>
    </div>
  </section>

  <!-- JavaScript to Rotate Background Images -->
  <script>
    const images = [
      './dist/imgs/1.webp',
      './dist/imgs/2.webp',
      './dist/imgs/3.webp'
    ];
    let currentIndex = 0;
    const heroSection = document.getElementById('home');

    function changeBackgroundImage() {
      currentIndex = (currentIndex + 1) % images.length;
      heroSection.style.backgroundImage = `url('${images[currentIndex]}')`;
    }


    heroSection.style.backgroundImage = `url('${images[0]}')`;

    setInterval(changeBackgroundImage, 5000);
  </script>

  <!-- About Us Section -->
  <section id="about" class="py-16 bg-white">
    <div class="container mx-auto px-6">
      <h2 class="text-3xl font-bold text-center text-green-700">Tentang Kami</h2>
      <p class="mt-4 text-center text-gray-700">
        Rumah Makan Padang - Bunga ACC menyediakan hidangan khas Minang dengan cita rasa otentik dan bahan berkualitas terbaik. Kami
        berkomitmen untuk memberikan pengalaman kuliner terbaik bagi pelanggan kami.
      </p>
      <div class="mt-10 flex flex-wrap justify-center gap-8">
        <!-- Highlight 1 -->
        <div class="w-full sm:w-1/3 p-4 text-center">
          <div class="p-6 bg-green-100 rounded-lg">
            <h3 class="text-2xl font-semibold text-green-700">Bahan Segar</h3>
            <p class="mt-4 text-gray-600">
              Kami selalu menggunakan bahan-bahan segar setiap hari untuk memastikan cita rasa yang terbaik.
            </p>
          </div>
        </div>
        <!-- Highlight 2 -->
        <div class="w-full sm:w-1/3 p-4 text-center">
          <div class="p-6 bg-green-100 rounded-lg">
            <h3 class="text-2xl font-semibold text-green-700">Resep Tradisional</h3>
            <p class="mt-4 text-gray-600">
              Hidangan kami dibuat dengan resep turun-temurun dari Minangkabau yang telah teruji kelezatannya.
            </p>
          </div>
        </div>
        <!-- Highlight 3 -->
        <div class="w-full sm:w-1/3 p-4 text-center">
          <div class="p-6 bg-green-100 rounded-lg">
            <h3 class="text-2xl font-semibold text-green-700">Layanan Terbaik</h3>
            <p class="mt-4 text-gray-600">
              Kami mengutamakan kenyamanan pelanggan dengan layanan ramah dan cepat.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Menu Section -->
  <section id="menu" class="py-16 bg-gray-100">
    <div class="container mx-auto px-6">
      <h2 class="text-3xl font-bold text-center text-green-700">Menu Kami</h2>
      <p class="mt-4 text-center text-gray-700">Nikmati beragam hidangan khas Minang dengan pilihan menu terbaik kami.</p>
      <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Menu Item 1 -->
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
          <img src="./dist/assets/rendang.webp" alt="Rendang" class="w-full h-40 object-cover rounded-md" />
          <h3 class="mt-4 text-xl font-bold text-green-700">Rendang</h3>
          <p class="mt-2 text-gray-600">Daging sapi yang dimasak perlahan dengan rempah-rempah khas Minang.</p>
          <p class="mt-4 font-semibold text-green-700">Rp 35.000</p>
          <a href="index.php" class="mt-4 inline-block bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition duration-300 w-full">Pesan Sekarang</a>
        </div>
        <!-- Menu Item 2 -->
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
          <img src="./dist/assets/lele-goreng.webp" alt="Lele Gorrng" class="w-full h-40 object-cover rounded-md" />
          <h3 class="mt-4 text-xl font-bold text-green-700">Lele Goreng</h3>
          <p class="mt-2 text-gray-600">Lele yang digoreng crispy, disajikan dengan sambal pedas yang nikmat.</p>
          <p class="mt-4 font-semibold text-green-700">Rp 6.000</p>
          <a href="index.php" class="mt-4 inline-block bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition duration-300 w-full">Pesan Sekarang</a>
        </div>
        <!-- Menu Item 3 -->
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
          <img src="./dist/assets/gulai-ayam.webp" alt="Gulai Ayam" class="w-full h-40 object-cover rounded-md" />
          <h3 class="mt-4 text-xl font-bold text-green-700">Gulai Ayam</h3>
          <p class="mt-2 text-gray-600">Ayam yang dimasak dengan santan dan rempah-rempah khas Minang.</p>
          <p class="mt-4 font-semibold text-green-700">Rp 6.000</p>
          <a href="index.php" class="mt-4 inline-block bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition duration-300 w-full">Pesan Sekarang</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-16 bg-gray-100">
    <div class="container mx-auto px-6">
      <h2 class="text-3xl font-bold text-center text-green-700">Hubungi Kami</h2>
      <p class="mt-4 text-center text-gray-700">
        Kami siap melayani Anda! Hubungi kami melalui WhatsApp atau datang langsung ke lokasi kami.
      </p>
      <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="rounded-lg shadow-lg overflow-hidden">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.106184232633!2d98.64968551044134!3d3.5630210963962194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312fddaced1911%3A0xdd7e1d6c06a94b6c!2sRumah%20Makan%20%22Bunga%20Rai%22!5e0!3m2!1sen!2sid!4v1680708358973!5m2!1sen!2sid"
            width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
        </div>
        <div>

          <!-- Contact Options -->
          <div class="flex flex-col items-center md:items-start space-y-8">
            <!-- WhatsApp Contact -->
            <div class="text-center md:text-left">
              <h3 class="text-xl font-semibold text-green-700">Hubungi Melalui WhatsApp</h3>
              <p class="mt-2 text-gray-600">Klik tombol di bawah ini untuk langsung menghubungi kami.</p>
              <a
                href="https://wa.me/6283870921883?text=Halo%20Rumah%20Makan%20Bunga%20ACC,%20saya%20ingin%20bertanya%20tentang..."
                target="_blank"
                class="inline-block mt-4 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-full shadow-lg transition-all duration-300">
                <i class="fab fa-whatsapp mr-2"></i> Hubungi Kami
              </a>
            </div>

            <!-- Additional Info -->
            <div class="text-center md:text-left">
              <h3 class="text-xl font-semibold text-green-700">Jam Operasional</h3>
              <p class="mt-2 text-gray-600">
                Senin - Minggu: <span class="font-semibold">10:00 - 22:00</span>
              </p>
            </div>

            <!-- Contact Details -->
            <div class="text-center md:text-left">
              <h3 class="text-xl font-semibold text-green-700">Informasi Kontak</h3>
              <p class="mt-2 text-gray-600">
                <strong>Alamat:</strong> Jl. Pembangunan No.91B
              </p>
              <p class="mt-1 text-gray-600">
                <strong>Telepon:</strong> <a href="tel:+6281234567890" class="text-green-600 hover:underline">083870921883</a>
              </p>
            </div>
          </div>
        </div>
      </div>
  </section>



  <!-- Footer -->
  <footer class="bg-green-700 text-white py-10">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- About Us -->
        <div class="flex flex-col items-center md:items-start">
          <h3 class="text-xl font-bold mb-4">Tentang Kami</h3>
          <p class="text-gray-200 text-center md:text-left">
            Rumah Makan Bunga ACC adalah restoran khas Padang yang menyajikan makanan lezat dengan cita rasa autentik. Kami selalu siap menyambut Anda dengan pelayanan terbaik.
          </p>
        </div>

        <!-- Quick Links -->
        <div class="flex flex-col items-center md:items-start md:ml-4">
          <h3 class="text-xl font-bold mb-4">Tautan Cepat</h3>
          <ul class="space-y-2 text-center md:text-left">
            <li><a href="#home" class="hover:underline">Beranda</a></li>
            <li><a href="#about" class="hover:underline">Tentang Kami</a></li>
            <li><a href="#menu" class="hover:underline">Menu</a></li>
            <li><a href="#contact" class="hover:underline">Hubungi Kami</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div class="flex flex-col items-center md:items-start">
          <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
          <div class="rounded-lg overflow-hidden shadow-lg mb-4">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.106184232633!2d98.64968551044134!3d3.5630210963962194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312fddaced1911%3A0xdd7e1d6c06a94b6c!2sRumah%20Makan%20%22Bunga%20Acc%22!5e0!3m2!1sen!2sid!4v1733223052223!5m2!1sen!2sid"
              width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              class="w-full h-full"></iframe>
          </div>
          <p class="text-gray-200 text-center md:text-left">Jl. Pembangunan No.91B</p>
          <p class="text-gray-200 mt-2 text-center md:text-left">
            <strong>Telepon:</strong>
            <a href="https://wa.me/6283870921883?text=Mas%20aku%20mau%20pesan%20naspad%F0%9F%98%8B" class="text-white hover:underline">083870921883</a>
          </p>
          <p class="text-gray-200 mt-2 text-center md:text-left">
            <strong>Email:</strong>
            <a href="mailto:info@bungacc.com" class="text-white hover:underline">info@bungacc.com</a>
          </p>
          <div class="mt-4 flex space-x-4 justify-center">
            <a href="#" class="text-white hover:text-gray-300">
              <i class='bx bxl-facebook text-2xl'></i>
            </a>
            <a href="#" class="text-white hover:text-gray-300">
              <i class='bx bxl-instagram text-2xl'></i>
            </a>
            <a href="#" class="text-white hover:text-gray-300">
              <i class='bx bxl-twitter text-2xl'></i>
            </a>
            <a href="https://wa.me/6283870921883?text=Mas%20aku%20mau%20pesan%20naspad%F0%9F%98%8B" target="_blank" class="text-white hover:text-gray-300">
              <i class='bx bxl-whatsapp text-2xl'></i>
            </a>
          </div>


        </div>
      </div>
      <div class="mt-10 text-center border-t border-gray-600 pt-6">
        <p class="text-gray-300 text-sm">
          &copy; 2024 Rumah Makan Bunga ACC. All Rights Reserved.
        </p>
      </div>
    </div>
  </footer>



</body>

</html>