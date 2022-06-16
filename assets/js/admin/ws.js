export const nameOfFunction = () => {
    const socket = io("https://websocketv2.artaic.fr");

    if (window.location.pathname.includes('/admin/overlay/u/')) { //Si client sur un panneau de contrôle, data[2] = ID pour recherche de room
        socket.emit('auth', [document.getElementById('userID').value, document.getElementById('username').value, window.location.pathname.replace('/admin/overlay/u/', '')]);
    } else { //Sinon authentification classique
        socket.emit('auth', [document.getElementById('userID').value, document.getElementById('username').value])
    }

    socket.on("disconnect", () => {
        location.reload()
    }); //Reconnexion automatique en cas de coupure avec le serveur websocket 
}
