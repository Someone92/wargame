<?php

if(isset($_POST['register'])) {
    setcookie('username', $_POST['name']);
    setcookie('password', $_POST['password']);
    $response = 'Created successfully!';
}

if(isset($_POST['login'])) {
    if(isset($_COOKIE['username']) and $_POST['name'] === $_COOKIE['username']) {
        if(isset($_COOKIE['password']) and $_POST['password'] === $_COOKIE['password']) {
            setcookie("uid", "2");
            header("Refresh:0");
        } else {
            $response = 'Incorrect username/password';
        }
    } else {
        $response = 'Incorrect username/password';
    }
}

if(isset($_POST['logout'])) {
    setcookie('username', '', time() - 3600);
    setcookie('password', '', time() - 3600);
    setcookie('uid', '', time() - 3600);
    header("Refresh:0");
}
$users = array('user' => 'level6', 'pass' => 'YmxhY2sgc2hlZXAgd2FsbA==');

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

        <title>Level 6</title>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        if(isset($_COOKIE['uid'])) {
            ?>
        
            <div class='cookies'>
            This website uses cookies to store information
            <button onClick="this.parentNode.style.display = 'none'">Accept</button>
            </div>
                
        <?php
        }
        
        
        ?>
        <header>
            <img src="logo-white.png">
        </header>
        <div class="container">
            <?php if(!isset($_COOKIE['uid'])) { ?>
            <h1>Welcome to level 6</h1>
            <p>Feel free to create a user and login!</p>
            <form method="post">
                <input type="name" placeholder="Name" name="name">
                <input type="password" placeholder="Password" name="password">
                <button class="register" type="submit" name="register">Register</button>
                <button type="submit" name="login">Login</button>
            </form>
            <?php if(isset($response)) { echo $response; } ?>
            <?php } else if(isset($_COOKIE['uid'])) { ?>
                
                <h2>This is a super secret panel that requires auth</h2>
                <?php if($_COOKIE['uid'] === '1') { ?>
                    <p>Welcome back Admin</p>
                    <table>
                        <thead>
                            <td>Name</td>
                            <td>Password</td>
                        </thead>
                        <tbody>
                            <tr>
                                <td>level7</td>
                                <td>V2FycFRlbg==</td>
                            </tr>
                            <tr>
                                <td>jacob</td>
                                <td>lh14h14h1</td>
                            </tr>
                            <tr>
                                <td>crazy</td>
                                <td>h53jk2</td>
                            </tr>
                            <tr>
                                <td><?php echo $_COOKIE['username']; ?></td>
                                <td><?php echo $_COOKIE['password']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <form method="post">
                        <button type='submit' name='logout'>Logout</button>
                    </form>
                    <?php
                } else {
                    echo "<p>Welcome back ".$_COOKIE['username']."</p>";
                    echo "<br>Currently building control panel!";
                    ?>
                    <form method="post">
                        <button type='submit' name='logout'>Logout</button>
                    </form>
                    
                    <?php
                }
            } ?> 
        </div>
        </body>
</html>
<?php
} else {
    header('WWW-Authenticate: Basic realm="Unauthorized"');
    header('HTTP/1.0 401 Unauthorized');
    echo "incorrect user/pass";
    exit;
}?>