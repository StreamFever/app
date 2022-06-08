export const nameOfFunction = () => {
    const socket = io("https://websocketv2.artaic.fr");

    socket.emit('auth', [document.getElementById('userID').value,document.getElementById('username').value])
    
	console.log('Authentification')

    socket.on("disconnect", () => {
        location.reload()
    }); //Reconnexion automatique en cas de coupure avec le serveur websocket 
}
