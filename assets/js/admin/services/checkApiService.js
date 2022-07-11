// TODO: Importer le WS comme dans control_widget

// Permet de check quel input est checked parmi tous les radios dans l'admin/overlays/u/...
export const getCheckedValueIntoRadio = (dataArray, list) => {
 list = list.slice()
 for (let i = 0; i < dataArray.length; i++) {
  // TODO: Si l'input radio WidgetId est sur WidgetId ... sinon si il est sur WidgetId.libWidgetId ...
  let nodeList = document.getElementsByName(dataArray[i].WidgetId);

  for (let i = 0; i < nodeList.length; i++) {
   // Liste l'input checked par chaque radio
   if (nodeList[i].checked === true) {
    list.push(nodeList[i]);
   }
  }
 }
 // TODO: Génère une liste d'overlay actif selon l'admin donc à envoyer en WS
 console.log(list);
}