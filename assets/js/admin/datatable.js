$(document).ready(function () {
 console.log("Datatable");
 const options = {
  "language": {
   "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json"
  }
 };
 $('#showOverlayU').DataTable(options);
 $('#playerList').DataTable(options);
 $('#eventList').DataTable(options);
 $('#teamList').DataTable(options);
 $('#userList').DataTable(options);
 $('#overlayList').DataTable(options);
 $('#mapList').DataTable(options);
 $('#gameList').DataTable(options);
 $('#logList').DataTable(options);
});