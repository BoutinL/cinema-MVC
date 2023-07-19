<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> realisateurs</p>
<a href='index.php?action=ajouterNouveauRealisateur'>Ajouter un realisateur</a>

<table>
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $realisateur) { ?>
                <tr>
                    <td><a href='index.php?action=detailRealisateur&id=<?= $realisateur["id_personne"] ?>'><?= $realisateur["prenom"] ?></a></td>
                    <td><a href='index.php?action=detailRealisateur&id=<?= $realisateur["id_personne"] ?>'><?= $realisateur["nom"] ?></a></td>
                </tr>
        <?php } ?>
    </tbdoy>
</table>

<?php

$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "view/template.php";