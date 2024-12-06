<?php
$host = "localhost"; // Servidor
$user = "root";      // Usuario de MySQL
$pass = "";          // Contraseña (por defecto vacía en XAMPP)
$dbname = "multiplicador"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
