<?php 


include 'partials/header.php'; 
include 'partials/head.php';
include 'php/config.php'; // Inclure la connexion PDO ici

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<div id="accueil" class="slider">
    <img src="img/slider.jpg" class="slider-background">
    <div class="slider-content">
        <h1>Lecteur Excel</h1>
        <p>Bienvenue sur votre lecteur excel personnel</p>
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
            <!-- Ajout du champ caché pour l'identifiant de l'utilisateur -->
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        </form>
    </div>
</div>


<div id="fichiers" class="section">
    <div class="boxed text-center">
        <h2 >Fichiers téléchargés</h2>
        <div class="table-responsive">
            <table id="file-table" class="table table-striped table-bordered table-custom">
                <thead>
                    <tr>
                        <th scope="col">Nom du fichier</th>
                        <th scope="col">Date de téléchargement</th>
                        <th scope="col">Nombre de lignes</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM uploaded_documents WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                $stmt->execute();
                $row_num = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $file_id = $row['id'];
                    $file_name = htmlspecialchars($row['filename']);
                    $file_path = $row['filepath'];

                    // Obtenir la date de téléchargement
                    $file_date = date("d/m/Y H:i:s", filemtime($file_path));

                    // Obtenir le nombre de lignes du fichier
                    $file_content = file_get_contents($file_path);
                    $lines = explode("\n", $file_content);
                    $line_count = count($lines);

                    // Appliquer une classe spécifique à la première ligne
                    $row_class = ($row_num == 0) ? 'first-row' : '';

                    echo "<tr class='$row_class'>";
                    echo "<td><a href='upload.php?file_id=" . $file_id . "' class='text-decoration-none text-dark'>" . $file_name . "</a></td>";
                    echo "<td>" . $file_date . "</td>";
                    echo "<td>" . $line_count . "</td>";
                    echo "<td><a href='upload.php?delete_id=" . $file_id . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce fichier ?\")'>Supprimer</a></td>";
                    echo "</tr>";

                    $row_num++;
                }
                ?>
                </tbody>
            </table>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/datatables.min.js"></script>
<script src="js/database-setup.js"></script>

</html>
