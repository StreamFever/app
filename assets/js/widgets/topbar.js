console.log("TOP BAR");
console.log(document.querySelector('#myCarousel'));

if (document.querySelector('#myCarousel') != null) {
 var myCarousel = document.querySelector('#myCarousel')
 var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 10000,
  wrap: false
 })
}