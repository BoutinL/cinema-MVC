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

        require "view/films/ListingFilmView.php";
    }

    //** Lister les acteurs*/
    public function listActeurs() {

        $pdo = Connect::seConnecter();
        $requette = $pdo->query("
            SELECT prenom, nom
            From acteur
        ");

        require "view/acteurs/ListingActeursView.php";
    }

    //** Lister les realisateurs*/
    public function listRealisateurs() {

        $pdo = Connect::seConnecter();
        $requette = $pdo->query("
            SELECT prenom, nom
            From realisateur
        ");

        require "view/realisateurs/ListingRealisateursView.php";
    }
}