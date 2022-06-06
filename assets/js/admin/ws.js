export const nameOfFunction = () => {
    const socket = io("https://websocketv2.artaic.fr");

    socket.on("disconnect", () => {
        location.reload()
    }); //Reconnexion automatique en cas de coupure avec le serveur websocket
}
