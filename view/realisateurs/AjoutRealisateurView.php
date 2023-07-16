<?php ob_start(); ?>

<section class="form-ajout-realisateur">

</section>
<?php

$titre = "Ajout realisateur";
$titre_secondaire = "Ajouter un realisateur";
$contenu = ob_get_clean();
require "view/template.php";