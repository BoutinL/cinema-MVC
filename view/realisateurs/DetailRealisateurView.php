<?php 
    ob_start(); 

    // fetch
    $realisateur = $requeteDetailRealisateur->fetch();

    // conversion au format d-m-Y
    $dateNaissanceAncienFormat = $realisateur['dateNaissance'];
    $dateNaissanceNouveauFormat = date('d-m-Y', strtotime($dateNaissanceAncienFormat));
?>

<section class="detail-realisateur">
    <h3>Prénom : <?= $realisateur['prenom'] ?></h3>
    <h3>Nom : <?= $realisateur['nom'] ?></h3>
    <p>Date de naissance : <?= $dateNaissanceNouveauFormat ?></p>
</section>
<section class="filmographie">
    <table>
        <thead>
            <tr>
                <th>Titre du film</th>
                <th>Année de sortie</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requeteFilmDate->fetchAll() as $film) { ?>
                    <tr>
                        <td><a href='index.php?action=detailFilm&id=<?= $film["id_film"] ?>'><?= $film[ "titre" ] ?></a></td>
                        <td><?= date("Y", strtotime($film[ "dateSortie" ]))  ?></td>
                    </tr>
            <?php } ?>
        </tbdoy>
    </table>
</section>
<?php

$titre = $realisateur[ 'prenom' ]." ".$realisateur[ 'nom' ];
$titre_secondaire = " Détails du réalisateur : ".$realisateur[ 'prenom' ]." ".$realisateur[ 'nom' ];
$contenu = ob_get_clean();
require "view/template.php";