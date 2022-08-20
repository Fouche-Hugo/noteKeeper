<?php
include 'bdd.php';
include 'fonctions.php';

session_start();

//On test si l'utilisateur est déja connecté
if(isset($_SESSION['utilisateur'])){
    header('Location: index.php');
}

//On test si tout à bien été envoyé
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['motDePasse']) && isset($_POST['motDePasseConfirm'])) {
    //enlever les caratères dangereux dans les données reçues par POST (nom, prenom, mail, motDePasse, motDePasseConfirm)
    $nom = valid_donnees($_POST['nom']);
    $prenom = valid_donnees($_POST['prenom']);
    $email = valid_donnees($_POST['mail']);
    $password = valid_donnees($_POST['motDePasse']);
    $passwordConfirm = valid_donnees($_POST['motDePasseConfirm']);

    //On vérifie que les tailles sont respectées
    if(strlen($password) >= 8 && strlen($password) <= 25 && strlen($nom) <= 25 && strlen($prenom) <= 25 && strlen($email) <= 50) {

        $password = password_hash($password, PASSWORD_DEFAULT);

        //On vérifie que l'adresse mail n'a pas déja été utilisée
        if($req = $db->prepare('SELECT COUNT(*) FROM utilisateur WHERE mail = ?')) {
            $req->bind_param('s', $email);
            $req->execute();
            $req->bind_result($count);
            $req->fetch();
            $req->close();

            if($count > 0) {
                header('Location: inscription.php?erreur=erreurMail&nom=' . $nom . '&prenom=' . $prenom);
            } else {
                //enregistrement de l'utilisateur dans la base de données
                if($req = $db->prepare('INSERT INTO utilisateur (nom, prenom, mail, motDePasse) VALUES (?, ?, ?, ?)')) {
                    $req->bind_param('ssss', $nom, $prenom, $email, $password);
                    $req->execute();
                    $req->close();
                    $_SESSION['utilisateur'] = $db->insert_id;
                    header('Location: index.php');
                } else {
                    header('Location: inscription.php?erreur=erreurBDD&nom=' . $nom . '&prenom=' . $prenom . '&mail=' . $email);
                }
            }
        } else {
            header('Location: inscription.php?erreur=erreurBDD&nom=' . $nom . '&prenom=' . $prenom . '&mail=' . $email);
        }
    } else {
        header('Location: inscription.php?erreur=erreurTaille&nom=' . $nom . '&prenom=' . $prenom . '&mail=' . $email);
    }
}

include 'close_bdd.php';
?>