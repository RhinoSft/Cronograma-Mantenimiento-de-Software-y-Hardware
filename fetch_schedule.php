<?php
$host = '127.0.0.1';  // O usa 'localhost'
$db = 'inteinsa';
$user = 'inteinsa_user';  // Usuario que creaste
$pass = '50p0rt3DB';     // Contraseña que asignaste

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

// Obtener y validar el ID de la programación
$scheduleId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($scheduleId <= 0) {
    echo json_encode(['error' => 'ID de programación inválido']);
    $conn->close();
    exit();
}

// Preparar y ejecutar la consulta
$sql = "SELECT * FROM maintenance_schedule WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['error' => 'Error en la preparación de la consulta']);
    $conn->close();
    exit();
}

$stmt->bind_param('i', $scheduleId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['error' => 'No se encontró la programación']);
} else {
    $data = $result->fetch_assoc();
    echo json_encode($data);
}

// Cerrar declaración y conexión
$stmt->close();
$conn->close();
?>
