<?php
header("X-XSS-Protection: 0");
$level = $_GET['level'];
if(!isset($_GET['level'])) {
    header("Location: ?level=8");
} else {

    if(preg_match('(<script\b[^>]*>([\s\S]*?)<\/script>)', $level)) {
        if(preg_match('(alert\(\'([\s\S]*?)\'\))', $level)) {
            $success = true;
        } else if(preg_match('(alert\(\"([\s\S]*?)\"\))', $level)) {
            $success = true;
        }
    }
}

$users = array('user' => 'level8', 'pass' => 'R3JlZWRJc0dvb2Q=');

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

        <title>Level 8</title>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="logo-white.png">
        </header>

        <div class="container">
            <h1>Welcome to level <?php echo $level ?></h1>
            <p>Find a way to inject an alert!</p>
            
            <?php if(isset($success)) { ?>
                <br>
                <h2>Good job you did it!</h2>
                <p>
                    <b>Pass:</b> SXNlZURlYWRQZW9wbGU=
                </p>
            <?php } ?>
        </div>

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
