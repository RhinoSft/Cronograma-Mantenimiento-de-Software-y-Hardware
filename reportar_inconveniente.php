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
$reportUserId = $_POST['reportUserId'];
$issueDescription = $_POST['issueDescription'];

// SQL para insertar un reporte
$sql = "INSERT INTO reported_issues (user_id, issue_description) 
        VALUES ('$reportUserId', '$issueDescription')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Reporte enviado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
