<?php
$users = array('user' => 'level1', 'pass' => 'level1');

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

        <title>Level 1</title>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="logo-white.png">
        </header>

        <div class="container">
            <h1>Welcome to level 1</h1>
            <p>Password for the next level exists on this page somewhere</p>
        </div>

       <br>
       <p>
           <b>Pass:</b> b3BlcmF0aW9uIGN3YWw=
       </p>
    </body>
</html>
<?php
} else {
    echo "incorrect user/pass";
    header('WWW-Authenticate: Basic realm="Unauthorized"');
    header('HTTP/1.0 401 Unauthorized');
}
?>
