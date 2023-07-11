<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name .'.php';
});

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "detailFilm" : $ctrlCinema->detailFilm(); break;
    }
} else {
    $ctrlCinema->listFilms();
}