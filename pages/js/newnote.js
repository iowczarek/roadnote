let toolbaroptions = [
    ["bold", "italic", "underline", "strike"], // toggled buttons
    [{header:[1,2,3,4,5,6,false]}],
    [{list:"ordered"}, {list:"bullet"}],
    [{script:"sub"}, {script:"super"}], // superscript/subscript
    [{indent:"-1"}, {indent:"+1"}], // outdent/indent
    [{align:[]}],
    [{direction:"rtl"}], // text direction
    [{size:["small", false, "large", "huge"]}], // custom dropdown
    [{header:1}, {header:2}], // header dropdown
    [{color:[]}, {background:[]}], // dropdown with defaults from theme
    [{font:[]}],
    ["clean"], // remove formatting button
    ["image","link", "video"] // link and image, video
]
let quill = new Quill('#editor', {
    modules: {
        toolbar: toolbaroptions,
    },
    theme: "snow" 
})
let tripPopup = document.getElementById("cancelTrip_popup");
let tripsavePopup = document.getElementById("saveTrip_popup");
let tripupdatePopup = document.getElementById("updateTrip_popup");
const errorMessage = document.getElementById('errorMessage');

function saveNote() {

    var titleValue = $('#titleInput').val();
    var editor =document.getElementById("editor");
    let editorContent = editor.innerHTML;

    if(titleInput.value){
        if (titleValue.length > 15 ){
            titleInput.classList.add('error');
        errorMessage.innerHTML = 'Choose shorter title';
        }
        else {
        titleInput.classList.remove('error');
        errorMessage.innerHTML = '';

        $.ajax({
            url: './includes/save_note.php',
            type: 'POST',
            data: {
                titleValue: titleValue,
                editorContent: editorContent, 
                user_id: user_id,
            },
            success: function (response) {
                if (response.status) {
                    window.location.href = './trips.php?success';
                } else {
                    window.location.href = './trips.php?error';
                }
            }
          })}
        }
    else {
        titleInput.classList.add('error');
        errorMessage.innerHTML = 'No title';
    }
}

function updateNote() {

    var editor =document.getElementById("editor");
    let editorContent = editor.innerHTML;
    var inputTitle = document.getElementById("titleUpdate");
             var note_title = inputTitle.value;

        console.log('Sending data:', note_id, editorContent);
        $.ajax({
            url: './includes/update_note.php',
            type: 'POST',
            data: {
                note_title: note_title,
                note_id: note_id,
                editorContent: editorContent, 
                user_id: user_id,
            },
            success: function (response) {
    
                if (response.status) {
                    window.location.href = './trips.php?usuccess';
                } else {
                    window.location.href = './trips.php?error';
                }
            }
          })}


/////////////////// buttons //////////////////////////

function openPopup() {
    tripPopup.classList.add("open-popup");
    backDrop.style.display = 'block';
 }
 function closePopup() {
    tripPopup.classList.remove("open-popup");
    backDrop.style.display = 'none';
    
 } 
 function opensavePopup() {
    tripsavePopup.classList.add("open-popup");
    backDrop.style.display = 'block';
 }

 function updatePopup() {
    tripupdatePopup.classList.add("open-popup");
    backDrop.style.display = 'block';
 }
 function closesavePopup() {
    tripsavePopup.classList.remove("open-popup");
    tripupdatePopup.classList.remove("open-popup");
    backDrop.style.display = 'none';
    titleInput.classList.remove('error');
    errorMessage.innerHTML = '';

 } 
 function redirectToTrips() {
    window.location.href = 'trips.php'; 
}
