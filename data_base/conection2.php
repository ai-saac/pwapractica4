<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sistema_ventas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión a fallado: " . $conn->connect_error);
}
?>
