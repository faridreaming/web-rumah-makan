// Navbar
const navToggle = document.getElementById("nav-toggle");
const navbar = document.getElementById("navbar");

if (localStorage.getItem("navOpen") === "true") {
  document.body.classList.add("nav-open");
}

window.addEventListener("load", () => {
  setTimeout(() => {
    document.body.classList.remove("no-transition");
  }, 10);
});

navToggle.addEventListener("click", () => {
  document.body.classList.toggle("nav-open");
  const isNavOpen = document.body.classList.contains("nav-open");
  localStorage.setItem("navOpen", isNavOpen);
});

// Toast
const toast = document.getElementById("toast-message");
if (toast) {
  setTimeout(() => {
    toast.style.bottom = "20px";
  }, 100);
  setTimeout(() => {
    toast.style.bottom = "-100px";
  }, 3000);
  setTimeout(() => {
    toast.remove();
  }, 3500);
}

// Gambar menu
const gambar = document.getElementById("gambar");
if (gambar) {
  gambar.addEventListener("change", function () {
    const fileNameDisplay = document.getElementById("file-name");
    if (gambar.files.length > 0) {
      let fileName = gambar.files[0].name;
      if (fileName.length > 30) {
        fileName = `...${fileName.slice(-30)}`;
      }
      fileNameDisplay.textContent = fileName;
    }
  });
}
