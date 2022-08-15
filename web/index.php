<?php
include 'php/index_gestion.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NoteKeeper</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style-index-light.css" id="style-mode">
</head>

<body>
    <?php include 'parts/header.php';?>
    <note-creation :mode="mode" @save-note="(infos) => {notes.push(infos)}"></note-creation>
    <div class="note-container">
        <note v-for="note in notes" :titre="note.titre" :texte="note.texte" :etat="note.etat" :date-creation="note.dateCreation" :date-modification="note.dateModification"
            :couleur-fond="note.couleurFond" :couleur-texte="note.couleurTexte" :mode="mode" @update-background-color="(color) => {note.couleurFond = color}"
            @update-text-color="(color) => {note.couleurTexte = color}" @update-titre="(titre) => {note.titre = titre}" @update-texte="(texte) => {note.texte = texte}"
            @update-date-modification="(date) => {note.dateModification = date}" @delete-note="() => {index = notes.indexOf(note);notes.splice(index, 1);}"></note>
    </div>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="js/script-index.js"></script>
</body>

</html>