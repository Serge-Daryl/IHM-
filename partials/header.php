<?php
session_start(); // Assurez-vous que la session est démarrée
?>

<body>
<header>
    <div class="boxed">
        <div class="flex aligncenter space-between">
            <a href="/" class="header-logo">
                <img src="img/Attijariwafa-logo.png" alt="Logo Attijariwafa">
            </a>
            <ul class="header-menu">
                <li><a href="index.php#accueil">Accueil</a></li>
                <li><a href="index.php#about">À propos</a></li>
                <li><a href="index.php#formulaire">Formulaire</a></li>
                <li><a href="index.php#fichiers">Fichiers téléchargés</a></li>
                <?php if (isset($_SESSION['last_viewed_file_id'])): ?>
                   <li><a href="upload.php?file_id=<?php echo $_SESSION['last_viewed_file_id']; ?>">Affichage</a></li>
                <?php endif; ?>
                <li><a href="index.php#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</header>
