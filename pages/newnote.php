<?php
require_once "login/connect.php";
session_start();

    if(!isset($_SESSION['logged'])){
        header('Location:login/login.php');
        exit();
    }

$conn = connect();

$id = $_SESSION['id'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$note_id = isset($_GET['nid']) ? $_GET['nid'] : null;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function retrieveNoteById($note_id) {
$conn = connect();

$sql = "SELECT * FROM user_notes WHERE note_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $note_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $note = $result->fetch_assoc();
    return $note;
} else {
    return null; 
}
}
$note = retrieveNoteById($note_id);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
    
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="1.0">
      <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
      <link href=" https://cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/mainup.css">
      <link rel="stylesheet" href="css/newnote.css">
      <title>roadnote • <?php
                            if ($note) {
                            echo "{$note['note_title']}";
                            } else echo "new note";
                        ?></title>
    </head>
    
    <body>
       

<?php 
    include_once 'sidebar.php';
?>
<?php 
    include_once 'mainup.php';
?>
<div class="mainbox">
        <div id="header">
        

        <button id="backButton" onclick="openPopup()">
           <span class="material-symbols-sharp">arrow_back</span>
        </button>

        <div id="newtitle"><?php

if ($note) {
    echo "{$note['note_title']}";
   
} 

?></div>
               <div id="editor-btns">
                   
               <button id="saveButton" <?php
                if(isset($_GET['nid'])) {
                    echo 'onclick="updatePopup()"';
                } else {
                    echo 'onclick="opensavePopup()"';
                }
            ?>>save</button>
                   <button id="cancelButton" onclick="openPopup()">cancel</button>

               </div>
           </div>
<div id="editor">
<?php

if ($note) {
    echo "{$note['note_desc']}";
} 

?>
</div>
</div>

<!-- SAVE TRIP POPUP  -->
<div class="saveTrip_popup" id="saveTrip_popup">
            <header>SAVE YOUR NOTE</header>
                <p>Give your note a title:</br>
              <input id="titleInput">
                <div id="errorMessage"></div>
                <div class="trips_buttons">
                        <button id="saving-btn" type="button" onclick="saveNote()">SAVE</button>
                        <a onclick="closesavePopup()">
                            <button id="trips-yes-btn">CANCEL</button>
                        </a>
                </div>
</div>

<!-- UPDATE TRIP POPUP  -->
<div class="updateTrip_popup" id="updateTrip_popup">
            <header>UPDATE YOUR NOTE</header>
                <p>Do you want to save your changes? Your note will be updated.</br>
               <input id="titleUpdate" value="<?php echo $note['note_title'] ?>">
                <div class="trips_buttons">
                        <button id="saving-btn" type="button" onclick="updateNote()">SAVE</button>
                        <a onclick="closesavePopup()">
                            <button id="trips-yes-btn">CANCEL</button>
                        </a>
                </div>
</div>


<!-- CANCELING POPUP  -->
<div class="cancelTrip_popup" id="cancelTrip_popup">
            <header>CANCEL</header>
                <p>Are you sure you want to cancel any changes?</br>
              
                <div class="trips_buttons">
                        <button id="trips-yes-btn" type="button" onclick="redirectToTrips()">YES</button>
                        <a onclick="closePopup()">
                            <button id="canceling-btn">NO</button>
                        </a>
                </div>
</div>


<div id="backDrop"></div>
<script type="text/javascript">
            
             var user_id = <?php echo json_encode($id); ?>;
             var note_id = <?php echo json_encode($note_id);?>;

        </script>
  <script src="js/newnote.js"> </script> 
    </body>
    </html>