<?php ob_start(); ?>

<section class="form-ajout-acteur">
    <form action="index.php?action=ajouterNouvelActeur" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br/>
        <label for="prenom">Prénom :</label>
        <input type="prenom" id="prenom" name="prenom"><br/>
        <label for="sexe">sexe :</label>
        <input type="text" id="sexe" name="sexe"><br/>
        <label for="dateNaissance">Date de naissance :</label>
        <input type="date" id="dateNaissance" name="dateNaissance"><br/>
        <input type="submit" name="submit" value="Ajouter">
    </form>
</section>
<?php

$titre = "Ajout Acteur";
$titre_secondaire = "Ajouter un acteur";
$contenu = ob_get_clean();
require "view/template.php";

