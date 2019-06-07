<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartcaps";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO product (name, description, costprice, price, version)
VALUES ('Nieuw product', '', '', '', '1.0')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('location: dashboard.php');
?>