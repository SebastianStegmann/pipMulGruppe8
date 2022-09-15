<?php

// tilpas selv til egen sti/path
require ".env.php";

// så behøver man ikke skrive dette flere gange
$servername = "localhost:3306";
$db_username = "root";
$db_password = getenv("PASSWORD");
$db_name = "pip_db";
?>