<?php
session_start();

//Si l'utilisateur n'est pas connecté, on le renvoie vers la page de connexion
if(!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
}
include 'bdd.php';
include 'php/header_gestion.php';
?>