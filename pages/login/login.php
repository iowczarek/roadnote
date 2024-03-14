<?php
    session_start();

    if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true)) 
    {
        header('Location: ../dashboard.php');
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>roadnote • login</title>
        <link rel="stylesheet" href="../css/lstyle.css">
        <link rel="stylesheet" href="../css/login.css">
    </head>

<body>
    <div class="left">
        <a href="../../index.php"><img src="../images/logocale.png" class="logo" alt="logo" ></a>
        <img src="../images/lp3.png" class="lp3" alt="pic with glob" >
    </div>
    <div class="right">
        <h1>Sign in</h1>
            <br/> <br> 
            <div class="logging">
            <h2>Don't have an account? <a href="../reg/reg.php">Sign up</a></h2> <br/>
            <form action="iflog.php" method="post">
            E-mail: <br/> <input class="email" placeholder="example@gmail.com" type="text" name="login" /> <br/>
            Password: <br/> <input class="passy" placeholder="*********" type="password" name="pass" /> <br/> 
            <?php
                if (isset($_SESSION['logerror'])) echo $_SESSION['logerror'];
            ?><br/>
        <input class="login-submit" type="submit" value="SIGN IN"/>
    </form>
    </div>
    </div>

</body>
</html>