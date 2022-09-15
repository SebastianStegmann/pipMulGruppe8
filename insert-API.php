<?php
// header("Access-Control-Allow-Origin: *");

// header("Content-Type: application/json; charset=UTF-8");

// header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

// header("Access-Control-Max-Age: 3600");

// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Læs textfelt 
require 'connect.php';

$username;
$message;

// får hvad de skrev i pip modal'en
$username = $_POST['username'];
$message = $_POST['message'];



// Send til database
try {
  $conn = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// send kun tweet hvis begge felter er fyldt, hvis ikke fyldt, send alert
  if (!empty($_POST['username'] && $_POST['message'])) {

// inserter det vi fik fra pip modal'en
    $sql = "INSERT INTO pips (name, content)
  VALUES('$username', '$message')";
    
    $conn->exec($sql);
  } else {
    // virker ikke, 
    echo "<script>alert('test!'); location.href='index.php';</script>";
  

  }
 

  echo "New tweet added succesfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


header("Location: index.php");


?>