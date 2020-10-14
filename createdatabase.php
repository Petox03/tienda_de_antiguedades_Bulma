<?php


$host='localhost';
$user = 'root';
$pass = '';
// Create connection
$conexion = new mysqli($host, $user, $pass);
// Check connection
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

// Create database
$sql = "CREATE DATABASE system";
if ($conexion->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conexion->error;
}
echo"<br><br>";

$conexion->close();
?>