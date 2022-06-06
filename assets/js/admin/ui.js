function copyText() {
  /* Get the text field */
  let copyText = document.getElementById("inputCopied").href;
  console.log(copyText);
 
  /* Copy the text inside the text field */
  navigator.clipboard.writeText();
 }
