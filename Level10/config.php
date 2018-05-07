<?php
session_start();
$DB_host = "192.168.1.120";
$DB_user = "root";
$DB_pass = "la88(0mb1tech";
$DB_name = "level10";

$DB_con = mysqli_connect($DB_host, $DB_user, $DB_pass, $DB_name);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
