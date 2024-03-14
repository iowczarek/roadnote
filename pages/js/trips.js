let manageNotesPopup = document.getElementById("manage_popup");
let noteslistPopup = document.getElementById("deleteNote_popup");
let updateNamePopup = document.getElementById("updateName_popup");

function managePopup(){
    manageNotesPopup.classList.add("open-popup");
}
function closePopup() {
    manageNotesPopup.classList.remove("open-popup");
 }  

function delete_openPopup(noteName){
    var popupContent = document.getElementById('popupContent');
   popupContent.textContent = noteName;
   noteslistPopup.style.display = "block";
   picBackDrop.style.display = 'block';
}
function update_openPopup(noteId){

   updateNamePopup.classList.add("open-popup");
   document.getElementById('popupIdContent').value = noteId;
   picBackDrop.style.display = 'block';
}
function note_closePopup(){
    noteslistPopup.style.display = "none";
   picBackDrop.style.display = 'none';
}
function title_closePopup(){
    updateNamePopup.style.display = 'none';
   picBackDrop.style.display =  'none';
}
   
function deleteNote() {
    var popupContent = document.getElementById('popupContent').textContent;
    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', './trips.php'); 
 
    var input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'noteName');
    input.setAttribute('value', popupContent);
 
    form.appendChild(input);
    document.body.appendChild(form);

    form.submit();
 }

 