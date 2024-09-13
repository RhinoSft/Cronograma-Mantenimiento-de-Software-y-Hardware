<?php
$host = '127.0.0.1';  // O usa 'localhost'
$db = 'inteinsa';
$user = 'inteinsa_user';  // Usuario que creaste
$pass = '50p0rt3DB';     // Contraseña que asignaste

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$scheduleId = $_POST['scheduleId'];
$employeeName = $_POST['employeeName'];
$department = $_POST['department'];
$date = $_POST['date'];
$time = $_POST['time'];

// SQL para actualizar un registro
$sql = "UPDATE maintenance_schedule 
        SET employee_name = '$employeeName', department = '$department', maintenance_date = '$date', maintenance_time = '$time'
        WHERE id = $scheduleId";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
