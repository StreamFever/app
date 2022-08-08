console.log("Panel wigets")

function testUv(idPanel) {
 let arrPanel = ["event", "match", "tweets", "popup"];

 arrPanel.forEach(e => {
  if (document.getElementById('panel_btn_' + e).classList.contains('active')) {
   console.log("Suppresion")
   document.getElementById('panel_btn_' + e).classList.remove('active');
   document.getElementById('panel_' + e).classList.add('display_none');
  }
 });

 if (!document.getElementById('panel_btn_' + idPanel).classList.contains('active')) {
  console.log("Add")
  document.getElementById('panel_btn_' + idPanel).classList.add('active');
  document.getElementById('panel_' + idPanel).classList.remove('display_none');
 }
}

if (document.location.pathname.includes('/admin/overlay/') && document.location.pathname != '/admin/overlay/new' && document.location.pathname != '/admin/overlay/edit') {
 document.getElementById('panel_btn_event').addEventListener('click', function (e) {
  e.preventDefault();
  testUv('event');
 });

 document.getElementById('panel_btn_match').addEventListener('click', function (e) {
  e.preventDefault();
  testUv('match');
 });

 document.getElementById('panel_btn_popup').addEventListener('click', function (e) {
  e.preventDefault();
  testUv('popup');
 });

 document.getElementById('panel_btn_tweets').addEventListener('click', function (e) {
  e.preventDefault();
  testUv('tweets');
 });
}

