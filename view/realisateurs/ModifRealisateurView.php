<?php ob_start(); ?>

<section class="form-modif-realisateur">

</section>
<?php

$titre = "Modifier realisateur";
$titre_secondaire = "Modification du realisateur : ".$personne['prenom']." ".$personne['prenom'];
$contenu = ob_get_clean();
require "view/template.php";