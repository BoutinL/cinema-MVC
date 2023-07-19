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
            SELECT titre, dateSortie, id_film, nom
            FROM film f
            INNER JOIN jouer j ON f.id_film = j.film_id
            INNER JOIN role r ON j.role_id = r.id_role
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

        require "view/realisateurs/DetailRealisateurView.php";
    }

    // Ajouter un film

    public function afficherRealisateurs(){

        $pdo = Connect::seConnecter();
        $requeteListeRealisateur = $pdo->prepare("
            SELECT *
            FROM personne p
            INNER JOIN realisateur r ON p.id_personne = r.personne_id
        ");

        $requeteListeRealisateur->execute();

        require "view/films/AjoutFilmView.php";

    }

    public function ajouterNouveauFilm(){
        if(isset($_POST['submit'])){
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateSortie = filter_input(INPUT_POST, "dateSortie", FILTER_SANITIZE_SPECIAL_CHARS);
            $dureeMinutes = filter_input(INPUT_POST, "dureeMinutes", FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_INT);
            $affiche = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_SPECIAL_CHARS);
            $realisateur = filter_input(INPUT_POST, "realisateur", FILTER_SANITIZE_SPECIAL_CHARS);

            if($titre && $dateSortie && $dureeMinutes && $note && $affiche && $realisateur){
                $pdo = Connect::seConnecter();
                $requeteAjoutNouveauFilm = $pdo->prepare("
                    INSERT INTO film (titre, dateSortie, dureeMinutes, note, affiche, realisateur_id) 
                    VALUES (?, ?, ?, ?, ?, ?);
                ");

                // Liaison des valeurs des paramètres avec les variables
                $requeteAjoutNouveauFilm->bindParam(1, $titre);
                $requeteAjoutNouveauFilm->bindParam(2, $dateSortie);
                $requeteAjoutNouveauFilm->bindParam(3, $dureeMinutes);
                $requeteAjoutNouveauFilm->bindParam(4, $note);
                $requeteAjoutNouveauFilm->bindParam(5, $affiche);
                $requeteAjoutNouveauFilm->bindParam(6, $realisateur);

                $requeteAjoutNouveauFilm->execute();
                header("Location:index.php?action=listFilms"); exit;
                require "view/films/AjoutFilmView.php";
            }
        }
    }

    // Ajouter nouvel acteur 
    public function ajouterNouvelActeur(){
        if(isset($_POST['submit'])){
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_SPECIAL_CHARS);

            if($nom && $prenom && $sexe && $dateNaissance){
                $pdo = Connect::seConnecter();
                $requeteAjouterNouvelActeur = $pdo->prepare("
                    INSERT INTO personne (nom, prenom, sexe, dateNaissance) 
                    VALUES (?, ?, ?, ?);
                ");

                // Liaison des valeurs des paramètres avec les variables
                $requeteAjouterNouvelActeur->bindParam(1, $nom);
                $requeteAjouterNouvelActeur->bindParam(2, $prenom);
                $requeteAjouterNouvelActeur->bindParam(3, $sexe);
                $requeteAjouterNouvelActeur->bindParam(4, $dateNaissance);

                $requeteAjouterNouvelActeur->execute();
                header("Location:index.php?action=listingActeurs"); exit;
                require "view/acteurs/AjoutActeurView.php";
            }
        }
    }

    // Effacer un film

    public function effacerFilm($id){

        $pdo = Connect::seConnecter();
        $requeteEffacerFilm = $pdo->prepare("
            DELETE FROM film WHERE id_film = :id
        ");

        $requeteEffacerFilm->execute(["id" => intval($id)]);

        $requete = $pdo->query("
        SELECT id_film, titre, dateSortie
        FROM film
        ");

        require "view/films/ListingFilmsView.php";

        header("Location:index.php?action=listFilms"); exit;
    }

    // Modifier un film

    public function afficherFilmModif($id){

        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT *
            FROM film f
            WHERE id_film = :id
        ");

        $requete->execute(["id" => $id]);

        $pdo = Connect::seConnecter();
        $requeteListeRealisateur = $pdo->prepare("
            SELECT *
            FROM personne p
            INNER JOIN realisateur r ON p.id_personne = r.personne_id
        ");

        $requeteListeRealisateur->execute();

        require "view/films/ModifFilmView.php";
    }

    public function modifierFilm($id, $titre, $dateSortie, $dureeMinutes, $note, $affiche, $realisateur_id){

        if(isset($_POST['submit'])){
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateSortie = filter_input(INPUT_POST, "dateSortie", FILTER_SANITIZE_SPECIAL_CHARS);
            $dureeMinutes = filter_input(INPUT_POST, "dureeMinutes", FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_INT);
            $affiche = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_SPECIAL_CHARS);
            $realisateur = filter_input(INPUT_POST, "realisateur", FILTER_SANITIZE_SPECIAL_CHARS);

            if($titre && $dateSortie && $dureeMinutes !== false && $note !== false && $affiche && $realisateur){
                $pdo = Connect::seConnecter();

                $requeteModifierFilm = $pdo->prepare("
                    UPDATE film
                    SET titre = :titre, dateSortie = :dateSortie, dureeMinutes = :dureMinutes, note= :note, affiche= :affiche, realisateur_id= :realisateur
                    WHERE id = :id
                ");

                $requeteModifierFilm->execute([
                    "id" => $id,
                    "titre" => $titre,
                    "dateSortie" => $dateSortie,
                    "dureeMinutes" => $dureeMinutes,
                    "note" => $note,
                    "affiche" => $affiche,
                    "realisateur_id" => $realisateur_id,
                ]);
                header("Location:index.php?action=listFilms"); exit;
            }
        }
        require "view/films/ModifFilmView.php";
    }
}