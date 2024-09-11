<?php
session_start();
$title = "Connexion";
include 'partials/head.php';
?>

<div id="forgot-password" class="section dark">
    <div class="center-box">
        <div class="forgot-box">
            <h2>Trouvez votre compte</h2>
            <div class="separator"></div>
            <form action="process.php?action=reset_request" method="post">
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Adresse email" required>
                </div>
                <div class="separator"></div>
                <button class="btn fourth-btn" onclick="window.location.href='login.php'">Rechercher</button>
                <button class="btn fifth-btn" onclick="window.location.href='login.php'">Annuler</button>
            </form>
        </div>
    </div>
</div>