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
$employeeName = $_POST['employeeName'];
$department = $_POST['department'];
$computer = $_POST['computer'];
$date = $_POST['date'];
$time = $_POST['time'];

// SQL para insertar un registro
$sql = "INSERT INTO maintenance_schedule (employee_name, department, computer_id, maintenance_date, maintenance_time) 
        VALUES ('$employeeName', '$department', $computer, '$date', '$time')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
