<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> realisateurs</p>

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
                    <td><?= $realisateur["prenom"] ?></td>
                    <td><?= $realisateur["nom"] ?></td>
                </tr>
        <?php } ?>
    </tbdoy>
</table>

<?php

$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "view/template.php";