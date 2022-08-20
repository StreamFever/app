export const notification = (message, type, title) => {
 let color = "blue";
 if (type == "success") {
  color = "green"
 } else if (type == "error") {
  color = "red"
 } else if (type == "warning") {
  color = "yellow"
 } else if (type == "info") {
  color = "blue"
 }
 iziToast.show({ title: title, message: message, color: color })
}