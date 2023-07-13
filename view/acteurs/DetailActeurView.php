<?php 
    ob_start(); 

    // fetch
    $acteur = $requeteDetailActeur->fetch();

    // conversion au format d-m-Y
    $dateNaissanceAncienFormat = $acteur['dateNaissance'];
    $dateNaissanceNouveauFormat = date('d-m-Y', strtotime($dateNaissanceAncienFormat));
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
                <th>Rôle</th>
                <th>Titre du film</th>
                <th>Année de sortie</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requeteFilmDate->fetchAll() as $film) { ?>
                    <tr>
                        <td><?= $film[ "nom" ] ?></td>
                        <td><a href='index.php?action=detailFilm&id=<?= $film["id_film"] ?>'><?= $film[ "titre" ] ?></a></td>
                        <td><?= date("Y", strtotime($film[ "dateSortie" ]))  ?></td>
                    </tr>
            <?php } ?>
        </tbdoy>
    </table>
</section>
<?php

$titre = $acteur[ 'prenom' ]." ".$acteur[ 'nom' ];
$titre_secondaire = " Détails de l'acteur : ".$acteur[ 'prenom' ]." ".$acteur[ 'nom' ];
$contenu = ob_get_clean();
require "view/template.php";