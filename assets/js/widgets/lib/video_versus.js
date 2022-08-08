import { socket } from "../../admin/ws";

let versusVisible = false;

export const showVideoVersus = (name_map) => {
    if (name_map != false) {
        versusVisible = true;
        if (topbar.className != 'display_none') {
            socket.emit("hide_topbar");
        }
        if (leftpopuptext.className != 'display_none' && textpopuptext.className != 'display_none') {
            socket.emit("hide_popup");
        }
        if (teams_nextmatch.className != 'display_none' && textnextmatch.className != 'display_none') {
            socket.emit("hide_nextmatch");
        }
        // if (lsd_cam.className != 'display_none') {
        //     socket.emit("hide_camlsd");
        // }
        if (bottombar.className != 'display_none') {
            socket.emit("hide_bottombar");
        }
        setTimeout(() => {
            video_versus.innerHTML = ` <video muted id="video_element_versus" width="1920" height="1080" autoplay onended="offVersus()">
            <source src="https://cdn.artaic.fr/videos/maps/${name_map}_v2.mp4" type="video/mp4">
        </video> 
        <audio autoplay id="audio_element_versus">
            <source src="https://cdn.artaic.fr/videos/maps/${name_map}_v2.mp3" type="audio/mpeg">
        </audio> 
        `;
            video_versus.className = "fade-in";
            setTimeout(() => {
                if (versusVisible == true) {
                    console.log(document.getElementById("video_element_versus"));
                    console.log(document.getElementById("audio_element_versus"));
                    versuscontainer.className = 'container_versus scale-in-center'
                    top_versus.className = "top";
                    leftversus.className = "left";
                    centerversus.className = "center";
                    rightversus.className = "right";
                }
            }, 10000);
        }, 1500);
    } else {
        socket.emit("err_versus");
        socket.emit("hide_versus2");
    }
}