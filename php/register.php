<?php
session_start();
require_once 'config.php'; // Assurez-vous que la connexion PDO est incluse ici

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validation des mots de passe
    if ($password !== $confirm_password) {
        header("Location: ../signup.php?error=password_mismatch"); // Redirection en cas de non-correspondance
        exit();
    }

    // Insertion de l'utilisateur dans la base de données
    $query = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([$username, $email, $password]);

    if ($result) {
        $user_id = $pdo->lastInsertId();
        $_SESSION['user_id'] = $user_id;
        header("Location: ../index.php"); // Redirection vers index.php
        exit();
    } else {
        header("Location: ../signup.php?error=signup_failed"); // Redirection en cas d'échec
        exit();
    }
}
