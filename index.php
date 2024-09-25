<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'practico3'; // Base de datos

// Conexión usando MySQLi
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Operaciones CRUD

// INSERT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'insert') {
    
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $nacimiento = $_POST['nacimiento'];
    
    $sql = "INSERT INTO persona (dni, nombre, nacimiento) VALUES ('$dni', '$nombre', '$nacimiento')";
    $conn->query($sql);
}

// UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $nacimiento = $_POST['nacimiento'];
    
    $sql = "UPDATE persona SET dni='$dni', nombre='$nombre', nacimiento='$nacimiento' WHERE id=$id";
    $conn->query($sql);
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM persona WHERE id=$id";
    $conn->query($sql);
}

// SELECT
$sql = "SELECT * FROM persona";
$result = $conn->query($sql);

$personas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $personas[] = $row;
    }
}

// Devolver en formato JSON
header('Content-Type: application/json');
echo json_encode($personas);

$conn->close();
?>