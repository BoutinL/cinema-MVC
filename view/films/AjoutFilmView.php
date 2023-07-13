<?php 
    ob_start(); 
?>

<section class="form-ajout-film">
    <form action="" method="GET">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required>
        <label for="dateSortie">Date de sortie :</label>
        <input type="date" id="dateSortie" name="dateSortie" required>
        <label for="dureeMinutes">Durée en minutes :</label>
        <input type="number" min="0" id="dureeMinutes" name="dureeMinutes">
        <label for="note">Note :</label>
        <input type="number" min="0" max="5" id="note" name="note">
        <label for="affiche">Url de l'affiche :</label>
        <input type="text" id="affiche" name="affiche">
        <label for="realisateur">Realisateur :</label>
        <select id="realisateur" name="realisateur" required>
        <?php 
            foreach($requeteListeRealisateur->fetchAll() as $realisateur){
                $id = $realisateur['id_realisateur'];
                $prenom = $realisateur['prenom'];
                $nom = $realisateur['nom'];
                echo "<option value=\"$id\">$prenom $nom</option>";
            }
        ?>
        <input type="submit" value="Ajouter">
    </form>
</section>
<?php

$titre = "Ajout Film";
$titre_secondaire = "Ajouter un film";
$contenu = ob_get_clean();
require "view/template.php";