<?php
require_once "login/connect.php";
  session_start();

  if(!isset($_SESSION['logged'])){
      header('Location:login/login.php');
      exit();
  } 

  $conn = connect();
  $id = $_SESSION['id'];
  

function retrieveNotes($id) { 
  $conn = connect();
  $stmt = $conn->prepare("SELECT * from user_notes WHERE user_id = ?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $results = $stmt->get_result();

  $userDatabase = array(); 

  if ($results && $results->num_rows > 0) {
      while ($row = $results->fetch_assoc()) {
          $userDatabase[] = $row; 
      }
  }

  return $userDatabase; 
}
// updating title
if(isset($_POST['update_btn']))
{
    if (isset($_POST['edit_title'])) {
        $conn = connect();
        $new_title = $_POST['edit_title'];
        $note_id = $_POST['popupIdContent'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = $conn->prepare("UPDATE user_notes SET note_title = ? WHERE note_id = ?");
    $query->bind_param("si", $new_title, $note_id);

    if ($query->execute()) {
        $_SESSION['status'] = "Title updated successfully";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Couldn't change this title";
        $_SESSION['status_code'] = "error";
    }
    echo "co jest ?";
    }
    
    $query->close();
  
}
// del from database
if(isset($_POST['noteName']))
{
    $noteName = $_POST['noteName'];
    $sql ="DELETE FROM user_notes WHERE user_id = $id AND note_title = '$noteName' ";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = "Note deleted successfully";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Couldn't delete this note";
        $_SESSION['status_code'] = "error";
         $conn->error;
    }
        
}
$notes = retrieveNotes($id);
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width", initial-scale="1.0">
      <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;600;700&display=swap" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/mainup.css">
      <link rel="stylesheet" href="css/trips.css">
      <title>roadnote • trips</title>
    </head>
    
    <body>
        <div class="dashboard">

<?php 
    include_once 'sidebar.php';
?>
<?php 
    include_once 'mainup.php';
?>

            <section class="main">


            <div class="first-section">   
            <h1>Choose what you want to do:</h1>
            <a href="newnote.php">
                            <img src="svg/add.svg" class="add-icon" />
                            <h3>Add</h3>
                        </a>
            <a onclick="managePopup()">
                            <img src="svg/manage.svg" class="manage-icon" />
                            <h3>Manage</h3>
                        </a>
                </div> 

    <div class="second-section">
    <h1>Your trips:</h1>
    <?php
    // database notes
    foreach ($notes as $note) {
        echo '<a href="newnote.php?nid=' . $note['note_id'] . '">';
        echo '<img src="svg/file.svg" class="file-icon" />';
        echo '<h3>' . $note['note_title'] . '</h3>';
        echo '</a>';
    }
    ?>             
    </div>

            </section>

<!-- MANAGE POP UP  -->
<div class="manage_popup" id="manage_popup">
                    <div class="scroll-div">      
                            <div class="head_popup">
                                <h2>Manage trips:</h2>
                                <a onclick="closePopup()">
                                    <span class="material-symbols-sharp" id="edit_close">close</span>
                                </a>
                            </div>
                            <div class="scroll_notes">
                            <?php 
                                foreach ($notes as $note) {
                                    echo "<div class='note_popup'>";
                                    echo '<a onclick="delete_openPopup(\'' . $note['note_title'] . '\')"><span class="material-symbols-sharp">delete</span></a>';
                                    echo " ".'<a onclick="update_openPopup(\'' . $note['note_id'] . '\')">' . $note['note_title'] . '</a>';
                                    echo "</div>";
                                }
                            ?>       
                            </div>
                    </div>               
            </div>

<!-- DELETING NOTE POPUP  -->
<div class="deleteNote_popup" id="deleteNote_popup">
            <header>DELETE TRIP</header>
                <p>Are you sure you want to delete this note from your database?</br>
              <b><span id="popupContent"></span></b></p>
                <div class="note_buttons">
                        <button name='delete_form' id="note-yes-btn" type="button" onclick="deleteNote()">YES</button>
                        <a onclick="note_closePopup()">
                            <button id="canceling-btn">NO</button>
                        </a>
                </div>
</div>            

<!-- UPDATING TITLE POPUP  -->
<div class="updateName_popup" id="updateName_popup">
        <header>UPDATE TITLE</header>
        <form method="post" class="upload-form">
        <input type="hidden" name="popupIdContent" id="popupIdContent" value="">
            <p>Enter your new title:</p>
                <input  placeholder="title..." type="text" name="edit_title" />
                    <div class="upload_buttons">
                        <button name="updatebtn" type="submit" id="update_btn">UPDATE</button>
                </form>
                        <a onclick="title_closePopup()">
                        <button id="canceling_btn">CANCEL</button>
                        </a>
                    </div>  
        </div>

 <!-- changing data mess  -->
 <div class="status">
                        <?php 
                        if (isset($_SESSION['status']) && $_SESSION['status_code'] == "success"){
                            echo '<h2 class=bg-success> '.$_SESSION['status'].'</h2>';
                            unset($_SESSION['status']);
                         } 
                         if (isset($_SESSION['status']) && $_SESSION['status_code'] == "error")
                         {
                             echo '<h2 class=bg-error> '.$_SESSION['status'].'</h2>';
                             unset($_SESSION['status']);
                         }
                        ?>
                
<!-- adding trip mess  -->
   
                        <?php 
                         if (isset($_GET['success'])) {
                           
                            echo '<h2 class=bg-success> '.'New note was added to your trips!'.'</h2>';
                        }
                        if (isset($_GET['usuccess'])) {
                           
                            echo '<h2 class=bg-success> '.'Your note was updated successfully!'.'</h2>';
                        }
                        if (isset($_GET['error'])) {
                            
                            echo '<h2 class=bg-error> '.'Unknown error occurred!'.'</h2>';
                        }

                        ?>
                </div>
        
<div id="picBackDrop"></div>
  <script src="js/trips.js"> </script>
    </body>
    </html>