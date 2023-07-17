<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name .'.php';
});

$ctrlCinema = new CinemaController();
$id = (isset($_GET["id"])) ? $_GET["id"] : "";

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
        case "detailActeur" : $ctrlCinema->detailActeur($id); break;
        case "detailRealisateur" : $ctrlCinema->detailRealisateur($id); break;
        case "ajouterFilm" : $ctrlCinema->afficherRealisateurs(); break;
        case "ajouterNouveauFilm" : $ctrlCinema->ajouterNouveauFilm(); break;
        case "effacerFilm" : $ctrlCinema->effacerFilm($id); break;
        case "afficherFilmModif" : $ctrlCinema->afficherFilmModif($id); break;
    }
} else {
    $ctrlCinema->listFilms();
}