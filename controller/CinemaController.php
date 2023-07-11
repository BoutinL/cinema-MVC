<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    //** Lister les films*/
    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, dateSortie
            FROM film
        ");

        require "view/films/ListingFilmsView.php";
    }

    //** Lister les acteurs*/
    public function listActeurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom
            FROM personne p
            INNER JOIN acteur a ON p.id_personne = a.personne_id
        ");

        require "view/acteurs/ListingActeursView.php";
    }

    //** Lister les realisateurs*/
    public function listRealisateurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom
            FROM personne p
            INNER JOIN realisateur r ON p.id_personne = r.personne_id
        ");

        require "view/realisateurs/ListingRealisateursView.php";
    }
}