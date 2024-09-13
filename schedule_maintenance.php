<?php
$host = '127.0.0.1';  // O usa 'localhost'
$db = 'inteinsa';
$user = 'inteinsa_user';  // Usuario que creaste
$pass = '50p0rt3DB';     // Contraseña que asignaste

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

$employeeName = $_POST['employeeName'];
$department = $_POST['department'];
$computer = $_POST['computer'];
$date = $_POST['date'];
$time = $_POST['time'];

$sql = "INSERT INTO maintenance_schedule (employee_name, department, computer_id, maintenance_date, maintenance_time) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssiss', $employeeName, $department, $computer, $date, $time);

if ($stmt->execute()) {
    echo 'Mantenimiento programado con éxito.';
} else {
    echo 'Error al programar mantenimiento: ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>
