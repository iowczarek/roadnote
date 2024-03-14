// Get the button
let mybutton = document.getElementById("to_top");

// When the user scrolls down 20px from the top of the document, show the button
mybutton.style.display = "none";

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
    mybutton.style.display = "";
  } else {
    mybutton.style.display = "none";
  }
}


