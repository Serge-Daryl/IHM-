<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mon Projet de Stage</title>
    <meta name="description" content="Ceci est mon projet de stage"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/app.js"></script>
</head>
<body>
<header>
    <div class="boxed">
        <div class="flex aligncenter space-between">
            <a href="/" class="header-logo">
                <img src="img/Attijariwafa-logo.png" alt="Logo Attijariwafa">
            </a>
            <ul class="header-menu">
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#about">À propos</a></li>
                <li><a href="#formulaire">Formulaire</a></li>
                <li><a href="#fichiers">Fichiers téléchargés</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</header>
<div id="accueil" class="slider">
        <img src="img/slider.jpg" class="slider-background" alt="Image de fond du slider">
        <div class="slider-content">
            <h1>Lecteur Excel</h1>
            <p>Explorons ensemble le contenu de vos documents</p>
        </div>
    </div>
    <div id="about" class="section">
        <div class="boxed">
            <div class="flex toColumn">
                <div class="w40 wm100">
                    <h2>À propos</h2>
                </div>
                <div class="w60 wm100">
                    <p>Le terme "NPAI" signifie "N'habite Pas à l'Adresse Indiquée". Il est couramment utilisé par les services postaux pour indiquer qu'une personne ne réside plus ou n'a jamais résidé à l'adresse fournie.</p>
                </div> 
            </div> 
            <div class="flex toColumn">
                <div class="w40 wm100">
                    <h2></h2>
                </div>
                <div class="w60 wm100">
                    <p>Dans le secteur bancaire et financier, un fichier NPAI est un registre des clients dont les courriers ont été retournés avec la mention "NPAI". Ces fichiers permettent de mettre à jour les coordonnées des clients, évitant ainsi les envois futurs à des adresses incorrectes et optimisant la communication.</p>
                </div> 
            </div> 
        </div>
    </div>
    
    <div id="formulaire" class="section dark">
    <div class="boxed text-center">
        <h2>Formulaire</h2>
                <form enctype="multipart/form-data" action="upload.php" method="post">
                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                    <label for="fileUpload">Choisissez un fichier</label>
                    <input type="file" name="monfichier" id="fileUpload" accept=".csv"/>
                    <input type="submit" value="Afficher" />
                </form>
                <?php
                if (isset($_GET['file'])) {
                    $file_path = $_GET['file'];
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


<div id="fichiers" class="section">
        <div class="boxed text-center">
            <h2>Fichiers téléchargés</h2>
            <?php
            include 'config.php';

            // Afficher la liste des fichiers téléchargés
            $stmt = $pdo->query("SELECT * FROM uploaded_documents");
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li><a href='index.php?file=" . urlencode($row['filepath']) . "'>" . htmlspecialchars($row['filename']) . "</a></li>";
            }
            echo "</ul>";
            ?>
        </div>
    </div>

    <div id="contact" class="section dark">
        <div class="boxed text-center">
            <h2>Contactez nous</h2>
            <div class="flex toColumn gap20 space-between">
                <div class="w32 wm47 contact">
                    <span class="material-icons">mail</span>
                    <span class="label">E-mail</span>
                    <span class="value">s.mabickassa@ecole-ipssi.net</span>
                </div>
                <div class="w32 wm47 contact">
                    <i class="bi bi-linkedin"></i>
                    <span class="label">LinkedIn</span>
                    <span class="value">
                        <a href="https://www.linkedin.com/in/serge-daryl-mabickassa-boussougou">serge-daryl-mabickassa-boussougou</a>
                    </span>
                </div>
                <div class="w32 wm47 contact">
                    <span class="material-icons">contact_phone</span>
                    <span class="label">Téléphone</span>
                    <span class="value">+33 7 53 66 00 60</span>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/app.js"></script>
</html>
