<?php
// Include your database connection file
require_once 'db_config.php';

// Get the input data
$email = $_POST['email'];
$password = $_POST['password'];

// Insert the new user into the database
$query = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

if ($stmt->affected_rows > 0) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
