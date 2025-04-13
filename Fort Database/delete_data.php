<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_image_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET["id"];
$sql = "SELECT image_path FROM users WHERE id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (file_exists($row["image_path"])) {
        unlink($row["image_path"]);
    }
}
$conn->query("DELETE FROM users WHERE id=$id");
$conn->close();
header("Location: display_data.php");
?>
