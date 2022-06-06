// TOP BAR
import './topbar';

console.log("Index Widgets OK");

// window.x = function(...) permet de pouvoir lancer la fonction dans la console commme :
// >> x.call()

window.showTopbar = function showTopBar() {
 topbar.className = 'swing-in-top-fwd'
 console.log("TOP")
}
window.showVersus = function showVersus() {
 versuscontainer.className = 'container_versus slide-in-left'
}
window.showBreak = function showBreak() {
 breakk.className = 'slide-in-left'
 leftbreak.className = 'left'
 rightbreak.className = 'right'
 centerbreak.className = 'center'
 topbreak.className = 'top'
 setTimeout(() => {
  topbreak.className = 'topbg swing-in-top-fwd'
 }, 500);
}
window.showText = function showText() {
 leftpopuptext.className = 'left slide-in-left'
 setTimeout(() => {
  textpopuptext.className = 'text slide-in-left-popup-text'
 }, 500);
}
window.showNext = function showNext() {
 teams_nextmatch.className = 'teams slide-in-left'
 setTimeout(() => {
  textnextmatch.className = 'text swing-in-top-fwd'
 }, 500)
}
window.showBottomBar = function showBottomBar() {
 bottombar.className = 'slide-in-bottom'
}
window.showTweetSample = function showTweetSample() {
 tweet_sample_text.className = 'slide-in-bottom'
 sound.innerHTML = `<figure>
 <figcaption>Listen to the T-Rex:</figcaption>
 <audio id="audio" controls autoplay src="https://cdn.artaic.fr/images/pio_new.mp3">
 </audio>
</figure>`;
}
window.showTweetImg = function showTweetImg() {
 tweet_img.className = 'slide-in-bottom'
 sound.innerHTML = `<figure>
 <figcaption>Listen to the T-Rex:</figcaption>
 <audio id="audio" controls autoplay src="https://cdn.artaic.fr/images/pio_new.mp3">
 </audio>
</figure>`;
}

window.showTweetVideo = function showTweetVideo() {
 tweet_video.className = 'slide-in-bottom'
 sound.innerHTML = `<figure>
 <figcaption>Listen to the T-Rex:</figcaption>
 <audio id="audio" controls autoplay src="https://cdn.artaic.fr/images/pio_new.mp3">
 </audio>
</figure>`;
}
window.showFiveCam = function showFiveCam() {
 bottom_cam.className = 'fade-in';
}
window.showFiveCam = function showPoll() {
 poll.className = 'slide-in-left'
}


window.offTopbar = function offTopBar() {
 topbar.className = 'slide-out-top'
 setTimeout(() => {
  topbar.className = 'display_none'
 }, 1000);
}
window.offVersus = function offVersus() {
 versuscontainer.className = 'container_versus slide-out-left'
 setTimeout(() => {
  versuscontainer.className = 'display_none'
 }, 1000)
}
window.offBreak = function offBreak() {
 breakk.className = 'slide-out-left'
 setTimeout(() => {
  breakk.className = 'display_none'
  topbreak.className = 'display_none'
  leftbreak.className = 'display_none'
  rightbreak.className = 'display_none'
  centerbreak.className = 'display_none'
 }, 1000)
}

window.offText = function offText() {
 textpopuptext.className = 'text slide-out-left-popup-text'
 setTimeout(() => {
  leftpopuptext.className = 'left slide-out-left'
 }, 500);
 setTimeout(() => {
  leftpopuptext.className = 'display_none'
  textpopuptext.className = 'display_none'
 }, 1200)
}
window.offNext = function offNext() {
 textnextmatch.className = 'text swing-out-top-bck'
 setTimeout(() => {
  teams_nextmatch.className = 'teams slide-out-left'
 }, 1000)

 setTimeout(() => {
  teams_nextmatch.className = 'display_none'
  textnextmatch.className = 'display_none'
 }, 2000)
}
window.offBottomBar = function offBottomBar() {
 bottombar.className = 'top slide-out-bottom'
 setTimeout(() => {
  bottombar.className = 'display_none'
 }, 1000)
}

window.offTweetSampleText = function offTweetSampleText() {
 tweet_sample_text.className = 'fade-out'
 setTimeout(() => {
  tweet_sample_text.className = 'display_none'
 }, 1000)
}

window.offTweetImg = function offTweetImg() {
 tweet_img.className = 'fade-out'
 setTimeout(() => {
  tweet_img.className = 'display_none'
 }, 1000)
}

window.offTweetVideo = function offTweetVideo() {
 tweet_video.className = 'fade-out'
 setTimeout(() => {
  tweet_video.className = 'display_none'
 }, 1000)
}

window.offPoll = function offPoll() {
 poll.className = 'slide-out-left'
 setTimeout(() => {
  poll.className = 'display_none'
 }, 1000)
}
window.offFiveCam = function offFiveCam() {
 bottom_cam.className = 'fade-out';
 setTimeout(() => {
  bottom_cam.className = 'display_none'
 }, 1000)
}

