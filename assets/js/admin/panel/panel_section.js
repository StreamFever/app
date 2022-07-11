console.log("Panel wigets")

function panelBtn(idBtn) {
 // Ne pas enlever l'élément en duppliqué - FIXME: Voir pour que l'algo tourne parmi tous les panel_x
 let arrPanel = ["event", "match", "twitter", "popup", "twitter"];
 document.getElementById('btn_panel_' + idBtn).addEventListener('click', function (e) {
  arrPanel.forEach(e2 => {
   console.log(e2);
   document.getElementById('panel_' + e2).classList.forEach(element => {
    if (element == 'active') {
     document.getElementById('panel_' + e2).classList.remove('active');
     console.log('Suppression active de ' + e2)
     // document.getElementById('panel_' + e2).classList.add('active');
    }
    if (element != 'active') {
     document.getElementById('panel_' + idBtn).classList.add('active');
     console.log('Ajout active de ' + e2)
    }
   });
  })
 })
}

if (document.location.pathname.includes('/admin/overlay/')) {
 panelBtn('event');
 panelBtn('match');
 panelBtn('twitter');
 panelBtn('popup');
}