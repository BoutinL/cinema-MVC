<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name .'.php';
});

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); breaks;
        case "listActeurs" : $ctrlCinema->listActeurs(); breaks;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); breaks;
    }
}