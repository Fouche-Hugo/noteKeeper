<?php
//enlever l'id de l'utilisateur de la session
session_start();
unset($_SESSION['utilisateur']);
//Redirection vers l'écran de connexion
header('Location: connexion.php');
?>