<?php ob_start(); ?>

<section class="detail-film">
<h3><?= $film = $requete->fetch(); echo $film['titre'] ?></h3>
</section>
<section class="casting">
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requete->fetchAll() as $acteur) { ?>
                    <tr>
                        <td ><?= $acteur["prenom"] ?></td>
                        <td><?= $acteur["nom"] ?></td>
                        <td><?= $acteur["role"] ?></td>
                    </tr>
            <?php } ?>
        </tbdoy>
    </table>
</section>
<?php

$titre = $film['titre'];
$titre_secondaire = "Détails du film". $film['titre'];
$contenu = ob_get_clean();
require "view/template.php";