//pic upload 
let photoPopup = document.getElementById("upload_popup");
let delphotoPopup = document.getElementById("delete_popup");
let delaccountPopup = document.getElementById("deleteacc_popup");
let namePopup = document.getElementById("updatename_popup");
let emailPopup = document.getElementById("updateemail_popup");
let passPopup = document.getElementById("updatepass_popup");
const picBackDrop = document.getElementById('picBackDrop');

function name_openPopup() {
   namePopup.classList.add("pic-open-popup");
   picBackDrop.style.display = 'block';
}
function name_closePopup() {
   namePopup.classList.remove("pic-open-popup");
   picBackDrop.style.display = 'none';
}  
function email_openPopup() {
   emailPopup.classList.add("pic-open-popup");
   picBackDrop.style.display = 'block';
}
function email_closePopup() {
   emailPopup.classList.remove("pic-open-popup");
   picBackDrop.style.display = 'none';
}  
function pass_openPopup() {
   passPopup.classList.add("pic-open-popup");
   picBackDrop.style.display = 'block';
}
function pass_closePopup() {
   passPopup.classList.remove("pic-open-popup");
   picBackDrop.style.display = 'none';
}  

 function pic_openPopup() {
    photoPopup.classList.add("pic-open-popup");
    picBackDrop.style.display = 'block';
 }
 function pic_closePopup() {
    photoPopup.classList.remove("pic-open-popup");
    picBackDrop.style.display = 'none';
 }  

 function del_openPopup() {
    delphotoPopup.classList.add("pic-open-popup");
    picBackDrop.style.display = 'block';
 }
 function del_closePopup() {
    delphotoPopup.classList.remove("pic-open-popup");
    picBackDrop.style.display = 'none';
 } 
 function acc_openPopup() {
   delaccountPopup.classList.add("pic-open-popup");
   picBackDrop.style.display = 'block';
}
function acc_closePopup() {
   delaccountPopup.classList.remove("pic-open-popup");
   picBackDrop.style.display = 'none';
}  

const form = document.querySelector(".upload-form"),
fileInput = form.querySelector(".file-input");


form.addEventListener("click", ()=>{
    fileInput.click();

});





