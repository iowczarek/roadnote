<?php
session_start();
session_unset();
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>roadnote • logout</title>
        <script src="https://kit.fontawesome.com/381a9823e2.js" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="../css/lstyle.css">
        <link rel="stylesheet" href="../css/lout.css">
    </head>

<body>
        <section class="header">
            <nav>
                <a href="../../index.php"><img src="../images/logocale.png" alt="logo"></a>
    
             <div class="header_links">
               
                <ul>
                    <li><a href="../../index.php">Home</a></li>
                    <li><a href="../about.php">About</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="../faq.php">FAQ</a></li>
                </ul>
            </div>
            
            </nav>
        </section>


    <div class="left">
        
                <div class="textbox1">
                <h1>You are <br/>logged out</h1><br/>
                <p>You are logged out. To see your account please log in. <br>Don't have an account? Sign up to create one.</p><br/><br/>
                <button class="reg-btn" onclick="window.location='login.php';">LOG IN</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="login-btn" onclick="window.location='../reg/reg.php';">SING UP</button>
            <br/></div>
                
                <br/><br/><br/><br/><br/><br/><br/><br/>
                <a href="https://www.facebook.com/owczarekiza/"><i class="fa-brands fa-facebook-f" style="color: #2c2c2c;"></i></a>
                &nbsp;
                <a href="https://www.instagram.com/izaowczarek/"><i class="fa-brands fa-instagram" style="color: #2c2c2c;"></i></a>
                &nbsp;
                <a href="https://www.linkedin.com/in/izabela-owczarek-853957225/"><i class="fa-brands fa-linkedin-in" style="color: #2c2c2c;"></i></a>
        
    </div>

    <div class="right">
    <img src="../images/w2.png" class="w2" alt="obrazek z walizka" >
    </div>
    </div>
    

</body>
</html>