<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté


$title = "Connexion";
include 'partials/head.php';
?>

<div id="connexion" class="section dark">
    <div class="boxed flex space-between">
        <!-- Contenu à gauche (ou supérieur) -->
        <div class="login-text">
            <h1>Lecteur Excel</h1>
            <p>Explorons ensemble le contenu de vos documents</p>
        </div>
        <!-- Formulaire de connexion à droite (ou inférieur) -->
        <div class="login-box">
            <form action="php/authenticate.php" method="post">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="btn primary-btn">Se connecter</button>
            </form>
            <div class="form-links">
                <a href="forgot-password.php">Mot de passe oublié ?</a>
                <div class="separator"></div>
                <a href="signup.php" class="btn second-btn">Créer un compte</a>
            </div>
        </div>
    </div>
</div>