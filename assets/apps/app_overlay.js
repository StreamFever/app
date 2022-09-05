/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './styles/app.css';

// TODO: Importer selon la version des widgets, soit le index des dossiers ou individuellement les styles
import '../styles/lib/loader.scss';
// INFO: changer le nom du dossier selon l'événement - rendre dynamique ceci
import '../styles/widgets/louvard/index.scss';
import '../js/admin/ws';
import '../js/admin/control_widget';
import '../js/widgets/index';

$(function () { //equals window.onload or ready
 $('#loading-wrapper').addClass('slide-out-fwd-center');
 setTimeout(() => {
  $('#loading-wrapper').hide()
 }, 1000);
});


console.log("JS & CSS Overlay OK");