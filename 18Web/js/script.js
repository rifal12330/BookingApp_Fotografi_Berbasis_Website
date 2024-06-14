//Toggle class active
const navbarNav = document.querySelector(".navbar-nav");
const hamburgerMenu = document.querySelector("#hamburger-menu");

// ketika hamburger menu di klik
hamburgerMenu.addEventListener("click", function () {
  navbarNav.classList.toggle("active");
});

//Klik diluar side bar untuk menghilangkan nav mode tablet
const hamburger = document.querySelector("#hamburger-menu");

document.addEventListener("click", function (e) {
  if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});



