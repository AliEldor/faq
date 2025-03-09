<?php
include("../../connection/connection.php");

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

echo "Database created successfully or already exists.\n";

$conn->select_db($dbname);

// Create users table
$sql = "
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if ($conn->query($sql) !== TRUE) {
    die("Error creating users table: " . $conn->error);
}

echo "Users table created successfully or already exists.\n";

$conn->close();

echo "Migration completed successfully!\n";
?>