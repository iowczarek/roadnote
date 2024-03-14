<?php
include ('settings.php');
$conn = mysqli_connect("localhost", "root", "", "roadnote");

if(isset($_POST['updatebtn']))
{
    $id = $_SESSION['id'];
    $username = $_POST['edit_username'];

    $query ="UPDATE users SET user='$username' WHERE id='$id' ";
    
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your data is updated";
        $_SESSION['status_code'] = "success";
         $_SESSION['user'] = $username;
         header("Location: settings.php?success");
       
        exit(0);
        
    }
    else {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        exit(0);
    }
    

}


