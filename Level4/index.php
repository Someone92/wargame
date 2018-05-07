<?php
if(isset($_POST['combination'])) {
    $combination = $_POST['combination'];

    if($combination === 'Y29tYml0ZWNoIGlzIGNvb2w=') {
        $combination = '
            <br><b>pass:</b> Z2FtZSBvdmVyIG1hbg==
        ';
    } else {
        $combination = 'Try again!';
    }
}

$users = array('user' => 'level4', 'pass' => 'cG93ZXIgb3ZlcndoZWxtaW5n');

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

        <title>Level 4</title>

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="logo-white.png">
        </header>

        <div class="container">
            <h1>Welcome to level 4</h1>
            <p>Enter the correct combination!</p>
            <br>
            <form action="" method="post">
                <input type="text" name="combination" placeholder="Try a combination">
                <button type="submit">Try combination</button>
            </form>
            <p><?php if(isset($combination)) { echo $combination; } ?></p>
        </div>
        
        <script>
            localStorage.clear();
            var _0x1891=["\x63\x6F\x6D\x62\x69\x6E\x61\x74\x69\x6F\x6E","\x59\x32\x39\x74\x59\x6D\x6C\x30\x5A\x57\x4E\x6F\x49\x47\x6C\x7A\x49\x47\x4E\x76\x62\x32\x77\x3D","\x73\x65\x74\x49\x74\x65\x6D"];localStorage[_0x1891[2]](_0x1891[0],_0x1891[1])
        </script>
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
