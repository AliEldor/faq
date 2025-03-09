<?php

include("../../../../faq/article-server/connection/connection.php");

$conn->query("TRUNCATE TABLE users");
$conn->query("TRUNCATE TABLE questions");

$users = [
    [
        'full_name' => 'Ali',
        'email' => 'revilvillage1@gmail.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT)
    ],
    [
        'full_name' => 'Ali',
        'email' => 'alieldor02@gmail.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT)
    ],
    [
        'full_name' => 'Ali',
        'email' => 'newww@gmail.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT)
    ]
    ];

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $full_name, $email, $password);

foreach ($users as $user) {
    $full_name = $user['full_name'];
    $email = $user['email'];
    $password = $user['password'];
    $stmt->execute();
}

echo "Seeded " . count($users) . " users.\n";