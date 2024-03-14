<?php

session_start();

    if((!isset($_POST['login'])) || (!isset($_POST['pass']))){ 
        header('Location: login.php');
        exit();
    }

require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try
{
    $conn = connect(); 
    if ($conn->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    if($result = $conn->query(
        sprintf("SELECT * FROM users WHERE email='%s'",
        mysqli_real_escape_string($conn, $login))))
        {
        $num_users = $result->num_rows;
        
        if($num_users>0){
            $row = $result->fetch_assoc(); 
            if(password_verify($pass, $row['pass']))
            {
                
                $_SESSION['logged'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['user'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pp'] = $row['pp'];

                unset($_SESSION['logerror']);
                $result->free_result();

                header('Location: ../dashboard.php'); 
        }
        else {
            $_SESSION['logerror'] ='<span style="color:red; font-size:12px">Incorrect password</span>';
            header('Location: login.php');
        }
            
        }else {
            $_SESSION['logerror'] ='<span style="color:red; font-size:12px">No user with this e-mail</span>';
            header('Location: login.php');
        }
}
else 
{
    throw new Exception($conn->error);
}
    $conn->close();
}
}
catch (Exception $e)
{
    echo '<span style="color:red;">Server error';
    echo '<br />info: '.$e;
}
?>