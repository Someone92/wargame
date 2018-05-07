<?php
require_once 'config.php';

if(isset($_POST['login'])) { 
    $uname = $_POST['name'];
    $upass = $_POST['password'];

    $query = "SELECT * FROM users WHERE name='$uname' AND pass='$upass'";

    $result = mysqli_query($DB_con, $query);
    
    if(!$result) {
        $response = "Error:\n". mysqli_error($DB_con);
    } else {
        $rows = mysqli_fetch_array($result);
        if($rows) {
            $_SESSION['mysessid'] = $uname;
            $auth = true;
        } else {
            $response = "Wrong username/password";   
        }
    }
}

if(isset($_POST['logout'])) {
    unset($_SESSION['mysessid']);
}

$users = array('user' => 'level9', 'pass' => 'SXNlZURlYWRQZW9wbGU=');

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

        <title>Level 9</title>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="logo-white.png">
        </header>
        <div class="container">
            <?php if(!isset($auth)) { ?>
            <h1>Welcome to level 9</h1>
            <p>Just login!</p>
            <form method="post">
                <input type="name" placeholder="Name" name="name">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" name="login">Login</button>
            </form>
            <?php } else if(isset($auth)) { ?>
                <h2>This is the super secret panel only accessable through the use of SQL Injecion</h2>
                <p>
                    <b>Pass:</b> d2hhdHMgbWluZSBpcyBtaW5l 
                </p>
                <form method="post">
                    <button type="submit" name="logout">Logout</button>
                </form>

            <?php } ?>
            <?php if(isset($response)) { echo $response; } ?> 
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
