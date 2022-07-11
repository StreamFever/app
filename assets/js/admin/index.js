import { initWsServer } from './ws';
initWsServer.call();
import './api';
import './control_widget';
import './datatable';
import './ui';
import './toasts';
import './ws';
// import './player';
import './panel/index';
import './services/colorVideo';
import './twitch';



function gettweets() {
 if (table != "") {
  table.destroy()
 }
 document.getElementById('data_tweets').innerHTML = '<div class="block_loading"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div><span>RECUPERATION DES TWEETS EN COURS</span></div>'
 // setTimeout(() => {
 //  socket.emit("twitter_gettweets");
 // }, 1000)
}

// function twitter_reset() {
//  socket.emit("twitter_reset")
// }