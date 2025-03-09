<?php


echo "Starting database setup...\n";

include("../../connection/connection.php");

if (!isset($conn) || $conn->connect_error) {
    die("Database connection failed or not available. Check your connection file.");
}

echo "\n=== Running Migrations ===\n";
include('../migrations/usersTable.php');
include('../migrations/questionsTable.php');

echo "\n=== Running Seeds ===\n";

include('../seeds/questions-seeds.php');
include('../seeds/user-seeds.php');

echo "\n=== Database Setup Complete ===\n";
echo "Your database is now ready to use!\n";
?>