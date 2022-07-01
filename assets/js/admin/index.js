import './api';
import './control_widget';
import './datatable';
import './ui';
import './toasts';
import './ws';
// import './player';
import { initWsServer } from './ws';
import './services/colorVideo';

initWsServer.call()

$(function () {
 $('#datetimepicker1').datetimepicker();
});