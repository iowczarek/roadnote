<?php 
    session_start();

    if(isset($_POST['email'])) 
    {
        
        $all_OK = true; 
        $nick = $_POST['nick'];
                                                       
        if((strlen($nick)<3) || (strlen($nick)>15))
        {
            $all_OK = false;
            $_SESSION['e_nick'] = "Name must be 3 - 15 characters long";
        }
                                    
        if(ctype_alnum($nick) == false) 
        {
            $all_OK = false;
            $_SESSION['e_nick']="Name can consist of letters only";
        }
      
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email))
        {
            $all_OK = false;
            $_SESSION['e_email'] = "Provided e-mail is incorrect";
        }
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        if((strlen($pass1)<8) || (strlen($pass1)>20))
        {
            $all_OK = false;
            $_SESSION['e_pass'] = "Password must be 8 - 20 characters long";
        }
        if($pass1!=$pass2)
        {
            $all_OK = false;
            $_SESSION['e_pass'] = "Provided passwords are not equal";
        }
        $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
        if (!isset($_POST['terms']))
        {
            $all_OK = false;
            $_SESSION['e_terms'] = "You need to accept the terms of use";
        }

        $secret = "6LfgqZ8lAAAAANxPaHzt-EM4UBSF110S7gX4bO46";
        $checking = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $response = json_decode($checking);
        
        if($response->success==false)
        {
            $all_OK = false;
            $_SESSION['e_bot'] = "Confirm you are not a robot";
        }
        require_once "../login/connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
            $conn = new mysqli("localhost", "root", "", "roadnote");
            
                if ($conn->connect_errno!=0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else 
                {
                  
                    $result = $conn->query("SELECT id FROM users WHERE email='$email'");
                    if(!$result) throw new Exception($conn->error);

                    $num_mails = $result->num_rows;
                    if($num_mails>0)
                    {
                        $all_OK = false;
                        $_SESSION['e_email'] = "Provided e-mail is already used";
                    }
                if($all_OK == true)
                {
                    if($conn-> query("INSERT INTO users VALUES (NULL,'$nick','$pass_hash','$email', 'default-pp.png')"))
                    {
                        $_SESSION['succregister']=true;
                        header('Location:welcome.php');
                    }
                    else 
                    {
                       throw new Exception($conn->error); 
                    }
                }
                    $conn->close();
                }
        }
        catch (Exception $e)
        {
            echo '<span style="color: red;">Server error</span>';
            echo '<br/>info:'.$e;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>roadnote • register</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="stylesheet" href="../css/lstyle.css">
        <link rel="stylesheet" href="../css/reg.css">
    </head>

<body>
<div class="main">
    <div class="left">
        <a href="../../index.php"><img src="../images/logocale.png" class="logo" alt="logo" ></a>
        <img src="../images/lp4.png" class="lp4" alt="pic with glob" >
    </div>

    <div class="right">
        <h1>Sign up</h1>
            <div class="register">
            <form method="post">
                Name: <br/>    
                    <input class="nick" placeholder="yourname" type="text" name="nick" /> <br/>
                        <?php 
                            if (isset($_SESSION['e_nick']))
                            {
                                echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                                unset($_SESSION['e_nick']);
                            }
                        ?>

                E-mail: <br/> 
                    <input class="email" placeholder="example@gmail.com" type="text" name="email" /> <br/>
                        <?php 
                            if (isset($_SESSION['e_email']))
                            {
                                echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                                unset($_SESSION['e_email']);
                            }
                        ?>

                Password: <br/> 
                    <input class="passy" placeholder="*********" type="password" name="pass1" /> <br/> 
                        <?php 
                            if (isset($_SESSION['e_pass']))
                            {
                                echo '<div class="error">'.$_SESSION['e_pass'].'</div>';
                                unset($_SESSION['e_pass']);
                            }
                        ?>
                Confirm password: <br/> 
                    <input class="passy" placeholder="*********" type="password" name="pass2" /> 
                    <label class="terms"><input type="checkbox" name="terms"/> I agree to the
                        <a href="../terms.php">terms of use</a></label>
                        <?php 
                            if (isset($_SESSION['e_terms']))
                            {
                                echo '<div class="error">'.$_SESSION['e_terms'].'</div>';
                                unset($_SESSION['e_terms']);
                                
                            }
                        ?>
        <div class="g-recaptcha" data-sitekey="6LfgqZ8lAAAAAGlVx1vlLv83BokdVs9-T7Ihy8z2 "></div>   
                        <?php 
                            if (isset($_SESSION['e_bot']))
                            {
                                echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                                unset($_SESSION['e_bot']);
                                
                            }
                        ?>
                <div class="reg-buttons"><input class="login-submit" type="submit" value="SIGN UP"/>
                <h2>Have an account?<p><a href="../login/login.php">Sign in</a></h2> <br/></div>
            </form>
            </div>
    </div>

    </div>

</body>
</html>