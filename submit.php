<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $phone = trim($_POST["phone"]);
  $address = trim($_POST["address"]);

  // Basic validation
  if ($name && $email && $phone && $address) {
    // Check if email or phone already exists
   // $checkQuery = "SELECT * FROM users WHERE email=$email OR phone=$phone";
   // $stmt = $conn->prepare($checkQuery);
    //$stmt->bind_param("ss", $email, $phone);
    //$stmt->execute();
    //$result = $stmt->get_result();
    $checkQuery = "SELECT * FROM users WHERE email =? OR phone =?";
    $stmt = $conn->prepare($checkQuery);
    if ($stmt === false) {
      die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      echo "Email or phone number already registered.";
    } else {
      // Insert new record
      $insertQuery = "INSERT INTO users (name, email, phone, address) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($insertQuery);
      $stmt->bind_param("ssss", $name, $email, $phone, $address);

      if ($stmt->execute()) {
        echo "Registration successful!";
      } else {
        echo "Error: " . $stmt->error;
      }
    }

    $stmt->close();
  } else {
    echo "All fields are required.";
  }

  $conn->close();
}
?>
