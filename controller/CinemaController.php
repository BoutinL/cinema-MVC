<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    //** Lister les films*/
    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requette = $pdo->query("
            SELECT titre, annee_sortie
            From film
        ");

        require "view/listFilms.php";
    }
}