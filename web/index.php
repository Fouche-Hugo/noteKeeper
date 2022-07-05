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
            <link rel="stylesheet" href="css/style-header-light.css" id="style-mode">
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <?php echo $_SESSION['utilisateur']; ?>
        <script src="https://unpkg.com/vue@3"></script>
        <script src="js/script-index.js"></script>
    </body>
</html>