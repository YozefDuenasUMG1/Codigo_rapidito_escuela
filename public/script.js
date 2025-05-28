const sidebar = document.getElementById('sidebar');
const menuBtn = document.getElementById('menu-btn');
const sidebarBtn = document.getElementById('sidebar-btn');
const darkmodeBtn = document.getElementById('dark-mode-btn');
sidebarBtn.addEventListener('click', () => {
    document.body.classList.toggle('sidebar-hidden');
});

menuBtn.addEventListener('click', () => {
  sidebar.classList.toggle('minimize');

})

darkmodeBtn.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
});

function checkWindowSize() {
  sidebar.classList.remove('minimize');
}
checkWindowSize();
window.addEventListener('resize', checkWindowSize);
