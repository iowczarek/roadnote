<?php
require_once "login/connect.php";

    
session_start();

    if(!isset($_SESSION['logged'])){
        header('Location:login/login.php');
        exit();
    } 

$username = $_SESSION['user'];
$profile_pic = $_SESSION['pp'];
$id = $_SESSION['id'];

$info = retrieveProfileInfo($id);

function retrieveProfileInfo($id) { 
    $conn = connect();
    $stmt = $conn->prepare("SELECT * from users WHERE id = (?)");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
function changePicture($picture, $id) {
    $conn = connect();
    $stmt = $conn->prepare("UPDATE users SET pp = ('.image-input') WHERE id = (?)");
    $stmt->bind_param('si', $picture, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    retrieveProfileInfo($id);
}
function delPicture($id){
    $conn = connect();
    $stmt = $conn->prepare("UPDATE users SET pp = 'images/default-pp.png' WHERE id = (?)");
    $stmt->bind_param('si', $picture, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    retrieveProfileInfo($id);
}
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
      <link rel="stylesheet" href="css/settings.css">
      <title>roadnote • settings</title>
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
                <div class="left">
                    <input type="hidden" name="edit_id" value=<?=$id?> />
                    <div class="sett_name">
                        <h2>Name:</h2>
                        
                        <label>
                            <input type="text" name="username" class="user-data" value=<?php echo $username; ?>>
                            <a  onclick="name_openPopup()">
                        <span class="material-symbols-sharp" id="edit">stylus</span>
                        </a>
                        </label>  
                    </div>
                    <div class="sett_email">
                        <h2>E-mail:</h2>
                    
                        <label>
                            <input type="email" name="email" class="user-data" value=<?php echo $info['email']; ?>>
                            <a onclick="email_openPopup()">
                                <span class="material-symbols-sharp" id="edit">stylus</span>
                            </a>
                        </label>
                    </div>
                    <div class="sett_pass">
                        <h2>Password:</h2>
                            <input class="user-data" placeholder="********">
                            <a onclick="pass_openPopup()">
                        <span class="material-symbols-sharp" id="edit">stylus</span>
                        </a>

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
                    </div>
                    <div id="del_acc">

                    <a onclick="acc_openPopup()">
                    <button type="submit name="delete_btn"">Delete Account</button>
                    </a>
                        
                    </div>

                </div>

                <div class="right">
                    <h2>Profile picture:</h2>
                        <img src="includes/uploads/<?=$profile_pic?>" id="profile_pic">  
                </br>

                    <div class="pic_buttons">
                    <a onclick="pic_openPopup()">
                        <button id="change_pic_btn">CHANGE</button>
                    </a>

                    <a onclick="del_openPopup()">
                    <button id="delete_pic_btn">DELETE</button></div>
                    </a>
                    
<!-- changing photo mess -->
                    <div class="status_photo">

                    <?php 
                        if (isset($_SESSION['status_photo']) && $_SESSION['status_code'] == "success"){
                            echo '<h2 class=bg-success> '.$_SESSION['status_photo'].'</h2>';
                            unset($_SESSION['status_photo']);
                         } 
                         if (isset($_SESSION['status_photo']) && $_SESSION['status_code'] == "error")
                         {
                             echo '<h2 class=bg-error> '.$_SESSION['status_photo'].'</h2>';
                             unset($_SESSION['status_photo']);
                         }

                        ?>
                    </div></div>
                </div>
            </section>
            
        </div>

 <!-- UPDATING NAME POPUP  -->
    <div class="updateName" id="updatename_popup">
        <header>UPDATE NAME</header>
            <p>Enter your new name:</p>
                <form action="includes/upload.php" method="post" class="upload-form">
                <input class="nick" placeholder="name..." type="text" name="edit_username" />
                    <div class="upload_buttons">
                        <button name="updatebtn" type="submit" id="change_pic_btn">UPDATE</button>
                </form>
                        <a onclick="name_closePopup()">
                        <button id="canceling_btn">CANCEL</button>
                        </a>
                    </div>  
        </div>

 <!-- UPDATING EMAIL POPUP  -->
    <div class="updateName" id="updateemail_popup">
        <header>UPDATE EMAIL</header>
            <p>Enter your new e-mail:</p>
                <form action="includes/upload.php" method="post" class="upload-form">
                    <input class="email" placeholder="new email..." type="text" name="edit_email" />
                <div class="upload_buttons">
                    <button name="update_email_btn" type="submit" id="change_pic_btn">UPDATE</button>
                </form>
                    <a onclick="email_closePopup()">
                    <button id="canceling_btn">CANCEL</button>
                    </a>
                </div>
    </div>

<!-- UPDATING PASSWORD POPUP  -->
    <div class="updateName" id="updatepass_popup">
        <header>UPDATE PASSWORD</header>
            <p>Enter your new password:</p>
                <form action="includes/upload.php" method="post" class="upload-form">
                    <input class="password" placeholder="new password..." type="password" name="edit_password1" />
                    <input class="password" placeholder="confirm password..." type="password" name="edit_password2" />
                    <div class="upload_buttons">
                        <button name="update_pass_btn" type="submit" id="change_pic_btn">UPDATE</button>
                </form>
                        <a onclick="pass_closePopup()">
                        <button id="canceling_btn">CANCEL</button>
                        </a>
                    </div>
    </div>

<!-- DELETING ACC POPUP  -->
        <div class="deleteAccount" id="deleteacc_popup">
            <header>DELETE ACCOUNT</header>
                <p>Are you sure you want to delete your account? This will permanently erase your data.</p>
            <div class="upload_buttons">
                <form action="includes/deleted.php" method="post">
                    <input type="hidden" name="delete_id" value="<?= $id ?>">
                    <button id="yes-btn">YES</button>
                </form>
                    <a onclick="acc_closePopup()">
                    <button id="cancel-btn">NO</button>
                    </a>
            </div>
        </div>

<!-- UPLOADING PHOTO POPUP  -->
        <div class="updatePhoto" id="upload_popup">
            <header>UPLOAD PROFILE PICTURE</header>
                <p>Browse file to upload:</p>
                    <form action="includes/upload.php" method="post" class="upload-form" enctype="multipart/form-data">
                        <input type="file" name="image-input" >
                        <div class="upload_buttons">
                        <button type="submit" name="image-submit" id="change_pic_btn">ACCEPT</button>
                    </form>  
                        <a onclick="pic_closePopup()">
                        <button id="canceling_btn">CANCEL</button>
                        </a>
                    </div>
        </div>


<!-- DELETING PHOTO POPUP  -->
         <div class="deletePhoto" id="delete_popup">
            <header>DELETE PROFILE PICTURE</header>
                <p>Are you sure you want to delete your profile picture?</p>
            <div class="upload_buttons">
                <form action="includes/upload.php" method="post" class="upload-form">
                    <button name="delete_pic_btn" id="photo-yes-btn">YES</button>
                    <a onclick="del_closePopup()">
                    <button id="del_canceling_btn">NO</button>
                    </a></form>
            </div>
        </div>

<div id="picBackDrop"></div>
<script src="js/settings.js"></script>

</body>

</html>

   