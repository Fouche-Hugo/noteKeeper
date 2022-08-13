<?php
//enlever l'id de l'utilisateur de la session
session_start();
unset($_SESSION['utilisateur']);
//supprimer le cookie
setcookie('utilisateur', '', time() - 3600, '/');
//Redirection vers l'écran de connexion
header('Location: connexion.php');
?>