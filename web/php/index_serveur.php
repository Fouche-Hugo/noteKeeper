<?php
include 'bdd.php';
include 'fonctions.php';
session_start();

//On vérifie que l'utilisateur est bien connecté
if(isset($_SESSION['utilisateur'])) {
    //on teste si une nouvelle note a été envoyée
    if(isset($_POST['nouvelleNote']) && $_POST['nouvelleNote'] == 1) {
        //On vérifie que le titre a bien été envoyé
        if(!empty($_POST['titre'])) {
            //On enlève les caractères dangereux dans les données reçues par POST (titre)
            $titre = valid_donnees($_POST['titre']);
            //On vérifie que le texte a bien été envoyé
            if(isset($_POST['texte'])) {
                //On enlève les caractères dangereux dans les données reçues par POST (texte)
                $texte = valid_donnees($_POST['texte']);
                //On vérifie que l'état a bien été envoyé
                if(!empty($_POST['etat'])) {
                    //On enlève les caractères dangereux dans les données reçues par POST (état)
                    $etat = valid_donnees($_POST['etat']);
                    //On vérifie que la couleur de fond a bien été envoyée
                    if(!empty($_POST['couleurFond'])) {
                        //On enlève les caractères dangereux dans les données reçues par POST (couleurFond)
                        $couleurFond = valid_donnees($_POST['couleurFond']);
                        //On vérifie que la couleur du texte a bien été envoyée
                        if(isset($_POST['couleurTexte'])) {
                            //On enlève les caractères dangereux dans les données reçues par POST (couleurTexte)
                            $couleurTexte = valid_donnees($_POST['couleurTexte']);

                            //On vérifie que la date de création a bien été envoyée
                            if(!empty($_POST['date'])) {
                                //On enlève les caractères dangereux dans les données reçues par POST (date)
                                $date = valid_donnees($_POST['date']);

                                $idCouleurFond = 0;
                                $idCouleurTexte = 0;
                                //On vérifie si la couleur de fond existe dans la base de données
                                if($req = $db->prepare('SELECT * FROM couleur WHERE code = ?')) {
                                    $req->bind_param('s', $couleurFond);
                                    $req->execute();
                                    $req->store_result();
                                    $req->bind_result($id, $couleur);
                                    $req->fetch();
                                    //Si la couleur de fond n'existe pas, on l'ajoute
                                    if($req->num_rows == 0) {
                                        if($req2 = $db->prepare('INSERT INTO couleur (code) VALUES (?)')) {
                                            $req2->bind_param('s', $couleurFond);
                                            $req2->execute();
                                            $req2->close();
                                            $idCouleurFond = $db->insert_id;
                                        } else {
                                            echo json_encode(['status' => 'erreurBDD-couleurFond']);
                                        }
                                    } else {
                                        //sinon, on récupère l'id de la couleur de fond
                                        $idCouleurFond = $id;
                                    }
                                    $req->close();
                                } else {
                                    echo json_encode(['status' => 'erreurBDD-couleurFond2']);
                                }
                                //On vérifie si la couleur du texte existe dans la base de données
                                if($req = $db->prepare('SELECT * FROM couleur WHERE code = ?')) {
                                    $req->bind_param('s', $couleurTexte);
                                    $req->execute();
                                    $req->store_result();
                                    $req->bind_result($id, $couleur);
                                    $req->fetch();
                                    //Si la couleur du texte n'existe pas, on l'ajoute
                                    if($req->num_rows == 0) {
                                        if($req2 = $db->prepare('INSERT INTO couleur (code) VALUES (?)')) {
                                            $req2->bind_param('s', $couleurTexte);
                                            $req2->execute();
                                            $req2->close();
                                            $idCouleurTexte = $db->insert_id;
                                        } else {
                                            echo json_encode(['status' => 'erreurBDD-couleurTexte']);
                                        }
                                    } else {
                                        //sinon, on récupère l'id de la couleur du texte
                                        $idCouleurTexte = $id;
                                    }
                                    $req->close();
                                } else {
                                    echo json_encode(['status' => 'erreurBDD-couleurTexte2']);
                                }

                                //On enregistre la note dans la base de données
                                if($req = $db->prepare('INSERT INTO note (titre, texte, etat, couleurFond, couleurTexte, utilisateur, dateCreation, dateModification) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')) {
                                    $req->bind_param('sssiiiss', $titre, $texte, $etat, $idCouleurFond, $idCouleurTexte, $_SESSION['utilisateur'], $date, $date);
                                    $req->execute();
                                    $req->close();
                                    $idNote = $db->insert_id;
                                    echo json_encode(['status' => 'sucess', 'idNote' => $idNote]);
                                } else {
                                    echo json_encode(['status' => 'erreurBDD', 'titre' => $titre, 'texte' => $texte, 'etat' => $etat, 'couleurFond' => $couleurFond, 'couleurTexte' => $couleurTexte, 'utilisateur' => $_SESSION['utilisateur']]);
                                }
                            } else {
                                echo json_encode(['status' => 'erreurDate']);
                            }
                        } else {
                            echo json_encode(['status' => 'erreurCouleurTexte']);
                        }
                    } else {
                        echo json_encode(['status' => 'erreurCouleurFond']);
                    }
                } else {
                    echo json_encode(['status' => 'erreurEtat']);
                }
            } else {
                echo json_encode(['status' => 'erreurTexte']);
            }
        } else {
            echo json_encode(['status' => 'erreurTitre']);
        }
    } else if(isset($_POST['listeNotes']) && $_POST['listeNotes'] == 1) {
        //sinon on teste s'il veut accéder à sa liste de notes
        if($req = $db->prepare('SELECT n.titre, n.texte, n.etat, n.dateCreation, n.dateModification, cf.code, ct.code FROM note n, couleur cf, couleur ct WHERE n.utilisateur = ? AND cf.id = n.couleurFond AND ct.id = n.couleurTexte AND (n.etat = "NORMAL" OR n.etat = "EPINGLE") ORDER BY n.etat, n.dateModification DESC')) {
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
    } else if(isset($_POST['majNote']) && $_POST['majNote'] == 1) {
        if(!empty($_POST['couleurFond']) && !empty($_POST['dateCreation']) && !empty($_POST['dateModification'])) {
            $couleurFond = valid_donnees($_POST['couleurFond']);
            $dateCreation = valid_donnees($_POST['dateCreation']);
            $dateModification = valid_donnees($_POST['dateModification']);
            
            $idCouleurFond = 0;
            //On vérifie si la couleur de fond existe dans la base de données
            if($req = $db->prepare('SELECT * FROM couleur WHERE code = ?')) {
                $req->bind_param('s', $couleurFond);
                $req->execute();
                $req->store_result();
                $req->bind_result($id, $couleur);
                $req->fetch();
                //Si la couleur de fond n'existe pas, on l'ajoute
                if($req->num_rows == 0) {
                    if($req2 = $db->prepare('INSERT INTO couleur (code) VALUES (?)')) {
                        $req2->bind_param('s', $couleurFond);
                        $req2->execute();
                        $req2->close();
                        $idCouleurFond = $db->insert_id;
                    } else {
                        echo json_encode(['status' => 'erreurBDD-couleurFond']);
                    }
                } else {
                    //sinon, on récupère l'id de la couleur de fond
                    $idCouleurFond = $id;
                }
                $req->close();

                //On met à jour la note dans la base de données
                if($req = $db->prepare('UPDATE note SET couleurFond = ?, dateModification = ? WHERE dateCreation = ? AND utilisateur = ?')) {
                    $req->bind_param('issi', $idCouleurFond, $dateModification, $dateCreation, $_SESSION['utilisateur']);
                    $req->execute();
                    $req->close();
                    echo json_encode(['status' => 'sucess']);
                } else {
                    echo json_encode(['status' => 'erreurBDD']);
                }
            } else {
                echo json_encode(['status' => 'erreurBDD-couleurFond2']);
            }
        } else if(!empty($_POST['couleurTexte']) && !empty($_POST['dateCreation']) && !empty($_POST['dateModification'])) {
            $couleurTexte = valid_donnees($_POST['couleurTexte']);
            $dateCreation = valid_donnees($_POST['dateCreation']);
            $dateModification = valid_donnees($_POST['dateModification']);
            
            $idCouleurTexte = 0;
            //On vérifie si la couleur de texte existe dans la base de données
            if($req = $db->prepare('SELECT * FROM couleur WHERE code = ?')) {
                $req->bind_param('s', $couleurTexte);
                $req->execute();
                $req->store_result();
                $req->bind_result($id, $couleur);
                $req->fetch();
                //Si la couleur de texte n'existe pas, on l'ajoute
                if($req->num_rows == 0) {
                    if($req2 = $db->prepare('INSERT INTO couleur (code) VALUES (?)')) {
                        $req2->bind_param('s', $couleurTexte);
                        $req2->execute();
                        $req2->close();
                        $idCouleurTexte = $db->insert_id;
                    } else {
                        echo json_encode(['status' => 'erreurBDD-couleurTexte']);
                    }
                } else {
                    //sinon, on récupère l'id de la couleur de texte
                    $idCouleurTexte = $id;
                }
                $req->close();
                //On met à jour la note dans la base de données
                if($req = $db->prepare('UPDATE note SET couleurTexte = ?, dateModification = ? WHERE dateCreation = ? AND utilisateur = ?')) {
                    $req->bind_param('issi', $idCouleurTexte, $dateModification, $dateCreation, $_SESSION['utilisateur']);
                    $req->execute();
                    $req->close();
                    echo json_encode(['status' => 'sucess']);
                } else {
                    echo json_encode(['status' => 'erreurBDD']);
                }
            } else {
                echo json_encode(['status' => 'erreurBDD-couleurTexte2']);
            }
        } else if(!empty($_POST['etat']) && !empty($_POST['dateCreation']) && !empty($_POST['dateModification'])) {
            $etat = valid_donnees($_POST['etat']);
            $dateCreation = valid_donnees($_POST['dateCreation']);
            $dateModification = valid_donnees($_POST['dateModification']);
            
            //On met à jour la note dans la base de données
            if($req = $db->prepare('UPDATE note SET etat = ?, dateModification = ? WHERE dateCreation = ? AND utilisateur = ?')) {
                $req->bind_param('sssi', $etat, $dateModification, $dateCreation, $_SESSION['utilisateur']);
                $req->execute();
                $req->close();
                echo json_encode(['status' => 'sucess']);
            } else {
                echo json_encode(['status' => 'erreurBDD']);
            }
        } else if(!empty($_POST['titre']) && !empty($_POST['dateCreation']) && !empty($_POST['dateModification'])) {
            $titre = valid_donnees($_POST['titre']);
            $dateCreation = valid_donnees($_POST['dateCreation']);
            $dateModification = valid_donnees($_POST['dateModification']);
            
            //On met à jour la note dans la base de données
            if($req = $db->prepare('UPDATE note SET titre = ?, dateModification = ? WHERE dateCreation = ? AND utilisateur = ?')) {
                $req->bind_param('sssi', $titre, $dateModification, $dateCreation, $_SESSION['utilisateur']);
                $req->execute();
                $req->close();
                echo json_encode(['status' => 'sucess']);
            } else {
                echo json_encode(['status' => 'erreurBDD']);
            }
        } else if(!empty($_POST['texte']) && !empty($_POST['dateCreation']) && !empty($_POST['dateModification'])) {
            $texte = valid_donnees($_POST['texte']);
            $dateCreation = valid_donnees($_POST['dateCreation']);
            $dateModification = valid_donnees($_POST['dateModification']);
            
            //On met à jour la note dans la base de données
            if($req = $db->prepare('UPDATE note SET texte = ?, dateModification = ? WHERE dateCreation = ? AND utilisateur = ?')) {
                $req->bind_param('sssi', $texte, $dateModification, $dateCreation, $_SESSION['utilisateur']);
                $req->execute();
                $req->close();
                echo json_encode(['status' => 'sucess']);
            } else {
                echo json_encode(['status' => 'erreurBDD']);
            }
        } else {
            echo json_encode(['status' => 'erreurDonnees']);
        }
    } else if(isset($_POST['deleteNote']) && $_POST['deleteNote'] == 1 && !empty($_POST['dateCreation'])) {
        $dateCreation = valid_donnees($_POST['dateCreation']);
        
        //On supprime la note dans la base de données
        if($req = $db->prepare('UPDATE note SET etat = "SUPPRIME" WHERE dateCreation = ? AND utilisateur = ?')) {
            $req->bind_param('si', $dateCreation, $_SESSION['utilisateur']);
            $req->execute();
            $req->close();
            echo json_encode(['status' => 'sucess']);
        } else {
            echo json_encode(['status' => 'erreurBDD']);
        }
    } else {
        echo json_encode(['status' => 'erreurDonnees']);
    }
} else {
    echo json_encode(['status' => 'erreurUser']);
}
?>