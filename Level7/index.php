<?php
require_once 'config.php';

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    if(mysqli_multi_query($DB_con, "SELECT * FROM books WHERE book LIKE '$search'")) {
        $result = mysqli_store_result($DB_con);
        mysqli_next_result($DB_con);
        mysqli_free_result($result);
        $sql = "SELECT * FROM books";
        $result = $DB_con->query($sql);

        if (!$result) {
            echo "<h2>Database table doesn't exist!!</h2>";
            echo "<p>";
            echo "<b>Pass:</b> R3JlZWRJc0dvb2Q=";
            echo "</p>";
            
            mysqli_next_result($DB_con);
            $re = file_get_contents("books.sql");
            if(mysqli_multi_query($DB_con, $re)) {
                //DB added!
            }
        }
    }
}

$users = array('user' => 'level7', 'pass' => 'V2FycFRlbg==');

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
        <title>Level 7</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <img src="logo-white.png">
        </header>
        <div class="container">
            <h1>Welcome to level 7</h1>
            <p>Drop the database table named <i>books</i>!</p>
            <p id="demo"></p>
            <br>
            
            <form method="post">
                <input type="search" placeholder="Search" name="search">
                <button type="submit">Search</button>
            </form>
            <?php
                if(isset($_POST['search'])) {
                    echo "<p>".$_POST['search']." could not be found!</p>";
                }
    
            ?>
            
            
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