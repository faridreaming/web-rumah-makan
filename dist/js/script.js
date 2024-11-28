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
