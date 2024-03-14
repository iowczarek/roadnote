<?php 
session_start();

include "../login/connect.php";
$conn = mysqli_connect("localhost", "root", "", "roadnote");

if(!isset($_SESSION['logged'])){
    header('Location:../login/login.php');
    exit();
} 
$id = $_SESSION['id'];

//del pic 
if(isset($_POST['delete_pic_btn']))
{
    $new_pp = 'default-pp.png';
    $query ="UPDATE users SET pp = ('$new_pp') WHERE id=$id ";
    mysqli_query($conn, $query);

    $_SESSION['pp'] = $new_pp;
    $_SESSION['status_photo'] = "Your picture is deleted";
    $_SESSION['status_code'] = "success";
    header("Location: ../settings.php?success");
    exit(0);
}
    else {
        header("Location: ../settings.php");
    }
    if (isset($_POST['del_canceling_btn'])) {
        header("Location: ../settings.php"); 
    }
    
//pic
if (isset($_POST['image-submit']) && isset($_FILES['image-input'])) {
   
    echo "<pre>";
    print_r($_FILES['image-input']);
    echo "</pre>";

    $img_name = $_FILES['image-input']['name'];
    $img_size = $_FILES['image-input']['size'];
    $tmp_name = $_FILES['image-input']['tmp_name'];
    $error = $_FILES['image-input']['error'];

    //too big
    if ($error === 0) {
        if ($img_size > 125000){
            $em = "Sorry, your file is too large!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_photo'] = "Sorry, your file is too large!";
            header("Location: ../settings.php?error=$em");
            exit(0);
        }else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if(in_array($img_ex_lc, $allowed_exs)) {

                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //Inserting into Database 
                $sql = "UPDATE users SET pp = ('$new_img_name') WHERE id = $id";
                mysqli_query($conn, $sql);
                
                $_SESSION['pp'] = $new_img_name;
                $_SESSION['status_photo'] = "Your picture is updated";
                $_SESSION['status_code'] = "success";

                header("Location: ../settings.php?success"); 
                exit();

            }else {
                $em = "You can't upload files of this type!";
                $_SESSION['status_photo'] = "You can't upload files of this type!";
                $_SESSION['status_code'] = "error";
                header("Location: ../settings.php?error=$em");
            }
        }
    }
    else {
        //pic not chosen
        $em = "Select new photo!";
        $_SESSION['status_photo'] = "Select new photo!";
        $_SESSION['status_code'] = "error";
        header("Location: ../settings.php?error=$em");
    }

} else {
    header("Location: ../settings.php");
    
}

if(isset($_POST['updatebtn']))
{
    
    $new_username = $_POST['edit_username'];
    if((strlen($new_username)<3) || (strlen($new_username)>15))
    {
        $_SESSION['status'] = "Your name was not changed. It must be 3 - 15 characters long!";
        $_SESSION['status_code'] = "error";
        exit(0);
    }
                                            
    if(ctype_alnum($new_username) == false) 
    {
        $_SESSION['status'] = "Your name was not changed. It can consist of letters only!";
        $_SESSION['status_code'] = "error";
        exit(0);
    }
    $query ="UPDATE users SET user = '$new_username' WHERE id=$id ";
    mysqli_query($conn, $query);
    $_SESSION['user'] = $new_username;

    $_SESSION['status'] = "Your username is updated";
    $_SESSION['status_code'] = "success";
        
    header("Location: ../settings.php?success");
    exit(0);
        
    }
    else {


    }


if(isset($_POST['update_email_btn']))
{
    $new_email = $_POST['edit_email'];

    
        $emailB = filter_var($new_email, FILTER_SANITIZE_EMAIL);

        if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $new_email))
        {
        $_SESSION['status'] = "Provide correct email!";
        $_SESSION['status_code'] = "error";
        exit(0);
        }

    $query ="UPDATE users SET email = '$new_email' WHERE id=$id ";
    
    mysqli_query($conn, $query);

    $_SESSION['email'] = $new_email;

    $_SESSION['status'] = "Your e-mail is updated";
    $_SESSION['status_code'] = "success";
        
    header("Location: ../settings.php?success");
    exit(0);
        
    }
    else {


    }
 
if(isset($_POST['update_pass_btn']))
{

$new_pass1 = $_POST['edit_password1'];
$new_pass2 = $_POST['edit_password2'];

if((strlen($new_pass1)<8) || (strlen($new_pass1)>20))
{
    $_SESSION['status'] = "Password must be 8 - 20 characters long!";
    $_SESSION['status_code'] = "error";
    exit(0);
}

if($new_pass1!=$new_pass2)
{
    $_SESSION['status'] = "Provided passwords are not equal";
    $_SESSION['status_code'] = "error";
    exit(0);
}


//hash
$new_pass_hash = password_hash($new_pass1, PASSWORD_DEFAULT);

    $query ="UPDATE users SET pass = '$new_pass_hash' WHERE id=$id ";
    mysqli_query($conn, $query);
    $_SESSION['pass'] = $new_pass_hash;

    $_SESSION['status'] = "Your password is updated";
    $_SESSION['status_code'] = "success";
        
    header("Location: ../settings.php?success");
    exit(0);
        
    }
    else {

    }
