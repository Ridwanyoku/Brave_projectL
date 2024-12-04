const toggleButton = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');

function toggleSidebar() {
    sidebar.classList.toggle('close');
    toggleButton.classList.toggle('rotate');

    closeAllSubMenu()
}

function toggleSubMenu(button) {
    
    if (!button.nextElementSibling.classList.contains('show')) {
        closeAllSubMenu() 
    }

    button.nextElementSibling.classList.toggle('show');
    button.classList.toggle('rotate');

    if (sidebar.classList.contains('close')) {
        sidebar.classList.toggle('close');
        sidebar.style.height = "0%";
        toggleButton.classList.toggle('rotate');
    }

    if (sidebar.classList.contains('show')){
        sidebar.style.height = "100%";
    }
}

function closeAllSubMenu(params) {
    Array.from(sidebar.getElementsByClassName('show')).forEach(ul =>{
        ul.classList.remove('show');
        ul.previousElementSibling.classList.remove('rotate');
    })
}

const panah = document.getElementById('panah');

if (window.innerWidth <= 768) {
        panah.classList.toggle('none');
}