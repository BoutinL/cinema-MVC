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

    //** Détail d'un film*/
    public function detailFilm($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM film f
            INNER JOIN posseder p ON f.id_film = p.film_id
            INNER JOIN jouer j ON f.id_film = j.film_id
            INNER JOIN acteur a ON j.id_acteur = a.acteur_id
            INNER JOIN personne pers ON a.id_personne = pers.personne_id
            WHERE id_film = :id
        ");
        $requete->execute(["id" => $id]);

        require "view/films/DetailFilm.php";
    }
}