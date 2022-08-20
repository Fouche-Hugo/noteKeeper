<?php
include 'php/corbeille_gestion.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NoteKeeper - Corbeille</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style-corbeille-light.css" id="style-mode">
</head>

<body>
    <?php include 'parts/header.php';?>
    <div class="note-container">
        <note-corbeille v-for="note in notes" :titre="note.titre" :texte="note.texte" :etat="note.etat" :date-creation="note.dateCreation" :date-modification="note.dateModification"
            :couleur-fond="note.couleurFond" :couleur-texte="note.couleurTexte" :mode="mode" @restore-note="() => {index = notes.indexOf(note);notes.splice(index, 1);}"></note-corbeille>
    </div>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="js/script-corbeille.js"></script>
</body>

</html>