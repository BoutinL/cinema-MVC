<?php ob_start(); ?>

<section class="form-ajout-film">
    <form action="index.php?action=ajouterNouveauFilm" method="post">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required><br/>
        <label for="dateSortie">Date de sortie :</label>
        <input type="date" id="dateSortie" name="dateSortie"><br/>
        <label for="dureeMinutes">Durée en minutes :</label>
        <input type="number" min="0" id="dureeMinutes" name="dureeMinutes"><br/>
        <label for="note">Note :</label>
        <input type="number" min="0" max="5" id="note" name="note"><br/>
        <label for="affiche">Url de l'affiche :</label>
        <input type="text" id="affiche" name="affiche"><br/>
        <label for="realisateur">Realisateur :</label>
        <select id="realisateur" name="realisateur" required><br/>
        <?php 
            foreach($requeteListeRealisateur->fetchAll() as $realisateur){
                $id = $realisateur['id_realisateur'];
                $prenom = $realisateur['prenom'];
                $nom = $realisateur['nom'];
                echo "<option value=\"$id\">$prenom $nom</option>";
            }
        ?>
        <input type="submit" name="submit" value="Ajouter">
    </form>
</section>
<?php

$titre = "Ajout Film";
$titre_secondaire = "Ajouter un film";
$contenu = ob_get_clean();
require "view/template.php";