<?php
include 'bdd.php';
include 'fonctions.php';

session_start();

//On test si l'utilisateur est bien connecté
if(!isset($_SESSION['utilisateur'])){
    header('Location: connexion.php');
}
?>