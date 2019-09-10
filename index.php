<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
<title>Social Login</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-box">
    <h2>Social Login Buttons</h2>
    <a href="facebook/" class="social-button" id="facebook-connect"> <span>Entrar con Facebook</span></a>
    <a href="google/" class="social-button" id="google-connect"> <span>Entrar con Google</span></a>
    <a href="twitter/" class="social-button" id="twitter-connect"> <span>Entrar con Twitter</span></a>
    <a href="logout.php">SALIR</a>
</div>
<div></div>
<div>
    <?php
    if(!empty($_SESSION['userData']))
    {            
        echo '<pre>$_SESSION[userData]: ';
            print_r($_SESSION['userData']);
        echo '</pre>';
    }
    if(!empty($_SESSION))
    {            
        echo '<pre>$_SESSION: ';
            print_r($_SESSION);
        echo '</pre>';
    }
    ?>
</div>
</body>
</html>