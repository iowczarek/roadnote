// edition pop-up
 let mapPopup = document.getElementById("countries_popup");
 let countrylistPopup = document.getElementById("deleteCountry_popup");


 function openPopup() {
    mapPopup.classList.add("open-popup");
 }
 function closePopup() {
    mapPopup.classList.remove("open-popup");
 }  
 
 function countries_openPopup(countryName) {
   var popupContent = document.getElementById('popupContent');
   popupContent.textContent = countryName;
   countrylistPopup.style.display = "block";
   picBackDrop.style.display = 'block';
}
function countries_closePopup() {
   countrylistPopup.style.display = "none";
   picBackDrop.style.display = 'none';
} 
   
function deleteCountry() {
   var popupContent = document.getElementById('popupContent').textContent;

   var form = document.createElement('form');
   form.setAttribute('method', 'post');
   form.setAttribute('action', './map.php'); 

   var input = document.createElement('input');
   input.setAttribute('type', 'hidden');
   input.setAttribute('name', 'countryName');
   input.setAttribute('value', popupContent);

   form.appendChild(input);
   document.body.appendChild(form);

   form.submit();
}

