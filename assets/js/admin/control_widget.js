import { findAllOverlays } from './api';
import { getCheckedValueIntoRadio } from './services/checkApiService';
import { socket, initWsServer } from './ws'; // Import Websocket service
import '../widgets/index'; // Importation des functions show/off
import { notification } from './lib/notification';

//fonctions panneau admin
let dataArray = [];
var table = "";

// async function thenFindAllOverlays() {
//     try {
//         const res = await findAllOverlays().then((response) => {
//             dataArray = response.data;
//         });
//     } catch (error) {
//         console.log(error);
//     }
// };

function changeAuto(id) {
    socket.timeout(5000).emit(document.getElementById(id).dataset.id, ([document.getElementById(id).dataset.wid, document.getElementById(id).dataset.widgetid, document.getElementById(id).dataset.libid, document.getElementById(id).dataset.idoverlay]), () => { console.log("Hello") }, (err) => {
        if (err) {
            notification.call(this, "Le changement n'a pas était effectué", "error", "Erreur lors de la mise à jour");
        } else {
            notification.call(this, "Le changement à bien était pris en compte.", "success", "Widget mis à jour");
        }
    })
}
window.changeAuto = changeAuto;

function twitter_delete(id) {
    socket.emit("twitter_deletetweet", id);
    gettweets();
    deleteSuccessTweet();
}

window.twitter_delete = twitter_delete;

function twitter_select(id) {
    socket.timeout(5000).emit("twitter_selecttweet", id, () => { console.log("Hello") }, (err) => {
        if (err) {
            notification.call(this, "Le tweet n'a pas était sélectionné.", "error", "Erreur lors de la sélection");
        } else {
            notification.call(this, "Le tweet a bien était sélectionné.", "success", "Tweet sélectionné");
        }
    }
    );
}

window.twitter_select = twitter_select;

function gettweets() {
    console.log('gettweets')
    if (table != "") {
        table.destroy()
    }
    document.getElementById('data_tweets').innerHTML = '<div class="block_loading"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div><span>RECUPERATION DES TWEETS EN COURS</span></div>'
    setTimeout(() => {
        socket.emit("twitter_gettweets");
    }, 1000)
}

window.gettweets = gettweets;

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

function askrefresh(event) {
    event.preventDefault()
    const urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id_overlay')
    console.log(id)
    socket.emit('reload', id)
    setTimeout(() => {
        document.getElementsByName('widgets')[0].submit()
    }, 1000)
}
window.askrefresh = askrefresh;

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

