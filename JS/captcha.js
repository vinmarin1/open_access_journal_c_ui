document.addEventListener('DOMContentLoaded', createCaptcha())
var code;
function createCaptcha() {
  document.getElementById('captcha').innerHTML = "";
  var charsArray =
  "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  var lengthOtp = 6;
  var captcha = [];
  for (var i = 0; i < lengthOtp; i++) {
    //below code will not allow Repetition of Characters
    var index = Math.floor(Math.random() * charsArray.length); //get the next character from the array
    if (captcha.indexOf(charsArray[index]) == -1)
      captcha.push(charsArray[index]);
    else i--;
  }
  var canv = document.createElement("canvas");
  canv.id = "captcha";
  canv.width = 120;
  canv.height = 50;
  var ctx = canv.getContext("2d");
  var fonts = ["italic  25px Arial","bold 30px Cursive", "bold italic 30px Verdana"];
  var spacing = 17; // Spacing between letters

  for (var i = 0; i < captcha.length; i++) {
    ctx.font = fonts[i % fonts.length];
    var alpha = Math.random() * 0.5 + 0.5; // Random alpha between 0.5 and 1 for opacity
    ctx.globalAlpha = alpha;
    ctx.strokeText(captcha[i], i * spacing, 30);
  }
//   ctx.strokeText(captcha.join(""), 0, 30);
  code = captcha.join("");
  document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
}

