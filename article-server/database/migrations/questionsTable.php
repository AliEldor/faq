<?php
include("../../connection/connection.php");

$sql = "
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if ($conn->query($sql) !== TRUE) {
    die("Error creating questions table: " . $conn->error);
}

echo "Questions table created successfully or already exists.\n";

$conn->close();

echo "Migration completed successfully!\n";
?>