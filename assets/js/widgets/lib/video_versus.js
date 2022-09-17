import { socket } from "../../admin/ws";

let versusVisible = false;


export const showVideoVersus = () => {
    let name_map = document.getElementById('video_versus').dataset.map;
    if (name_map != false) {
        versusVisible = true;
        setTimeout(() => {
            video_versus.innerHTML = ` <video muted id="video_element_versus" width="1920" height="1080" autoplay onended="offVersus(); changeAuto('video_versus')">
            <source src="https://cdn.artaic.fr/stream_cave/videos/maps/${name_map}_v2.mp4" type="video/mp4">
        </video> 
        <audio autoplay id="audio_element_versus">
            <source src="https://cdn.artaic.fr/stream_cave/videos/maps/${name_map}_v2.mp3" type="audio/mpeg">
        </audio> 
        `;
            video_versus.className = "fade-in";
            setTimeout(() => {
                if (versusVisible == true) {
                    console.log(document.getElementById("video_element_versus"));
                    console.log(document.getElementById("audio_element_versus"));
                    versuscontainer.className = 'container_versus scale-in-center'
                    // top_versus.className = "top";
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