<?php
//On récupère les infos de l'utilisateur
$utilisateur = $_SESSION['utilisateur'];

if($req = $db->prepare('SELECT nom, prenom, mail FROM utilisateur WHERE id = ?')) {
    $req->bind_param('s', $utilisateur);
    $req->execute();
    $req->bind_result($nom, $prenom, $mail);
    $req->fetch();
    $req->close();
} else {
    header('Location: connexion.php?erreur=erreurBDD');
}
?>