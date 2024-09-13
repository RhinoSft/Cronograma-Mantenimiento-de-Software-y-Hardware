<?php
$host = '127.0.0.1';  // O usa 'localhost'
$db = 'inteinsa';
$user = 'inteinsa_user';  // Usuario que creaste
$pass = '50p0rt3DB';     // Contraseña que asignaste

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

$userId = $_GET['userId'];
$sql = "SELECT * FROM maintenance_schedule WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(null);
}

$stmt->close();
$conn->close();
?>
