export const socket = io("https://websocketv2.artaic.fr");

export const initWsServer = () => {
    console.log(window.location.pathname)
    if (window.location.pathname.startsWith('/admin/overlay/')) { //Si client sur un panneau de contrôle, data[2] = ID pour recherche de room
        socket.emit('auth', [document.getElementById('userID').value, document.getElementById('username').value, window.location.pathname, window.location.pathname.replace('/admin/overlay/', '')], () => { console.log("Hello") });
        console.log('auth from panel')
    } else if (window.location.pathname.startsWith('/overlay/')) { //Connexion sur un overlay
        socket.emit('auth', [window.location.pathname.replace('/overlay/', '').split('/')[0], "Browsersource", window.location.pathname, window.location.pathname.replace('/overlay/', '').split('/')[0]], () => { console.log("Hello") });
        console.log('auth from overlay')
    } else { //Sinon authentification classique
        socket.emit('auth', [document.getElementById('userID').value, document.getElementById('username').value, window.location.pathname], () => { console.log("Hello") })
        console.log('auth')
    }

    socket.on("disconnect", () => {
        location.reload()
    }); //Reconnexion automatique en cas de coupure avec le serveur websocket 

    socket.io.on('reconnect', () => {
        location.reload()
    }); //Reconnexion automatique en cas de coupure avec le serveur websocket

    socket.io.on('error', () => {
        alert('Pas de connexion au serveur websocket, veuillez contacter un admin.')
    })

    socket.on('logout', () => {
        window.location.replace("https://v4.dev.symfony.artaic.fr")
    })
}
