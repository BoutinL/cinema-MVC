<?php ob_start(); ?>

<section class="form-modif-acteur">

</section>
<?php

$titre = "Modifier acteur";
$titre_secondaire = "Modification de l'acteur : ".$personne['prenom']." ".$personne['prenom'];
$contenu = ob_get_clean();
require "view/template.php";