import { notification } from './lib/notification';

function copyText(e) {
    navigator.clipboard.writeText(e.value);
    notification.call(this, "Texte copié dans le presser-papier", "success", "Texte copié");
}
window.copyText = copyText;

// Menu déroulant
let listDropdownMenu = document.querySelectorAll('.dropdown-menu-source');
listDropdownMenu.forEach((e) => {
    e.querySelector('a[data-id="dropdown"]').addEventListener('click', function (event) {
        event.preventDefault();
        if (e.querySelector('ul[data-id="dropdown-menu"]').className == "display_none") {
            e.querySelector('a[data-id="dropdown"]').children[0].dataset.icon = "fe:arrow-down";
            e.querySelector('ul[data-id="dropdown-menu"]').className = "dropdown";
        } else {
            e.querySelector('a[data-id="dropdown"]').children[0].dataset.icon = "fe:arrow-right";
            e.querySelector('ul[data-id="dropdown-menu"]').className = "display_none";
        }
    })
})

// Réduire ou agrandir la sidebar
if (window.location.pathname.startsWith('/admin/overlay/')) {
    document.getElementById('sidebar_btn').addEventListener('click', (event) => {
        event.preventDefault();
        if (document.getElementById('sidebar').className == "big-sidebar") {
            document.getElementById('grid_container').classList.remove('big');
            document.getElementById('grid_container').classList.add('mini');

            document.getElementById('sidebar').classList.remove('big-sidebar');
            document.getElementById('sidebar').classList.add('mini-sidebar');
            document.getElementById('sidebar_btn').children[0].dataset.icon = "fe:arrow-right";
        } else if (document.getElementById('sidebar').className == 'mini-sidebar') {
            document.getElementById('grid_container').classList.remove('mini');
            document.getElementById('grid_container').classList.add('big');

            document.getElementById('sidebar').classList.remove('mini-sidebar')
            document.getElementById('sidebar').classList.add('big-sidebar')
            document.getElementById('sidebar_btn').children[0].dataset.icon = "fe:arrow-left";
        }
    })



    document.querySelector('a[data-id="theme"]').addEventListener('click', (event) => {
        if (document.querySelector('a[data-id="theme"]').className == "theme_dark") {
            document.querySelector('a[data-id="theme"]').setAttribute('data-effect', `light`);
            document.querySelector('a[data-id="theme"]').classList.remove('theme_dark');
            document.querySelector('a[data-id="theme"]').classList.add('theme_light');

            document.getElementById('content').classList.remove('theme_dark');
            document.getElementById('content').classList.add('theme_light');
        } else {
            document.querySelector('a[data-id="theme"]').setAttribute('data-effect', `dark`);
            document.querySelector('a[data-id="theme"]').classList.remove('theme_light');
            document.querySelector('a[data-id="theme"]').classList.add('theme_dark');

            document.getElementById('content').classList.remove('theme_light');
            document.getElementById('content').classList.add('theme_dark');
        }
    });
}


const random = (length = 13) => {
    // Declare all characters
    let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789&é"(-è_çà)=$^ù!:;,<';

    // Pick characers randomly
    let str = '';
    for (let i = 0; i < length; i++) {
        str += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    return str;

};

if (window.location.pathname == "/admin/user/new") {
    document.getElementById('generatePassword').addEventListener('click', () => {
        document.getElementById('password').value = random();
    })

    document.getElementById('showpwd').addEventListener('click', () => {
        if (document.getElementById('password').type == "password") {
            document.getElementById('password').type = "text"
        } else if (document.getElementById('password').type == "text") {
            document.getElementById('password').type = "password"
        }
    })
}


