import { findAllOverlays } from './api';
import { getCheckedValueIntoRadio } from './services/checkApiService';
import './ws'; // TODO: Changer comme au dessus - Import Websocket service

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

async function waitApiTraitement() {
 const arr = await thenFindAllOverlays()


 async function controlWidget() {
  let list = [];
  await getCheckedValueIntoRadio(dataArray, list);
  await document.addEventListener('change', () => {
   getCheckedValueIntoRadio(dataArray, list);
  })
 }

 controlWidget();
}

waitApiTraitement();