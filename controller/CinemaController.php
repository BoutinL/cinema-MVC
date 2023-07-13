<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    //** Lister les films*/
    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_film, titre, dateSortie
            FROM film
        ");

        require "view/films/ListingFilmsView.php";
    }

    //** Lister les acteurs*/
    public function listActeurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom, id_personne
            FROM personne p
            INNER JOIN acteur a ON p.id_personne = a.personne_id
        ");

        require "view/acteurs/ListingActeursView.php";
    }

    //** Lister les realisateurs*/
    public function listRealisateurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom, id_personne
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
            WHERE id_film = :id
        ");

        $requete->execute(["id" => $id]);

        $requeteGenre = $pdo->prepare("
            SELECT nom
            FROM genre g
            INNER JOIN posseder p ON g.id_genre = p.genre_id
            WHERE film_id = :id
        ");

        $requeteGenre->execute(["id" => $id]);

        $requeteCasting = $pdo->prepare("
            SELECT prenom, p.nom AS nomActeur, r.nom AS nomRole, id_personne
            FROM personne p
            INNER JOIN acteur a ON p.id_personne = a.personne_id
            INNER JOIN jouer j ON a.id_acteur = j.acteur_id
            INNER JOIN role r ON r.id_role = j.role_id
            WHERE j.film_id = :id
        ");

        $requeteCasting->execute(["id" => $id]);

        $requeteRealisateur = $pdo->prepare("
            SELECT prenom, nom
            FROM personne p
            INNER JOIN realisateur r ON p.id_personne = r.personne_id
            INNER JOIN film f ON r.id_realisateur = f.realisateur_id
            WHERE f.id_film = :id
        ");

        $requeteRealisateur->execute(["id" => $id]);

        require "view/films/DetailFilmView.php";
    }

    // detail d'un acteur

    public function detailActeur($id) {

        $pdo = Connect::seConnecter();
        $requeteDetailActeur = $pdo->prepare("
            SELECT *
            FROM personne p
            INNER JOIN acteur a ON p.id_personne = a.personne_id
            WHERE p.id_personne = :id
        ");

        $requeteDetailActeur->execute(["id" => $id]);

        $requeteFilmDate = $pdo->prepare("
            SELECT titre, dateSortie, id_film
            FROM film f
            INNER JOIN jouer j ON f.id_film = j.film_id
            WHERE acteur_id = :id
        ");

        $requeteFilmDate->execute(["id" => $id]);

        require "view/acteurs/DetailActeurView.php";
    }

        // detail d'un realisateur

        public function detailRealisateur($id) {

            $pdo = Connect::seConnecter();
            $requeteDetailRealisateur = $pdo->prepare("
                SELECT *
                FROM personne p
                INNER JOIN realisateur r ON p.id_personne = r.personne_id
                WHERE p.id_personne = :id
            ");
    
            $requeteDetailRealisateur->execute(["id" => $id]);
    
            $requeteFilmDate = $pdo->prepare("
                SELECT titre, dateSortie, id_film
                FROM film f
                INNER JOIN jouer j ON f.id_film = j.film_id
                WHERE acteur_id = :id
            ");
    
            $requeteFilmDate->execute(["id" => $id]);
    
            require "view/realisateurs  /DetailRealisateurView.php";
        }
}