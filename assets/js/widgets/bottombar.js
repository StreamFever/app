function currentTime() {
 let date = new Date();
 let hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
 let minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
 let seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();

 let divTime = document.getElementById('currentTime');

 divTime.innerHTML = hours + ':' + minutes + ':' + seconds;
}

setInterval(currentTime, 1000);