<?php
// Include your database connection file
require_once 'db_config.php';

// Get the input data
$email = $_POST['email'];
$password = $_POST['password'];

// Query the database
$query = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
