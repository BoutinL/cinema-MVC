<?php ob_start(); ?>



<?php

$titre = "<?= $film['titre'] ?>";
$titre_secondaire = "Détails du film: <?= $film['titre'] ?>";
$contenu = ob_get_clean();
require "view/template.php";