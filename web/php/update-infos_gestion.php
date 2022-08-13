<?php
include 'bdd.php';
include 'fonctions.php';

session_start();

//On test si l'utilisateur est bien connecté
if(!isset($_SESSION['utilisateur'])){
    header('Location: connexion.php');
}

include 'php/header_gestion.php';

//Gestion de la mise à jour du mot de passe
//On test si tout a bien été envoyé
if(isset($_POST['ancienMotDePasse']) && isset($_POST['nouveauMotDePasse']) && isset($_POST['nouveauMotDePasse2'])) {
    //enlever les caratères dangereux dans les données reçues par POST (ancienMotDePasse, nouveauMotDePasse, nouveauMotDePasse2)
    $ancienMotDePasse = valid_donnees($_POST['ancienMotDePasse']);
    $nouveauMotDePasse = valid_donnees($_POST['nouveauMotDePasse']);
    $nouveauMotDePasse2 = valid_donnees($_POST['nouveauMotDePasse2']);

    //On vérifie que les tailles sont respectées
    if(strlen($nouveauMotDePasse) >= 8 && strlen($nouveauMotDePasse) <= 25) {

        //On vérifie que les mots de passe sont identiques
        if($nouveauMotDePasse == $nouveauMotDePasse2) {

            //On vérifie que l'ancien mot de passe est correct
            if(password_verify($ancienMotDePasse, $db->query('SELECT motDePasse FROM utilisateur WHERE id = ' . $utilisateur)->fetch_row()[0])) {

                //On met à jour le mot de passe
                if($req = $db->prepare('UPDATE utilisateur SET motDePasse = ? WHERE id = ?')) {
                    $req->bind_param('ss', password_hash($nouveauMotDePasse, PASSWORD_DEFAULT), $utilisateur);
                    $req->execute();
                    $req->close();
                    header('Location: update-infos.php?validation=motDePasse');
                } else {
                    header('Location: update-infos.php?erreur=erreurBDD');
                }
            } else {
                header('Location: update-infos.php?erreur=erreurAncienMotDePasse');
            }
        } else {
            header('Location: update-infos.php?erreur=erreurNouveauMotDePasse');
        }
    } else {
        header('Location: update-infos.php?erreur=erreurTaille');
    }
}

include 'close_bdd.php';
?>