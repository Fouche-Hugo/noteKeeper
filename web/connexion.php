<?php
include 'php/connexion_gestion.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Add the favicon-->
        <link rel="shortcut icon" href="favicon.ico" type="image/ico">
        <title>NoteKeeper - Connexion</title>
        <link rel="stylesheet" href="css/style-light.css" id="style-mode">
    </head>
    <body>
        <?php include 'parts/header.php'; ?>

        <form action="connexion.php" method="post" class="form-connexion">
            <div class="header-connexion">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30 48C23.75 48 18.225 44.8 15 40C15.075 35 25 32.25 30 32.25C35 32.25 44.925 35 45 40C43.3472 42.461 41.1146
                    44.4779 38.4989 45.8729C35.8832 47.268 32.9645 47.9985 30 48ZM30 12.5C31.9891 12.5 33.8968 13.2902 35.3033 14.6967C36.7098
                    16.1032 37.5 18.0109 37.5 20C37.5 21.9891 36.7098 23.8968 35.3033 25.3033C33.8968 26.7098 31.9891 27.5 30 27.5C28.0109 27.5
                    26.1032 26.7098 24.6967 25.3033C23.2902 23.8968 22.5 21.9891 22.5 20C22.5 18.0109 23.2902 16.1032 24.6967 14.6967C26.1032 13.2902
                    28.0109 12.5 30 12.5ZM30 5C26.717 5 23.4661 5.64664 20.4329 6.90301C17.3998 8.15938 14.6438 10.0009 12.3223 12.3223C7.63392 17.0107
                    5 23.3696 5 30C5 36.6304 7.63392 42.9893 12.3223 47.6777C14.6438 49.9991 17.3998 51.8406 20.4329 53.097C23.4661 54.3534 26.717 55 30
                    55C36.6304 55 42.9893 52.3661 47.6777 47.6777C52.3661 42.9893 55 36.6304 55 30C55 16.175 43.75 5 30 5Z" fill="#401B37"/>
                </svg>

                <h1>Connexion</h1>
            </div>
            <div class="main-connexion">
                <?php
                if(isset($_GET['erreur']) && $_GET['erreur'] == 'erreurMDP') {
                ?>
                    <erreur-serveur message="Mauvais mot de passe. Veuillez réessayer."></erreur-serveur>
                <?php } else if(isset($_GET['erreur']) && $_GET['erreur'] == 'erreurBDD') {?>
                    <erreur-serveur message="Impossible de se connecter. Veuillez réessayer plus tard"></erreur-serveur>
                <?php }?>
                <div>
                    <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M33.3333 13.3333L19.9999 21.6667L6.66659 13.3333V10L19.9999 18.3333L33.3333 10M33.3333 6.66666H6.66659C4.81659 6.66666 3.33325 8.15 3.33325
                        10V30C3.33325 30.8841 3.68444 31.7319 4.30956 32.357C4.93468 32.9821 5.78253 33.3333 6.66659 33.3333H33.3333C34.2173 33.3333 35.0652 32.9821 35.6903
                        32.357C36.3154 31.7319 36.6666 30.8841 36.6666 30V10C36.6666 9.11594 36.3154 8.2681 35.6903 7.64297C35.0652 7.01785 34.2173 6.66666 33.3333 6.66666Z" fill="#401B37"/>
                    </svg>
                    <input type="email" name="mail" id="mail" placeholder="Adresse mail" <?php if(isset($_GET['mail'])) echo 'value="'.$_GET['mail'].'"';?> required></div>
                <div>
                    <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.0001 28.3333C20.8841 28.3333 21.732 27.9821 22.3571 27.357C22.9822 26.7319 23.3334 25.8841 23.3334 25C23.3334 24.1159 22.9822 23.2681 22.3571
                        22.643C21.732 22.0179 20.8841 21.6667 20.0001 21.6667C19.116 21.6667 18.2682 22.0179 17.6431 22.643C17.0179 23.2681 16.6667 24.1159 16.6667 25C16.6667 25.8841
                        17.0179 26.7319 17.6431 27.357C18.2682 27.9821 19.116 28.3333 20.0001 28.3333ZM30.0001 13.3333C30.8841 13.3333 31.732 13.6845 32.3571 14.3096C32.9822 14.9348
                        33.3334 15.7826 33.3334 16.6667V33.3333C33.3334 34.2174 32.9822 35.0652 32.3571 35.6904C31.732 36.3155 30.8841 36.6667 30.0001 36.6667H10.0001C9.11603 36.6667
                        8.26818 36.3155 7.64306 35.6904C7.01794 35.0652 6.66675 34.2174 6.66675 33.3333V16.6667C6.66675 15.7826 7.01794 14.9348 7.64306 14.3096C8.26818 13.6845 9.11603
                        13.3333 10.0001 13.3333H11.6667V10C11.6667 7.78986 12.5447 5.67025 14.1075 4.10744C15.6703 2.54464 17.7899 1.66667 20.0001 1.66667C21.0944 1.66667 22.1781 1.88221
                        23.1891 2.301C24.2002 2.71979 25.1188 3.33362 25.8926 4.10744C26.6665 4.88126 27.2803 5.79992 27.6991 6.81097C28.1179 7.82202 28.3334 8.90565 28.3334
                        10V13.3333H30.0001ZM20.0001 5C18.674 5 17.4022 5.52678 16.4645 6.46447C15.5269 7.40215 15.0001 8.67392 15.0001 10V13.3333H25.0001V10C25.0001 8.67392 24.4733
                        7.40215 23.5356 6.46447C22.5979 5.52678 21.3262 5 20.0001 5Z" fill="#401B37"/>
                    </svg>
                    <input type="password" name="motDePasse" id="mot-de-passe" placeholder="Mot de passe" required></div>
                <button type="submit" class="bouton-connexion">Se connecter</button>
            </div>
            <div class="footer-connexion">
                <p>Pas encore inscrit ?</p>
                <a href="inscription.php" class="bouton-connexion">Je m'inscris</a>
            </div>
        </form>
        
        <script src="https://unpkg.com/vue@3"></script>
        <script src="js/script-connexion.js"></script>
    </body>
</html>