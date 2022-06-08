import axios from "axios";

export const findAllOverlays = () => {
  return new Promise((onSuccess, onFail) => {
    axios
    .get('https://v4.dev.symfony.artaic.fr/api/overlays.json')
    .then((response, error) => {
      if(!response || error) {
       return onFail(`Erreur Axios API : ${error}`);
      }
      onSuccess(response);
    })
  })
}