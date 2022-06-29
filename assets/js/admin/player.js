console.log('player')
if (typeof document.getElementById('twitch-embed' !== undefined) && window.location.pathname == "/admin/overlay/u") {
  console.log("OK")
  new Twitch.Player("twitch-embed", {
    width: 950,
    height: 480,
    channel: "sixquatre",
    autoplay: false
  });

  // FIXME: HS - undefined
  // embed.addEventListener(Twitch.Embed.VIDEO_READY, function () {
  //  console.log('The video is ready');
  // });
}

document.getElementById('btn_toggle_size_twitch').addEventListener('click', function (e) {
  e.preventDefault();
  console.log("clickk")
  var twitch_embed = document.getElementById('twitch-embed');
  if (twitch_embed.classList.contains('twitch-embed-small')) {
    twitch_embed.classList.remove('twitch-embed-small');
    twitch_embed.classList.add('twitch-embed-large');
  } else {
    twitch_embed.classList.remove('twitch-embed-large');
    twitch_embed.classList.add('twitch-embed-small');
  }
});