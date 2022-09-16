// //Panel
// function twitter_delete(id) {
//     socket.emit("twitter_deletetweet", id);
//     gettweets();
//     deleteSuccessTweet();
// }

// function twitter_select(id) {
//     socket.emit("twitter_selecttweet", id);
//     successToastSelectTweet();
// }

// socket.on('twitter_answer', async (data) => {
//     var tweets = ""
//     data.forEach(element => {
//         console.log(element.id)
//         if (element.media_type == "undefined") {
//             tweets = tweets + '<tr><td><div style="width: 80%"><img style="width: 100%;" src="' + element.avatar_url + '" alt="Avatar"></div></td><td>' + element.pseudo + '</td><td><a href="https://twitter.com/' + element.affichage + '" target="blank">@' + element.affichage + '</a></td><td><p>' + element.texte + '</p></td><td></td><td><i style="cursor: pointer" class="mdi mdi-delete-forever" onclick="twitter_delete(' + element.id + ')"></i><i style="cursor: pointer" class="mdi mdi-arrow-right" onclick="twitter_select(' + element.id + ')" data-dismiss="modal"></i></td></tr>'
//         } else if (element.media_type == "photo") {
//             tweets = tweets + '<tr><td><div style="width: 80%"><img style="width: 100%;" src="' + element.avatar_url + '" alt="Avatar"></div></td><td>' + element.pseudo + '</td><td><a href="https://twitter.com/' + element.affichage + '" target="blank">@' + element.affichage + '</a></td><td><p>' + element.texte + '</p></td><td><div style="width: 100%"><img style="width: 100%;" src="' + element.madia_url + '" alt="Media du Tweet"></div></td><td><i style="cursor: pointer" class="mdi mdi-delete-forever" onclick="twitter_delete(' + element.id + ')"></i><i style="cursor: pointer" class="mdi mdi-arrow-right" onclick="twitter_select(' + element.id + ')" data-dismiss="modal"></i></td></tr>'
//         } else if (element.media_type == "video") {
//             tweets = tweets + '<tr><td><div style="width: 80%"><img style="width: 100%;" src="' + element.avatar_url + '" alt="Avatar"></div></td><td>' + element.pseudo + '</td><td><a href="https://twitter.com/' + element.affichage + '" target="blank">@' + element.affichage + '</a></td><td><p>' + element.texte + '</p></td><td><div style="width: 100%"><video width="300px" loop autoplay muted><source src="' + element.madia_url + '" type="video/mp4"></video></div></td><td><i style="cursor: pointer" class="mdi mdi-delete-forever" onclick="twitter_delete(' + element.id + ')"></i><i style="cursor: pointer" class="mdi mdi-arrow-right" onclick="twitter_select(' + element.id + ')" data-dismiss="modal"></i></td></tr>'
//         } else if (element.media_type == "animated_gif") {
//             tweets = tweets + '<tr><td><div style="width: 80%"><img style="width: 100%;" src="' + element.avatar_url + '" alt="Avatar"></div></td><td>' + element.pseudo + '</td><td><a href="https://twitter.com/' + element.affichage + '" target="blank">@' + element.affichage + '</a></td><td><p>' + element.texte + '</p></td><td><div style="width: 100%"><video width="300px" loop autoplay muted><source src="' + element.madia_url + '" type="video/mp4"></video></div></td><td><i style="cursor: pointer" class="mdi mdi-delete-forever" onclick="twitter_delete(' + element.id + ')"></i><i style="cursor: pointer" class="mdi mdi-arrow-right" onclick="twitter_select(' + element.id + ')" data-dismiss="modal"></i></td></tr>'
//         }
//     });

//     if (table != "") {
//         setTimeout(() => {
//             document.getElementById('tweets_block').innerHTML = '<table id="data_tweets" class="display"></table>'
//             document.getElementById('data_tweets').innerHTML = '<thead><tr><th>Avatar</th><th>Pseudo</th><th>@Twitter</th><th>Contenu</th><th>Media</th><th>Actions</th></tr><thead><tbody id="tweets_data">' + tweets + '</tbody>'
//             table = $('#data_tweets').DataTable();
//         }, 1000)
//     } else {
//         setTimeout(() => {
//             document.getElementById('data_tweets').innerHTML = '<thead><tr><th>Avatar</th><th>Pseudo</th><th>@Twitter</th><th>Contenu</th><th>Media</th><th>Actions</th></tr><thead><tbody id="tweets_data">' + tweets + '</tbody>'
//             table = $('#data_tweets').DataTable();
//         }, 1000)
//     }
// })

// function gettweets() {
//     if (table != "") {
//         table.destroy()
//     }
//     document.getElementById('data_tweets').innerHTML = '<div class="block_loading"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div><span>RECUPERATION DES TWEETS EN COURS</span></div>'
//     setTimeout(() => {
//         socket.emit("twitter_gettweets");
//     }, 1000)
// }


// //Overlay
// socket.on('tweet_selected', async (data) => {
//     if (data[3] == 'undefined') {
//         document.getElementById('tweet_sample_text').classList.remove('display_none')
//         document.getElementById('tweet_img').classList.add('display_none')
//         document.getElementById('tweet_video').classList.add('display_none')
//         document.getElementById('text_avatar').src = data[2]
//         document.getElementById('text_pseudo').innerHTML = data[0]
//         document.getElementById('text_display').innerHTML = '@' + data[1]
//         document.getElementById('text_texte').innerHTML = data[5]
//     } else if (data[3] == 'photo') {
//         document.getElementById('tweet_img').classList.remove('display_none')
//         document.getElementById('tweet_sample_text').classList.add('display_none')
//         document.getElementById('tweet_video').classList.add('display_none')
//         document.getElementById('img_avatar').src = data[2]
//         document.getElementById('img_pseudo').innerHTML = data[0]
//         document.getElementById('img_display').innerHTML = '@' + data[1]
//         document.getElementById('img_texte').innerHTML = data[5]
//         document.getElementById('img_image').src = data[4]
//     } else if (data[3] == 'video' || data[3] == 'animated_gif') {
//         document.getElementById('tweet_video').classList.remove('display_none')
//         document.getElementById('tweet_img').classList.add('display_none')
//         document.getElementById('tweet_sample_text').classList.add('display_none')
//         document.getElementById('video_avatar').src = data[2]
//         document.getElementById('video_pseudo').innerHTML = data[0]
//         document.getElementById('video_display').innerHTML = '@' + data[1]
//         document.getElementById('video_texte').innerHTML = data[5]
//         var video = document.getElementById('video_video')
//         var source = document.getElementById('video_src')
//         source.setAttribute('src', data[4])
//         video.load().then(video.play())
//     }
// })