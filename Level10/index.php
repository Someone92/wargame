<?php
require_once 'config.php';
if(isset($_POST['login'])) { 
    $uname = $_POST['name'];
    $upass = $_POST['password'];

    $uname = preg_replace("/[^a-zA-Z0-9%]/", "", $uname);
    $upass = preg_replace("/[^a-zA-Z0-9%]/", "", $upass);

    $uname = urldecode($uname);
    $upass = urldecode($upass);

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

$users = array('user' => 'level10', 'pass' => 'd2hhdHMgbWluZSBpcyBtaW5l');

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Private Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Text to send if user hits Cancel button';
    exit;
} else if($_SERVER['PHP_AUTH_USER'] === $users['user'] and $_SERVER['PHP_AUTH_PW'] === $users['pass']) {  ?>
<!doctype HTML>
<html>
    <head>
        <title>Level 10</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="logo-white.png">
        </header>
        <div class="container">
            <?php if(!isset($auth)) { ?>
            <h1>Welcome to level 10</h1>
            <p>Login to finish the wargame!</p>
            <form method="post">
                <input type="name" placeholder="Name" name="name">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" name="login">Login</button>
            </form>
            <?php } else if(isset($auth)) { ?>
                <h2>This is the super secret panel only accessable through the use of SQL Injecion</h2>
                <p>
                    <b>You have finished the wargame, good job!</b>
                </p>
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
