<?php
$host = '127.0.0.1';  // O usa 'localhost'
$db = 'inteinsa';
$user = 'inteinsa_user';  // Usuario que creaste
$pass = '50p0rt3DB';     // Contraseña que asignaste

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

$id = $_POST['id'];
$employeeName = $_POST['employeeName'];
$department = $_POST['department'];
$date = $_POST['date'];
$time = $_POST['time'];

$sql = "UPDATE maintenance_schedule SET employee_name = ?, department = ?, maintenance_date = ?, maintenance_time = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssisi', $employeeName, $department, $date, $time, $id);

if ($stmt->execute()) {
    echo 'Programación actualizada con éxito.';
} else {
    echo 'Error al actualizar programación: ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>
