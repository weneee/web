<?php
$host = "sql100.infinityfree.com";
$username = "if0_40269450";
$password = "newjeans2024";
$database = "if0_40269450_winbeaut_db";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Error al conectar: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa a la base de datos.";
}
?>

