<?php
session_start();
require_once 'config.php'; // Assurez-vous que la connexion PDO est incluse ici

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier les informations d'identification
    $query = "SELECT id FROM user WHERE username = ? AND password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $password]);

    if ($stmt->rowCount() > 0) {
        $user_id = $stmt->fetchColumn();
        $_SESSION['user_id'] = $user_id;
        header("Location: ../index.php"); // Redirection vers index.php
        exit();
    } else {
        header("Location: ../login.php?error=1"); // Redirection en cas d'échec
        exit();
    }
}
