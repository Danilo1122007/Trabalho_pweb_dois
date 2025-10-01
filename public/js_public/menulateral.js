function mostrarMenu() {
  const menuLateral = document.getElementById('menu-lateral');
  menuLateral.classList.toggle('ativa');

  const iconMenu = document.getElementById("ham");
  const srcAtual = iconMenu.src;

  if (srcAtual.includes("icon-hamburger-menu.png")) {
    iconMenu.src = "../img/icon-close-menu.png";
  } else {
    iconMenu.src = "../img/icon-hamburger-menu.png";
  }
}
