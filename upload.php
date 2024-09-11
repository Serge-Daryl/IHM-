<?php
include 'partials/header.php';
include 'partials/head.php';
include 'php/config.php';

session_start();

$user_id = $_SESSION['user_id'] ?? null;

// Vérification de l'existence de l'identifiant de l'utilisateur
if (!$user_id) {
    die("Erreur : Utilisateur non authentifié.");
}

$file_id = isset($_GET['file_id']) ? intval($_GET['file_id']) : $_SESSION['last_viewed_file_id'] ?? 0;

if ($file_id) {
    $stmt = $pdo->prepare("SELECT filename, filepath FROM uploaded_documents WHERE id = :id");
    $stmt->bindParam(':id', $file_id, PDO::PARAM_INT);
    $stmt->execute();
    $file = $stmt->fetch();

    if ($file) {
        // Mettre à jour la variable de session
        $_SESSION['last_viewed_file_id'] = $file_id;
    }
} else {
    $file = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["monfichier"])) {
    if ($_FILES["monfichier"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["monfichier"]["name"];
        $file_tmp = $_FILES["monfichier"]["tmp_name"];
        $target_dir = "uploads/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($file_name);

        if (move_uploaded_file($file_tmp, $target_file)) {
            $stmt = $pdo->prepare("INSERT INTO uploaded_documents (filename, filepath, user_id) VALUES (:filename, :filepath, :user_id)");
            $stmt->bindParam(':filename', $file_name);
            $stmt->bindParam(':filepath', $target_file);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            $lastFileId = $pdo->lastInsertId();
            $_SESSION['last_uploaded_file_id'] = $lastFileId;
            $_SESSION['last_viewed_file_id'] = $lastFileId;

            header("Location: upload.php?file_id=" . $lastFileId);
            exit();
        } else {
            die("Erreur lors de l'upload du fichier.");
        }
    } else {
        die("Erreur lors de l'upload du fichier.");
    }
}

// Suppression du fichier si demandé
if (isset($_GET['delete_id'])) {
    $file_id = intval($_GET['delete_id']);
    $stmt = $pdo->prepare("SELECT filepath FROM uploaded_documents WHERE id = :id");
    $stmt->bindParam(':id', $file_id, PDO::PARAM_INT);
    $stmt->execute();
    $file = $stmt->fetch();

    if ($file) {
        $file_path = $file['filepath'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $stmt = $pdo->prepare("DELETE FROM uploaded_documents WHERE id = :id");
        $stmt->bindParam(':id', $file_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: index.php#fichiers");
        exit();
    }
}
?>


<div id="table" class="section dark">
    <div class="boxed text-center">
        <h2>Tableau</h2>
        <?php
        if ($file) {
            $file_path = $file['filepath'];
            if (file_exists($file_path)) {
                $file_name = basename($file_path);
                $file_content = file_get_contents($file_path);
                $lines = explode("\n", $file_content);
                $line_count = count($lines);

                echo "<h3>Document : " . htmlspecialchars($file_name) . "</h3>";
                echo "<div class='table-container'>";
                echo "<table class='excel-table'>";
                $is_first_line = true;

                foreach ($lines as $line) {
                    echo "<tr" . ($is_first_line ? " class='first-row'" : "") . ">";
                    $cells = explode(";", $line);
                    foreach ($cells as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
                    $is_first_line = false;
                }
                echo "</table>";
                echo "</div>";
                echo "<p>Nombre de lignes : " . $line_count . "</p>";
            } else {
                echo "Le fichier spécifié n'existe pas.";
            }
        } else {
            echo "Aucun fichier spécifié.";
        }
        ?>
    </div>
</div>
