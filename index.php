<?php

require_once("Includes/db.php");
$logonSuccess = false;


// verify user's credentials
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $logonSuccess = (WishDB::getInstance()->verify_wisher_credentials($_POST['username'], $_POST['password']));
    if ($logonSuccess == true) {
        session_start();
        $_SESSION['username'] = $_POST['username'];
        header('Location: dashboard.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <Title> BBPT | Content Management System (CMS) </title>
     <link href="styles/index.css" type="text/css" rel="stylesheet" media="all" />
</head>
<!--<a href="Includes/db.php"></a>-->
<body>  
       <div class="login-page">
            <div class="form">
            
              <form class="login-form" name="logon" action="index.php" method="POST" >
                    <input type="text" placeholder="username" name="username" id="username"/>
                    <input type="password" placeholder="password" name="password" id="password"/>
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                            if (!$logonSuccess)
                                echo "Invalid name and/or password";
                        }
                      ?>
                    <button>login</button>
                  
              </form>
            </div>
        </div>
</body>
</html>