function updateNextGame(id) {
    console.log(id);
    console.log(document.getElementById(id).value);
    if (!delay) {
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_next_game", ([id, document.getElementById(id).value]), () => { console.log('Hello nextGame') }, (err) => {
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
            socket.timeout(5000).emit("update_next_game", ([id, document.getElementById(id).value]), () => { console.log('Hello nextGame') }, (err) => {
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
window.updateNextGame = updateNextGame;

function updateGameScoreAlpha(id) {
    console.log(id);
    console.log(document.getElementById(id).value);
    if (!delay) {
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_game_score_alpha", ([id, document.getElementById(id).value]), () => { console.log('Hello GameScoreAlpha') }, (err) => {
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
            socket.timeout(5000).emit("update_game_score_alpha", ([id, document.getElementById(id).value]), () => { console.log('Hello GameScoreAlpha') }, (err) => {
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
window.updateGameScoreAlpha = updateGameScoreAlpha;

function updateGameScoreBeta(id) {
    console.log(id);
    console.log(document.getElementById(id).value);
    if (!delay) {
        delay = setTimeout(() => {
            socket.timeout(5000).emit("update_game_score_beta", ([id, document.getElementById(id).value]), () => { console.log('Hello GameScoreBeta') }, (err) => {
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
            socket.timeout(5000).emit("update_game_score_beta", ([id, document.getElementById(id).value]), () => { console.log('Hello GameScoreBeta') }, (err) => {
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
window.updateGameScoreBeta = updateGameScoreBeta;

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


// async function waitApiTraitement() {
//     // const arr = await thenFindAllOverlays()
//     const arr;

//     async function controlWidget() {
//         let list = [];
//         await getCheckedValueIntoRadio(dataArray, list);
//         await document.addEventListener('change', () => {
//             getCheckedValueIntoRadio(dataArray, list);
//         })
//     }

// }

// waitApiTraitement();

//ecoute events WS
socket.onAny((event, data) => {
    // test.call();
    // console.log(window.location.pathname)
    console.log("event: " + event);
    if (window.location.pathname.includes('/admin/overlay/')) {
        if (event.startsWith('show_') || event.startsWith('off_')) {
            document.getElementById(event).checked = true;
        } else if (event == "twitter_answer") {
            var tweets = ""
            data.forEach(element => {
                console.log(element.id)
                if (element.tweet_media_type == "undefined") {
                    tweets = tweets + '<tr><td><div style="width: 80%"><img style="width: 100%;" src="' + element.tweet_avatar + '" alt="Avatar"></div></td><td>' + element.tweet_pseudo + '</td><td><a href="https://twitter.com/' + element.tweet_at + '" target="blank">@' + element.tweet_at + '</a></td><td><p>' + element.tweet_content + '</p></td><td></td><td><span class="iconify" data-icon="ant-design:delete-filled" onclick="twitter_delete(' + element.id + ')" ></span><span class="iconify" data-icon="ep:select" onclick="twitter_select(' + element.id + ')" data-dismiss="modal"></span></td></tr>'
                } else if (element.tweet_media_type == "photo") {
                    tweets = tweets + '<tr><td><div style="width: 80%"><img style="width: 100%;" src="' + element.tweet_avatar + '" alt="Avatar"></div></td><td>' + element.tweet_pseudo + '</td><td><a href="https://twitter.com/' + element.tweet_at + '" target="blank">@' + element.tweet_at + '</a></td><td><p>' + element.tweet_content + '</p></td><td><div style="width: 100%"><img style="width: 100%;" src="' + element.tweet_media_url + '" alt="Media du Tweet"></div></td><td><span class="iconify" data-icon="ant-design:delete-filled" onclick="twitter_delete(' + element.id + ')" ></span><span class="iconify" data-icon="ep:select" onclick="twitter_select(' + element.id + ')" data-dismiss="modal"></span></td></tr>'
                } else if (element.tweet_media_type == "video") {
                    tweets = tweets + '<tr><td><div style="width: 80%"><img style="width: 100%;" src="' + element.tweet_avatar + '" alt="Avatar"></div></td><td>' + element.tweet_pseudo + '</td><td><a href="https://twitter.com/' + element.tweet_at + '" target="blank">@' + element.tweet_at + '</a></td><td><p>' + element.tweet_content + '</p></td><td><div style="width: 100%"><video width="300px" loop autoplay muted><source src="' + element.tweet_media_url + '" type="video/mp4"></video></div></td><td><span class="iconify" data-icon="ant-design:delete-filled" onclick="twitter_delete(' + element.id + ')" ></span><span class="iconify" data-icon="ep:select" onclick="twitter_select(' + element.id + ')" data-dismiss="modal"></span></td></tr>'
                } else if (element.tweet_media_type == "animated_gif") {
                    tweets = tweets + '<tr><td><div style="width: 80%"><img style="width: 100%;" src="' + element.tweet_avatar + '" alt="Avatar"></div></td><td>' + element.tweet_pseudo + '</td><td><a href="https://twitter.com/' + element.tweet_at + '" target="blank">@' + element.tweet_at + '</a></td><td><p>' + element.tweet_content + '</p></td><td><div style="width: 100%"><video width="300px" loop autoplay muted><source src="' + element.tweet_media_url + '" type="video/mp4"></video></div></td><td><span class="iconify" data-icon="ant-design:delete-filled" onclick="twitter_delete(' + element.id + ')" ></span><span class="iconify" data-icon="ep:select" onclick="twitter_select(' + element.id + ')" data-dismiss="modal"></span></td></tr>'
                }
            });

            if (table != "") {
                setTimeout(() => {
                    document.getElementById('tweets_block').innerHTML = '<table id="data_tweets" class="display"></table>'
                    document.getElementById('data_tweets').innerHTML = '<thead><tr><th>Avatar</th><th>Pseudo</th><th>@Twitter</th><th>Contenu</th><th>Media</th><th>Actions</th></tr><thead><tbody id="tweets_data">' + tweets + '</tbody>'
                    table = $('#data_tweets').DataTable();
                }, 1000)
            } else {
                setTimeout(() => {
                    document.getElementById('data_tweets').innerHTML = '<thead><tr><th>Avatar</th><th>Pseudo</th><th>@Twitter</th><th>Contenu</th><th>Media</th><th>Actions</th></tr><thead><tbody id="tweets_data">' + tweets + '</tbody>'
                    table = $('#data_tweets').DataTable();
                }, 1000)
            }
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
            console.log(data)
            if (data == 'undefined') {
                window.showTweetSample.call()
            } else if (data == 'photo') {
                window.showTweetImg.call()
            } else if (data == 'video' || data == 'animated_gif') {
                window.showTweetVideo.call()
            }
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
        } else if (event == 'show_results') {
            console.log('Affichage results');
            window.showResults.call();
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
            console.log(data)
            if (data == 'undefined') {
                window.offTweetSampleText.call()
            } else if (data == 'photo') {
                window.offTweetImg.call()
            } else if (data == 'video' || data == 'animated_gif') {
                window.offTweetVideo.call()
            }
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
        } else if (event == 'off_results') {
            console.log('Cacher results');
            window.offResults.call();
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

        if (event == 'update_next_game') {
            console.log(data);
            document.getElementById('nextmatch_team_a').innerText = data[1]
            document.getElementById('nextmatch_team_b').innerText = data[2]
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

        if (event == 'update_game_score_alpha') {
            $("#score_team_alpha").load(window.location.href + " #score_team_alpha");
        } else if (event == 'update_game_score_beta') {
            $("#score_team_beta").load(window.location.href + " #score_team_beta");
        } else if (event == 'tweet_selected') {
            console.log(data)
            if (data.tweet_media_type == 'undefined') {
                document.getElementById('text_avatar').src = data.tweet_avatar
                document.getElementById('text_pseudo').innerHTML = data.tweet_pseudo
                document.getElementById('text_display').innerHTML = '@' + data.tweet_at
                document.getElementById('text_texte').innerHTML = data.tweet_content
            } else if (data.tweet_media_type == 'photo') {
                document.getElementById('img_avatar').src = data.tweet_avatar
                document.getElementById('img_pseudo').innerHTML = data.tweet_pseudo
                document.getElementById('img_display').innerHTML = '@' + data.tweet_at
                document.getElementById('img_texte').innerHTML = data.tweet_content
                document.getElementById('img_image').src = data.tweet_media_url
            } else if (data.tweet_media_type == 'video' || data.tweet_media_type == 'animated_gif') {
                document.getElementById('video_avatar').src = data.tweet_avatar
                document.getElementById('video_pseudo').innerHTML = data.tweet_pseudo
                document.getElementById('video_display').innerHTML = '@' + data.tweet_at
                document.getElementById('video_texte').innerHTML = data.tweet_content
                var video = document.getElementById('video_video')
                var source = document.getElementById('video_src')
                source.setAttribute('src', data.tweet_media_url)
                video.load().then(video.play())
            }
        }
    }
});

//fonctions overlays
