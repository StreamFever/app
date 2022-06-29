import { findAllOverlays } from './api';
import { getCheckedValueIntoRadio } from './services/checkApiService';
import { socket, initWsServer } from './ws'; // Import Websocket service
import '../widgets/index'; // Importation des functions show/off
import { test } from '../widgets/index';

//fonctions panneau admin
let dataArray = [];

async function thenFindAllOverlays() {
    try {
        const res = await findAllOverlays().then((response) => {
            dataArray = response.data;
        });
    } catch (error) {
        console.log(error);
    }
};

function change(id) {
    socket.timeout(5000).emit(id, () => { console.log("Hello") }, (err) => {
        if (err) {
            console.log('Pas de réponse')
        } else {
            console.log('Tout est OK')
        }
    })
}
window.change = change;

function updateWSValue(id) {
    console.log(id)
}
window.updateWSValue = updateWSValue;


async function waitApiTraitement() {
    const arr = await thenFindAllOverlays()

    async function controlWidget() {
        let list = [];
        await getCheckedValueIntoRadio(dataArray, list);
        await document.addEventListener('change', () => {
            getCheckedValueIntoRadio(dataArray, list);
        })
    }

}

waitApiTraitement();

//ecoute events WS
socket.onAny((event, data) => {
    // test.call();
    console.log("event: " + event);
    if (window.location.pathname.includes('/admin/overlay/u/')) {
        if (event.includes('show_')) {
            document.getElementById(event).checked = true;
        } else if (event.includes('off_')) {
            document.getElementById(event.replace('off_', '')).checked = false;
        }
    } else if (window.location.pathname.includes('/overlay/')) {

    }
});

//fonctions overlays
