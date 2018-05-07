<?php
$users = array('user' => 'level3', 'pass' => 'dGhlcmUgaXMgbm8gY293IGxldmVs');

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Private Realm"');
    header('HTTP/1.0 401 Unauthorized');
    header('Refresh:0');
    echo 'If you dont know the username/password you cant continue with the level!';
    exit;
} else if($_SERVER['PHP_AUTH_USER'] === $users['user'] and $_SERVER['PHP_AUTH_PW'] === $users['pass']) {  ?>
<!doctype HTML>
<html>
    <head>

        <title>Level 3</title>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="files/logo-white.png">
        </header>

        <div class="container">
            <h1>Welcome to level 3</h1>
            <p>There is nothing on this page!</p>
        </div>
        <!-- 
            Haa, it wont be that easy this time!
        -->    
    </body>
</html>
<?php
} else {
    header('WWW-Authenticate: Basic realm="Unauthorized"');
    header('HTTP/1.0 401 Unauthorized');
    echo "incorrect user/pass";
    exit;
}
?>
