<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_image_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $image = $_FILES["image"];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image["name"]);
    move_uploaded_file($image["tmp_name"], $target_file);

    $sql = "INSERT INTO users (name, email, image_path) VALUES ('$name', '$email', '$target_file')";
    $conn->query($sql);
    $conn->close();
    header("Location: display_data.php");
}
?>
