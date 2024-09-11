<?php
session_start();
$title = "Inscription";
include 'partials/head.php';

?>


<div id="inscription" class="section dark">
    <div class="center-box">
    <div class="signup-box">
            <h2>Inscription</h2>
            <form action="php/register.php" method="post">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Adresse email" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="input-group">
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmer le mot de passe" required>
                </div>
                <div class="input-group wrap">
                    <label>Date de naissance</label>
                    <div class="birthdate-group">
                        <select id="birth-day" name="birth-day" required>
                            <option value="" disabled selected>Jour</option>
                            <?php for($i = 1; $i <= 31; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        <select id="birth-month" name="birth-month" required>
                            <option value="" disabled selected>Mois</option>
                            <?php 
                            $months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
                            foreach($months as $index => $month): ?>
                                <option value="<?php echo $index + 1; ?>"><?php echo $month; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select id="birth-year" name="birth-year" required>
                            <option value="" disabled selected>Année</option>
                            <?php 
                            $currentYear = date("Y");
                            for($i = $currentYear; $i >= 1900; $i--): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <label for="gender">Genre</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Choisir...</option>
                        <option value="male">Homme</option>
                        <option value="female">Femme</option>
                        <option value="other">Autre</option>
                    </select>
                </div>
                <button type="submit" class="btn primary-btn">S'inscrire</button>
            </form>
            <div class="form-links">
                <a href="login.php" class="form-link">Déjà un compte ? Connectez-vous</a>
            </div>
        </div>
    </div>
</div>

