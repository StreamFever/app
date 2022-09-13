export const socket = io("https://websocketv2.artaic.fr");

export const initWsServer = () => {
    console.log(window.location.pathname)
    if(window.location.pathname == "/admin/overlay/new"){//Si le client essaye de créer un nouvel overlay
        socket.emit('auth', [document.getElementById('userID').value, document.getElementById('username').value, window.location.pathname], () => { console.log("Hello") })
    }else if (window.location.pathname.startsWith('/admin/overlay/')) { //Si client sur un panneau de contrôle, data[2] = ID pour recherche de room
        socket.emit('auth', [document.getElementById('userID').value, document.getElementById('username').value, window.location.pathname, window.location.pathname.replace('/admin/overlay/', '').split('/')[0]], () => { console.log("Hello") });
    } else if (window.location.pathname.startsWith('/overlay/')) { //Connexion sur un overlay
        socket.emit('auth', [window.location.pathname.replace('/overlay/', '').split('/')[0], "Browsersource", window.location.pathname, window.location.pathname.replace('/overlay/', '').split('/')[0]], () => { console.log("Hello") });
    } else { //Sinon authentification classique
        socket.emit('auth', [document.getElementById('userID').value, document.getElementById('username').value, window.location.pathname], () => { console.log("Hello") })
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

    socket.on('refresh',()=>{
        location.reload()
    })//Refresh sur event
}


initWsServer();