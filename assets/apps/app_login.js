/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './styles/app.css';

// TODO: Importer selon la version des widgets, soit le index des dossiers ou individuellement les styles
import '../styles/animations/index.scss';
import '../styles/login.scss';

document.getElementById('showpwd').addEventListener('click', () => {
 if (document.getElementById('inputPassword').type == "password") {
  document.getElementById('inputPassword').type = "text"
 } else if (document.getElementById('inputPassword').type == "text") {
  document.getElementById('inputPassword').type = "password"
 }
})

document.getElementById('sign-in').addEventListener('click', (e) => {
 e.preventDefault();
 if (document.getElementById('sign-in').className != 'active') {
  document.getElementById('sign-up').classList.remove('active');
  document.getElementById('sign-in').classList.add('active');

  document.getElementById('sign-up-form').classList.add('fade-out');
  document.getElementById('sign-up-form').classList.add('display_none');

  document.getElementById('sign-in-form').classList.add('fade-in');
  document.getElementById('sign-in-form').classList.remove('fade-out');
  document.getElementById('sign-in-form').classList.remove('display_none');
 }
})

document.getElementById('sign-up').addEventListener('click', (e) => {
 e.preventDefault();
 if (document.getElementById('sign-up').className != 'active') {
  document.getElementById('sign-in').classList.remove('active');
  document.getElementById('sign-up').classList.add('active');

  document.getElementById('sign-in-form').classList.add('fade-out');
  document.getElementById('sign-in-form').classList.add('display_none');

  document.getElementById('sign-up-form').classList.add('fade-in');
  document.getElementById('sign-up-form').classList.remove('fade-out');
  document.getElementById('sign-up-form').classList.remove('display_none');

 }
})