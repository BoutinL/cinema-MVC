<?php ob_start(); 

?>

<p>Il y a <?= $requete->rowCount() ?> acteurs</p>
<a href='index.php?action=ajouterNouvelActeur'>Ajouter un acteur</a>

<table>
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $acteur) { ?>
                <tr>
                    <td><a href='index.php?action=detailActeur&id=<?= $acteur["id_personne"] ?>'><?= $acteur["prenom"] ?></a></td>
                    <td><a href='index.php?action=detailActeur&id=<?= $acteur["id_personne"] ?>'><?= $acteur["nom"] ?></a></td>
                </tr>
        <?php } ?>
    </tbdoy>
</table>

<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";