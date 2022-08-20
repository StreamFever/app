import { findAllOverlays } from './api';
import { getCheckedValueIntoRadio } from './services/checkApiService';
import { socket, initWsServer } from './ws'; // Import Websocket service
import '../widgets/index'; // Importation des functions show/off
import { notification } from './lib/notification';

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

function changeAuto(id) {
    socket.timeout(5000).emit(document.getElementById(id).dataset.id, ([document.getElementById(id).dataset.wid, document.getElementById(id).dataset.widgetid, document.getElementById(id).dataset.libid, document.getElementById(id).dataset.idoverlay]), () => { console.log("Hello") }, (err) => {
        if (err) {
            notification.call(this, "Le changement n'a pas était effectué", "error", "Error lors de la mise à jour");
        } else {
            notification.call(this, "Le changement à bien était pris en compte.", "success", "Widget mis à jour");
        }
    })
}
window.changeAuto = changeAuto;

function change(id) {
    socket.timeout(5000).emit(id, ([document.getElementById(id).dataset.wid, document.getElementById(id).dataset.widgetid, document.getElementById(id).dataset.libid]), () => { console.log("Hello") }, (err) => {
        if (err) {
            notification.call(this, "Le changement n'a pas était effectué", "error", "Error lors de la mise à jour");
        } else {
            notification.call(this, "Le changement à bien était pris en compte.", "success", "Widget mis à jour");
        }
    })
}
window.change = change;

var delay;

function updateWSValue(id) {
    console.log(id);
    console.log(document.getElementById(id).value);
    if (!delay) {
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update", ([id, document.getElementById(id).value]), () => { console.log('Hello') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    } else {
        clearTimeout(delay);
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update", ([id, document.getElementById(id).value]), () => { console.log('Hello') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    }
}
window.updateWSValue = updateWSValue;

function updatePlayerNinja(id) {
    console.log(id);
    console.log(document.getElementById(id).value);
    if (!delay) {
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_player_ninja", ([id, document.getElementById(id).value, document.location.search != null ? document.location.search.replace('?player=', '') : null]), () => { console.log('Hello') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    } else {
        clearTimeout(delay);
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_player_ninja", ([id, document.getElementById(id).value, document.location.search != null ? document.location.search.replace('?player=', '') : null]), () => { console.log('Hello') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    }
}
window.updatePlayerNinja = updatePlayerNinja;

function updateCurrentEvent(id) {
    console.log(id);
    console.log(document.getElementById(id).value);
    if (!delay) {
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_current_event", ([id, document.getElementById(id).value]), () => { console.log('Hello currentGame') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    } else {
        clearTimeout(delay);
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_current_event", ([id, document.getElementById(id).value]), () => { console.log('Hello currentGame') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    }
}
window.updateCurrentEvent = updateCurrentEvent;

function updateCurrentMap(id) {
    console.log(id);
    console.log(document.getElementById(id).value);
    if (!delay) {
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_current_map", ([id, document.getElementById(id).value]), () => { console.log('Hello currentMap') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    } else {
        clearTimeout(delay);
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_current_map", ([id, document.getElementById(id).value]), () => { console.log('Hello currentMap') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    }
}
window.updateCurrentMap = updateCurrentMap;

function updateCurrentGame(id) {
    console.log(id);
    console.log(document.getElementById(id).value);
    if (!delay) {
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_current_game", ([id, document.getElementById(id).value]), () => { console.log('Hello currentGame') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    } else {
        clearTimeout(delay);
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_current_game", ([id, document.getElementById(id).value]), () => { console.log('Hello currentGame') }, (err) => {
                if (err) {
                    console.log(err);
                    notification.call(this, "La mise à jour n'a pas était effectué", "error", "Erreur lors de la mise à jour");
                } else {
                    notification.call(this, "La mise à jour à bien était pris en compte.", "success", "Mise à jour");
                }
            })
            delay = null;
        }, 1500);
    }
}
window.updateCurrentGame = updateCurrentGame;

