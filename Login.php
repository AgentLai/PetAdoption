<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Member WHERE Email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

$email = $_POST['email'];

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($_POST['password'], $row['Password'])) {
        $_SESSION['email'] = $email;
        echo "Login successful!";
    } else {
        echo "Invalid password";
    }
} else {
    echo "User not found";
}

$stmt->close();
$conn->close();
?>