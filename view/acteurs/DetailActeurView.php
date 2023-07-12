<?php 
    ob_start(); 
    $acteur = $requeteActeur->fetch();
    // conversion au format d-m-Y
    $dateNaissanceAncienFormat = $acteur['dateNaissance'];
    $dateNaissanceNouveauFormat = date('d-m-Y', strtotime($dateNaissanceAncienFormat));
    $dateSortieAncienFormat = $film['dateSortie'];
    $dateSortieNouveauFormat = date('Y', strtotime($dateSortieAncienFormat));
?>

<section class="detail-acteur">
<h3>Prénom : <?= $acteur['prenom'] ?></h3>
<h3>Nom : <?= $acteur['nom'] ?></h3>
<p>Date de naissance : <?= $dateNaissanceNouveauFormat ?></p>
</section>
<section class="filmographie">
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Année de sortie</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requeteFilmographie->fetchAll() as $acteur) { ?>
                    <tr>
                        <td><a href=''><?= $acteur[ "titre" ] ?></a></td>
                        <td><a href=""><?= $dateSortieNouveauFormat ?></a></td>
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