<?php
include 'bdd.php';
include 'fonctions.php';
session_start();
//On vérifie que l'utilisateur est bien connecté
if(isset($_SESSION['utilisateur'])){
    //Vérification pour le nouveau nom
    //On vérifie que le nom a bien été envoyé
    if(!empty($_POST['nom'])) {
        //On enlève les caractères dangereux dans les données reçues par POST (nom)
        $nom = valid_donnees($_POST['nom']);
        if($req = $db->prepare('UPDATE utilisateur SET nom = ? WHERE id = ?')) {
            $req->bind_param('ss', $nom, $_SESSION['utilisateur']);
            $req->execute();
            $req->close();
            echo json_encode(['status' => 'sucess']);
        } else {
            echo json_encode(['status' => 'erreurBDD']);
        }
    }
    //Vérification pour le nouveau prénom
    //On vérifie que le prénom a bien été envoyé
    else if(!empty($_POST['prenom'])) {
        //On enlève les caractères dangereux dans les données reçues par POST (prénom)
        $prenom = valid_donnees($_POST['prenom']);
        if($req = $db->prepare('UPDATE utilisateur SET prenom = ? WHERE id = ?')) {
            $req->bind_param('ss', $prenom, $_SESSION['utilisateur']);
            $req->execute();
            $req->close();
            echo json_encode(['status' => 'sucess']);
        } else {
            echo json_encode(['status' => 'erreurBDD']);
        }
    }
    //Vérification pour le nouveau mail
    //On vérifie que le mail a bien été envoyé
    else if(!empty($_POST['mail'])) {
        //On enlève les caractères dangereux dans les données reçues par POST (mail)
        $mail = valid_donnees($_POST['mail']);
        if($req = $db->prepare('UPDATE utilisateur SET mail = ? WHERE id = ?')) {
            $req->bind_param('ss', $mail, $_SESSION['utilisateur']);
            $req->execute();
            $req->close();
            echo json_encode(['status' => 'sucess']);
        } else {
            echo json_encode(['status' => 'erreurBDD']);
        }
    }
}
include 'close_bdd.php';
?>