<?php

$host = "localhost"; /* this will always be localhost */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "sadness_guestbook"; /* Database name */

$con = mysqli_connect($host, $user, $password, $dbname);

// this checks the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}