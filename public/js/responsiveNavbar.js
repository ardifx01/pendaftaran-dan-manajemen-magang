

function toggleDropdown() {
    var dropdownMenu = document.getElementById('dropdownMenu');
    var dropdownIcon = document.getElementById('dropdownIcon');
    
    if (dropdownMenu.classList.contains('hidden')) {
        
        dropdownMenu.classList.remove('hidden');
        dropdownMenu.classList.add('animate__fadeInDown');
        dropdownIcon.innerHTML = '<iconify-icon icon="teenyicons:up-solid"></iconify-icon>';
    } else {
        
        dropdownMenu.classList.add('animate__fadeOutUp');
        setTimeout(() => {
            dropdownMenu.classList.add('hidden');
            dropdownMenu.classList.remove('animate__fadeOutUp');
        }, 300);
        dropdownIcon.innerHTML = '<iconify-icon icon="teenyicons:down-solid"></iconify-icon>';
    }
}


function toggleMenu() {
var menuDropdown = document.getElementById('menuDropdown');

if (menuDropdown.classList.contains('hidden')) {
    menuDropdown.classList.remove('hidden');
    menuDropdown.classList.add('animate__fadeInDown');
} else {
    menuDropdown.classList.add('animate__fadeOutUp');
    setTimeout(() => {
        menuDropdown.classList.add('hidden');
        menuDropdown.classList.remove('animate__fadeOutUp');
    }, 300);
}
}
