<?php ob_start(); ?>

<section class="form-ajout-acteur">

</section>
<?php

$titre = "Ajout Acteur";
$titre_secondaire = "Ajouter un acteur";
$contenu = ob_get_clean();
require "view/template.php";