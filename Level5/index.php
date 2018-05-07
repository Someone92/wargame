<?php
ini_set('display_errors', 'Off');

if(isset($_GET['page'])) {
    if($file = file_get_contents($_GET['page'].'.php')) {
    } else {
        $file = "No such file exists";
    }

}

$users = array('user' => 'level5', 'pass' => 'Z2FtZSBvdmVyIG1hbg==');

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

        <title>Level 5</title>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="logo-white.png">
        </header>
        <div class="container">
            <h1>Welcome to level 5</h1>
            <p>Load a file!</p>
            
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?page=about">About</a></li>
            </ul>
            
            <div class="content">
                <?php if(isset($file)) {
                    echo $file;
                } else {
                    echo "Welcome to the home screen!";
                } ?>
            </div>
        </div>
        
        <!-- Password for level 6 exists in file: secret-file -->
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
