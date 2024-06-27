<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["monfichier"]) && $_FILES["monfichier"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["monfichier"]["name"];
        $file_tmp = $_FILES["monfichier"]["tmp_name"];

        // Répertoire cible pour le téléchargement
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Chemin du fichier cible dans le répertoire d'upload
        $target_file = $target_dir . basename($file_name);

        // Déplace le fichier uploadé vers le répertoire d'upload
        if (move_uploaded_file($file_tmp, $target_file)) {
            // Enregistre les informations du fichier dans la base de données
            $stmt = $pdo->prepare("INSERT INTO uploaded_documents (filename, filepath) VALUES (:filename, :filepath)");
            $stmt->bindParam(':filename', $file_name);
            $stmt->bindParam(':filepath', $target_file);
            $stmt->execute();

            // Redirection vers index.php avec le chemin du fichier comme paramètre d'URL
            header("Location: index.php?file=" . urlencode($target_file));
            exit;
        } else {
            die("Erreur lors de l'upload du fichier.");
        }
    } else {
        die("Erreur lors de l'upload du fichier.");
    }
}
?>
