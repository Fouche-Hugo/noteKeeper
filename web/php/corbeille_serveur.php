<?php
include 'bdd.php';
include 'fonctions.php';
session_start();

//On vérifie que l'utilisateur est connecté
if(isset($_SESSION['utilisateur'])) {
    //On test si une note doit être restaurée
    if(isset($_POST['restoreNote']) && $_POST['restoreNote'] == 1) {
        //On vérifie que la date de création de la note a bien été envoyée
        if(!empty($_POST['dateCreation'])) {
            //On récupère la date de création de la note
            $dateCreation = valid_donnees($_POST['dateCreation']);
            
            //On restaure la note dans la base de données
            if($req = $db->prepare('UPDATE note SET etat = "NORMAL" WHERE dateCreation = ? AND utilisateur = ?')) {
                $req->bind_param('si', $dateCreation, $_SESSION['utilisateur']);
                $req->execute();
                $req->close();

                echo json_encode(['status' => 'sucess']);
            } else {
                echo json_encode(['status' => 'erreurBDD']);
            }
        } else {
            echo json_encode(['status' => 'erreurDateCreation']);
        }
    } else if(isset($_POST['listeNotes']) && $_POST['listeNotes'] == 1) {
        //sinon on teste s'il veut accéder à sa liste de notes
        if($req = $db->prepare('SELECT n.titre, n.texte, n.etat, n.dateCreation, n.dateModification, cf.code, ct.code FROM note n, couleur cf, couleur ct WHERE n.utilisateur = ? AND cf.id = n.couleurFond AND ct.id = n.couleurTexte AND n.etat = "SUPPRIME" ORDER BY n.dateModification DESC')) {
            $req->bind_param('i', $_SESSION['utilisateur']);
            $req->execute();
            $req->store_result();
            $req->bind_result($titre, $texte, $etat, $dateCreation, $dateModification, $couleurFond, $couleurTexte);
            $notes = [];
            while($req->fetch()) {
                $notes[] = ['titre' => $titre, 'texte' => $texte, 'etat' => $etat, 'dateCreation' => $dateCreation, 'dateModification' => $dateModification, 'couleurFond' => $couleurFond, 'couleurTexte' => $couleurTexte];
            }
            $req->close();
            echo json_encode(['status' => 'sucess', 'notes' => $notes]);
        } else {
            echo json_encode(['status' => 'erreurBDD']);
        }
    } else {
        echo json_encode(['status' => 'erreurParametres']);
    }
}

?>