function refreshBrowsersource() {
    socket.timeout(5000).emit("refresh", () => { console.log("Hello") }, (err) => {
        if (err) {
            notification.call(this, "Le rafraichissement n'a pas était effectué", "error", "Erreur lors du rafraichissement");
        } else {
            notification.call(this, "Le rafraichissement à bien était pris en compte.", "success", "Rafraichissement");
        }
    })
}
window.refreshBrowsersource = refreshBrowsersource;


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
    // console.log(window.location.pathname)
    console.log("event: " + event);
    if (window.location.pathname.includes('/admin/overlay/')) {
        if (event.startWith('show_') || event.startWith('off_')) {
            document.getElementById(event).checked = true;
        }
    } else if (window.location.pathname.includes('/overlay/')) {
        //Reload event
        if (event == 'refresh') {
            location.reload()
        }
        //Event pour afficher les widgets
        if (event == 'show_topbar') {
            console.log('Affichage de la TOPBAR');
            if (document.getElementById('topbar').classList.contains('display_none')) {
                window.showTopbar.call()
            }
            if (document.getElementById('bottombar')) {
                if (!document.getElementById('bottombar').classList.contains('display_none')) {
                    window.offBottomBar.call()
                }
            }
        } else if (event == 'show_bottombar') {
            console.log('Affichage de la BOTTOMBAR');
            if (document.getElementById('bottombar').classList.contains('display_none')) {
                window.showBottomBar.call()
            }
            if (!document.getElementById('topbar').classList.contains('display_none')) {
                window.offTopbar.call()
            }
        } else if (event == 'show_versus') {
            console.log('Affichage du VS');
            if (document.getElementById('versuscontainer').classList.contains('display_none')) {
                window.showVersus.call();
            }
        } else if (event == 'show_popup_text') {
            console.log('Affichage du POPUP TEXT');
            if (document.getElementById('leftpopuptext').classList.contains('display_none')) {
                window.showText.call()
            }
        } else if (event == 'show_next') {
            console.log('Affichage du NEXT');
            // if (document.getElementById('next_teams').classList.contains('display_none')) {
            window.showNext.call()
            // }
        } else if (event == 'show_tweets') {
            // window.showTweetSample.call()
            // window.showTweetImg.call()
            // window.showTweetVideo.call()
        } else if (event == 'show_cameras_alpha') {
            console.log('Affichage des CAMERAS ALPHA');
            if (document.getElementById('cameras_alpha').classList.contains('display_none')) {
                window.showCamsTeamAlpha.call()
            }
        } else if (event == 'show_cameras_beta') {
            console.log('Affichage des CAMERAS BETA');
            if (document.getElementById('cameras_beta').classList.contains('display_none')) {
                window.showCamsTeamBeta.call()
            }
        }

        //Event pour cacher les widgets
        if (event == 'off_topbar') {
            console.log('Cacher la TOPBAR et la BOTTOMBAR');
            if (!document.getElementById('topbar').classList.contains('display_none')) {
                window.offTopbar.call()
            }
            if (!document.getElementById('bottombar').classList.contains('display_none')) {
                window.offBottomBar.call()
            }
        } else if (event == "off_topbar") {
            console.log('Cacher la TOPBAR');
            if (!document.getElementById('topbar').classList.contains('display_none')) {
                window.offTopbar.call()
            }
        } else if (event == "off_versus") {
            console.log('Cacher le VS');
            if (!document.getElementById('versuscontainer').classList.contains('display_none')) {
                window.offVersus.call()
            }
        } else if (event == "off_popup_text") {
            console.log('Cacher le POPUP TEXT');
            if (!document.getElementById('leftpopuptext').classList.contains('display_none')) {
                window.offText.call()
            }
        } else if (event == "off_next") {
            console.log('Cacher le NEXT');
            // if (!document.getElementById('next_teams').classList.contains('display_none')) {
            window.offNext.call()
            // }
        } else if (event == "off_tweets") {
            // window.offTweetSampleText.call()
            // window.offTweetImg.call()
            // window.offTweetVideo.call()
        } else if (event == 'off_cameras_alpha') {
            console.log('Cacher les CAMERAS ALPHA');
            if (!document.getElementById('cameras_alpha').classList.contains('display_none')) {
                window.offCamsTeamAlpha.call()
            }
        } else if (event == 'off_cameras_beta') {
            console.log('Cacher les CAMERAS BETA');
            if (!document.getElementById('cameras_beta').classList.contains('display_none')) {
                window.offCamsTeamBeta.call()
            }
        }

        if (event == "update_topbar_title_MetaValue") {
            document.getElementById('topbar-title').innerText = data;
        } else if (event == "update_popup_text_MetaValue") {
            document.getElementById('txtvalue').innerText = data;
        } else if (event == 'update_bottombar_marquee_MetaValue') {
            document.getElementById('bottombarMarquee').innerText = data;
        }

        if (event == 'update_current_event' || event == 'update_current_game') {
            location.reload()
        } else if (event == 'update_current_map') {
            document.getElementById('currentmap').innerText = data;
            document.getElementById('video_versus').dataset.map = data;
        }

        if (event == 'update_bottombar_marquee_1_MetaValue') {
            document.getElementById('bottombar_marquee_1').innerText = data;
        } else if (event == 'update_bottombar_marquee_2_MetaValue') {
            document.getElementById('bottombar_marquee_2').innerText = data;
        } else if (event == 'update_bottombar_marquee_3_MetaValue') {
            document.getElementById('bottombar_marquee_3').innerText = data;
        } else if (event == 'update_bottombar_marquee_4_MetaValue') {
            document.getElementById('bottombar_marquee_4').innerText = data;
        }
    }
});

//fonctions overlays
