<?php 
    ob_start(); 
    $film = $requete->fetch();
?>

<section class="detail-film">
<h3>Nom du film : <?= $film['titre'] ?></h3>
<p>Note : <?= $film['note'] ?></p>
<p>Note : <?= $film['note'] ?></p>
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
                foreach($requeteCasting->fetchAll() as $acteur) { ?>
                    <tr>
                        <td ><?= $acteur[ "prenom" ] ?></td>
                        <td><?= $acteur[ "nomActeur" ] ?></td>
                        <td><?= $acteur[ "nomRole" ] ?></td>
                    </tr>
            <?php } ?>
        </tbdoy>
    </table>
</section>
<?php

$titre = $film[ 'titre' ];
$titre_secondaire = " Détails du film ". $film[ 'titre' ];
$contenu = ob_get_clean();
require "view/template.php";