<?php
include 'bdd.php';
include 'fonctions.php';

session_start();

//On test si l'utilisateur est déja connecté
if(isset($_SESSION['utilisateur'])){
    header('Location: index.php');
}

//On test si tout à bien été envoyé
if(isset($_POST['mail']) && isset($_POST['motDePasse'])) {
    //enlever les caratères dangereux dans les données reçues par POST (mail, motDePasse)
    $email = valid_donnees($_POST['mail']);
    $password = valid_donnees($_POST['motDePasse']);

    //On tente de se connecter, pour celà, on récupère le mot de passe de l'utilisateur
    if($req = $db->prepare('SELECT id, motDePasse FROM utilisateur WHERE mail = ?')) {
        $req->bind_param('s', $email);
        $req->execute();
        $req->bind_result($id, $passwordBDD);
        $req->fetch();
        $req->close();

        //On vérifie que le mot de passe correspond bien à celui de la base de données
        if(password_verify($password, $passwordBDD)) {
            $_SESSION['utilisateur'] = $id;
            header('Location: index.php');
        } else {
            header('Location: connexion.php?erreur=erreurMDP&mail=' . $email);
        }

    } else {
        header('Location: connexion.php?erreur=erreurBDD&mail=' . $email);
    }
}

include 'close_bdd.php';
?>