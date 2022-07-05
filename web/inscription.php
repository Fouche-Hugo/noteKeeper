<?php
include 'php/inscription_gestion.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NoteKeeper - Inscription</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/style-light.css" id="style-mode">
    </head>
    <body>
        <?php include 'parts/header.php'; ?>

        <form action="inscription.php" method="post" class="form-connexion" @submit.prevent="submitInscription">
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

                <h1>Inscription</h1>
            </div>
            <div class="main-connexion">
                <?php
                if(isset($_GET['erreur']) && $_GET['erreur'] == 'erreurBDD') {
                ?>
                    <erreur-serveur message="Erreur lors de l'envoi des données d'inscription. Veuillez rééessayer."></erreur-serveur>
                <?php } else if(isset($_GET['erreur']) && $_GET['erreur'] == 'erreurTaille') {?>
                    <erreur-serveur message="Des données envoyées ne respectent pas les critères demandés."></erreur-serveur>
                <?php } else if(isset($_GET['erreur']) && $_GET['erreur'] == 'erreurMail') {?>
                    <erreur-serveur message="Le mail est déja utilisé"></erreur-serveur>
                <?php } ?>
                <div :class="{erreur: nom.length > 25}">
                    <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25 37.5H21.25C20.5872 37.4993 19.9517 37.2357 19.483 36.767C19.0143 36.2983 18.7507 35.6628 18.75
                        35V28.75H21.25V35H25V28.75H27.5V23.75C27.4997 23.4186 27.3679 23.1008 27.1335 22.8665C26.8992 22.6321 26.5814
                        22.5003 26.25 22.5H15.35L12.85 15H5C4.66858 15.0003 4.35083 15.1321 4.11648 15.3665C3.88213 15.6008 3.75033
                        15.9186 3.75 16.25V23.75H6.25V35H11.25V26.25H13.75V35C13.7493 35.6628 13.4857 36.2983 13.017 36.767C12.5483
                        37.2357 11.9128 37.4993 11.25 37.5H6.25C5.58716 37.4993 4.95166 37.2357 4.48296 36.767C4.01427 36.2983 3.75066
                        35.6628 3.75 35V26.25C3.08716 26.2493 2.45166 25.9857 1.98296 25.517C1.51427 25.0483 1.25066 24.4128 1.25 23.75V16.25C1.25099
                        15.2557 1.6464 14.3025 2.34945 13.5994C3.05249 12.8964 4.00574 12.501 5 12.5H12.85C13.3746 12.4997 13.8861 12.6646 14.3117
                        12.9713C14.7373 13.278 15.0556 13.711 15.2213 14.2088L17.15 20H26.25C27.2443 20.001 28.1975 20.3964 28.9006 21.0994C29.6036
                        21.8025 29.999 22.7557 30 23.75V28.75C29.9993 29.4128 29.7357 30.0483 29.267 30.517C28.7983 30.9857 28.1628 31.2493 27.5 31.25V35C27.4993
                        35.6628 27.2357 36.2983 26.767 36.767C26.2983 37.2357 25.6628 37.4993 25 37.5ZM35 37.5H32.5V23.75H36.25V16.25C36.2497 15.9186 36.1179 15.6008
                        35.8835 15.3665C35.6492 15.1321 35.3314 15.0003 35 15H30V12.5H35C35.9943 12.501 36.9475 12.8964 37.6506 13.5994C38.3536 14.3025 38.749 15.2557
                        38.75 16.25V23.75C38.7493 24.4128 38.4857 25.0483 38.017 25.517C37.5483 25.9857 36.9128 26.2493 36.25 26.25H35V37.5ZM8.75 11.25C7.76109 11.25
                        6.79439 10.9568 5.97215 10.4074C5.1499 9.85794 4.50904 9.07705 4.1306 8.16342C3.75216 7.24979 3.65315 6.24446 3.84607 5.27455C4.039 4.30465
                        4.5152 3.41373 5.21447 2.71447C5.91373 2.01521 6.80464 1.539 7.77455 1.34608C8.74445 1.15315 9.74979 1.25217 10.6634 1.6306C11.577 2.00904
                        12.3579 2.64991 12.9073 3.47215C13.4568 4.2944 13.75 5.2611 13.75 6.25C13.7483 7.57558 13.221 8.84639 12.2837 9.78371C11.3464 10.721 10.0756
                        11.2483 8.75 11.25ZM8.75 3.75C8.25555 3.75 7.7722 3.89662 7.36107 4.17133C6.94995 4.44603 6.62952 4.83648 6.4403 5.29329C6.25108 5.75011
                        6.20157 6.25278 6.29804 6.73773C6.3945 7.22268 6.6326 7.66814 6.98223 8.01777C7.33186 8.3674 7.77732 8.6055 8.26227 8.70197C8.74723 8.79843
                        9.24989 8.74892 9.70671 8.5597C10.1635 8.37048 10.554 8.05005 10.8287 7.63893C11.1034 7.2278 11.25 6.74446 11.25 6.25C11.2493 5.58716 10.9857
                        4.95166 10.517 4.48297C10.0483 4.01427 9.41284 3.75066 8.75 3.75ZM31.25 11.25C30.2611 11.25 29.2944 10.9568 28.4721 10.4074C27.6499 9.85794
                        27.009 9.07705 26.6306 8.16342C26.2522 7.24979 26.1531 6.24446 26.3461 5.27455C26.539 4.30465 27.0152 3.41373 27.7145 2.71447C28.4137 2.01521
                        29.3046 1.539 30.2745 1.34608C31.2445 1.15315 32.2498 1.25217 33.1634 1.6306C34.077 2.00904 34.8579 2.64991 35.4073 3.47215C35.9568 4.2944 36.25
                        5.2611 36.25 6.25C36.2483 7.57558 35.721 8.84639 34.7837 9.78371C33.8464 10.721 32.5756 11.2483 31.25 11.25ZM31.25 3.75C30.7555 3.75 30.2722 3.89662
                        29.8611 4.17133C29.45 4.44603 29.1295 4.83648 28.9403 5.29329C28.7511 5.75011 28.7016 6.25278 28.798 6.73773C28.8945 7.22268 29.1326 7.66814 29.4822
                        8.01777C29.8319 8.3674 30.2773 8.6055 30.7623 8.70197C31.2472 8.79843 31.7499 8.74892 32.2067 8.5597C32.6635 8.37048 33.054 8.05005 33.3287 7.63893C33.6034
                        7.2278 33.75 6.74446 33.75 6.25C33.7493 5.58716 33.4857 4.95166 33.017 4.48297C32.5483 4.01427 31.9128 3.75066 31.25 3.75Z" fill="#401B37"/>
                        <path d="M23.125 18.75C22.2597 18.75 21.4138 18.4934 20.6944 18.0127C19.9749 17.532 19.4142 16.8487 19.083 16.0492C18.7519 15.2498 18.6653 14.3701
                        18.8341 13.5215C19.0029 12.6728 19.4196 11.8933 20.0314 11.2814C20.6433 10.6696 21.4228 10.2529 22.2715 10.0841C23.1201 9.91526 23.9998 10.0019
                        24.7992 10.333C25.5987 10.6642 26.2819 11.2249 26.7627 11.9444C27.2434 12.6638 27.5 13.5097 27.5 14.375C27.4987 15.5349 27.0373 16.6469 26.2171
                        17.4671C25.3969 18.2873 24.2849 18.7487 23.125 18.75ZM23.125 12.5C22.7542 12.5 22.3917 12.61 22.0833 12.816C21.775 13.022 21.5346 13.3149 21.3927
                        13.6575C21.2508 14.0001 21.2137 14.3771 21.286 14.7408C21.3584 15.1045 21.537 15.4386 21.7992 15.7008C22.0614 15.9631 22.3955 16.1416 22.7592 16.214C23.1229
                        16.2863 23.4999 16.2492 23.8425 16.1073C24.1851 15.9654 24.478 15.725 24.684 15.4167C24.89 15.1084 25 14.7458 25 14.375C24.9993 13.8779 24.8016 13.4014 24.4501
                        13.0499C24.0986 12.6984 23.6221 12.5007 23.125 12.5Z" fill="#401B37"/>
                    </svg>
                    <input type="text" name="nom" id="nom" placeholder="Nom" required v-model="nom">
                    <span class="tooltip">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 0C6.71484 0 0 6.71484 0 15C0 23.2852 6.71484 30 15 30C23.2852 30 30 23.2852 30 15C30 6.71484 23.2852 0 15 0ZM15 23.4375C13.9453 23.4375 13.125
                            22.6172 13.125 21.5625C13.125 20.5078 13.8926 19.6875 15 19.6875C16.002 19.6875 16.875 20.5078 16.875 21.5625C16.875 22.6172 16.002 23.4375 15 23.4375ZM19.0488
                            15.1172L16.4062 16.7578V16.875C16.4062 17.6367 15.7617 18.2812 15 18.2812C14.2383 18.2812 13.5938 17.6367 13.5938 16.875V15.9375C13.5938 15.4688 13.8281 15
                            14.2969 14.707L17.6367 12.7148C18.0469 12.4805 18.2812 12.0703 18.2812 11.6016C18.2812 10.8984 17.6426 10.3125 16.9395 10.3125H13.9453C13.1895 10.3125 12.6562
                            10.8984 12.6562 11.6016C12.6562 12.3633 12.0117 13.0078 11.25 13.0078C10.4883 13.0078 9.84375 12.3633 9.84375 11.6016C9.84375 9.31641 11.6602 7.5 13.8926
                            7.5H16.8867C19.2773 7.5 21.0938 9.31641 21.0938 11.6016C21.0938 13.0078 20.332 14.3555 19.0488 15.1172Z" fill="black"/>
                        </svg>
                        <span class="tooltip-text">Le nom dépasse 25 caractères</span>
                    </span>
                </div>
                <div :class="{erreur: prenom.length > 25}">
                    <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.4815 24.4615C25.2369 24.3815 23.6907 23.6846 24.6569 20.7477H24.643C27.1615 18.1539 29.0861 13.98 29.0861 9.87077C29.0861 3.55231 24.8846
                        0.240005 20.0015 0.240005C15.1154 0.240005 10.9369 3.55077 10.9369 9.87077C10.9369 13.9969 12.8507 18.1877 15.3846 20.7754C16.3723 23.3662 14.6061 24.3277
                        14.2369 24.4631C9.12305 26.3123 3.12305 29.6831 3.12305 33.0108V34.2585C3.12305 38.7923 11.9138 39.8231 20.0492 39.8231C28.1969 39.8231 36.8769 38.7923 36.8769
                        34.2585V33.0108C36.8769 29.5831 30.8477 26.2385 25.4815 24.4615Z" fill="#401B37"/>
                    </svg>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom" required v-model="prenom">
                    <span class="tooltip">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 0C6.71484 0 0 6.71484 0 15C0 23.2852 6.71484 30 15 30C23.2852 30 30 23.2852 30 15C30 6.71484 23.2852 0 15 0ZM15 23.4375C13.9453 23.4375 13.125
                            22.6172 13.125 21.5625C13.125 20.5078 13.8926 19.6875 15 19.6875C16.002 19.6875 16.875 20.5078 16.875 21.5625C16.875 22.6172 16.002 23.4375 15 23.4375ZM19.0488
                            15.1172L16.4062 16.7578V16.875C16.4062 17.6367 15.7617 18.2812 15 18.2812C14.2383 18.2812 13.5938 17.6367 13.5938 16.875V15.9375C13.5938 15.4688 13.8281 15
                            14.2969 14.707L17.6367 12.7148C18.0469 12.4805 18.2812 12.0703 18.2812 11.6016C18.2812 10.8984 17.6426 10.3125 16.9395 10.3125H13.9453C13.1895 10.3125 12.6562
                            10.8984 12.6562 11.6016C12.6562 12.3633 12.0117 13.0078 11.25 13.0078C10.4883 13.0078 9.84375 12.3633 9.84375 11.6016C9.84375 9.31641 11.6602 7.5 13.8926
                            7.5H16.8867C19.2773 7.5 21.0938 9.31641 21.0938 11.6016C21.0938 13.0078 20.332 14.3555 19.0488 15.1172Z" fill="black"/>
                        </svg>
                        <span class="tooltip-text">Le prénom dépasse 25 caractères</span>
                    </span>
                </div>
                <div :class="{erreur: email.length > 25 || (!verificationAdresseMail() && email.length > 0)}">
                    <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M33.3333 13.3333L19.9999 21.6667L6.66659 13.3333V10L19.9999 18.3333L33.3333 10M33.3333 6.66666H6.66659C4.81659 6.66666 3.33325 8.15 3.33325
                        10V30C3.33325 30.8841 3.68444 31.7319 4.30956 32.357C4.93468 32.9821 5.78253 33.3333 6.66659 33.3333H33.3333C34.2173 33.3333 35.0652 32.9821 35.6903
                        32.357C36.3154 31.7319 36.6666 30.8841 36.6666 30V10C36.6666 9.11594 36.3154 8.2681 35.6903 7.64297C35.0652 7.01785 34.2173 6.66666 33.3333 6.66666Z" fill="#401B37"/>
                    </svg>
                    <input type="email" name="mail" id="mail" placeholder="Adresse mail" required v-model="email">
                    <span class="tooltip">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 0C6.71484 0 0 6.71484 0 15C0 23.2852 6.71484 30 15 30C23.2852 30 30 23.2852 30 15C30 6.71484 23.2852 0 15 0ZM15 23.4375C13.9453 23.4375 13.125
                            22.6172 13.125 21.5625C13.125 20.5078 13.8926 19.6875 15 19.6875C16.002 19.6875 16.875 20.5078 16.875 21.5625C16.875 22.6172 16.002 23.4375 15 23.4375ZM19.0488
                            15.1172L16.4062 16.7578V16.875C16.4062 17.6367 15.7617 18.2812 15 18.2812C14.2383 18.2812 13.5938 17.6367 13.5938 16.875V15.9375C13.5938 15.4688 13.8281 15
                            14.2969 14.707L17.6367 12.7148C18.0469 12.4805 18.2812 12.0703 18.2812 11.6016C18.2812 10.8984 17.6426 10.3125 16.9395 10.3125H13.9453C13.1895 10.3125 12.6562
                            10.8984 12.6562 11.6016C12.6562 12.3633 12.0117 13.0078 11.25 13.0078C10.4883 13.0078 9.84375 12.3633 9.84375 11.6016C9.84375 9.31641 11.6602 7.5 13.8926
                            7.5H16.8867C19.2773 7.5 21.0938 9.31641 21.0938 11.6016C21.0938 13.0078 20.332 14.3555 19.0488 15.1172Z" fill="black"/>
                        </svg>
                        <span class="tooltip-text" v-if="email.length > 25 && !verificationAdresseMail()">L'adresse email dépasse 25 caractères<br>L'adresse email n'est pas valide</span>
                        <span class="tooltip-text" v-else-if="email.length > 25">L'adresse email dépasse 25 caractères</span>
                        <span class="tooltip-text" v-else>L'adresse email n'est pas valide</span>
                    </span>
                </div>
                <div :class="{erreur: password.length > 25 || (password.length < 8 && password.length > 0)}">
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
                    <input type="password" name="motDePasse" id="mot-de-passe" placeholder="Mot de passe" required v-model="password">
                    <span class="tooltip">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 0C6.71484 0 0 6.71484 0 15C0 23.2852 6.71484 30 15 30C23.2852 30 30 23.2852 30 15C30 6.71484 23.2852 0 15 0ZM15 23.4375C13.9453 23.4375 13.125
                            22.6172 13.125 21.5625C13.125 20.5078 13.8926 19.6875 15 19.6875C16.002 19.6875 16.875 20.5078 16.875 21.5625C16.875 22.6172 16.002 23.4375 15 23.4375ZM19.0488
                            15.1172L16.4062 16.7578V16.875C16.4062 17.6367 15.7617 18.2812 15 18.2812C14.2383 18.2812 13.5938 17.6367 13.5938 16.875V15.9375C13.5938 15.4688 13.8281 15
                            14.2969 14.707L17.6367 12.7148C18.0469 12.4805 18.2812 12.0703 18.2812 11.6016C18.2812 10.8984 17.6426 10.3125 16.9395 10.3125H13.9453C13.1895 10.3125 12.6562
                            10.8984 12.6562 11.6016C12.6562 12.3633 12.0117 13.0078 11.25 13.0078C10.4883 13.0078 9.84375 12.3633 9.84375 11.6016C9.84375 9.31641 11.6602 7.5 13.8926
                            7.5H16.8867C19.2773 7.5 21.0938 9.31641 21.0938 11.6016C21.0938 13.0078 20.332 14.3555 19.0488 15.1172Z" fill="black"/>
                        </svg>
                        <span class="tooltip-text" v-if="password.length > 25">Le mot de passe dépasse 25 caractères</span>
                        <span class="tooltip-text" v-else>Le mot de passe fait moins de 8 caractères</span>
                    </span>
                </div>
                <div :class="{erreur: passwordConfirm.length > 0 && passwordConfirm != password}">
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
                    <input type="password" name="motDePasseConfirm" id="mot-de-passe-confirm" placeholder="Vérification mot de passe" required v-model="passwordConfirm">
                    <span class="tooltip">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 0C6.71484 0 0 6.71484 0 15C0 23.2852 6.71484 30 15 30C23.2852 30 30 23.2852 30 15C30 6.71484 23.2852 0 15 0ZM15 23.4375C13.9453 23.4375 13.125
                            22.6172 13.125 21.5625C13.125 20.5078 13.8926 19.6875 15 19.6875C16.002 19.6875 16.875 20.5078 16.875 21.5625C16.875 22.6172 16.002 23.4375 15 23.4375ZM19.0488
                            15.1172L16.4062 16.7578V16.875C16.4062 17.6367 15.7617 18.2812 15 18.2812C14.2383 18.2812 13.5938 17.6367 13.5938 16.875V15.9375C13.5938 15.4688 13.8281 15
                            14.2969 14.707L17.6367 12.7148C18.0469 12.4805 18.2812 12.0703 18.2812 11.6016C18.2812 10.8984 17.6426 10.3125 16.9395 10.3125H13.9453C13.1895 10.3125 12.6562
                            10.8984 12.6562 11.6016C12.6562 12.3633 12.0117 13.0078 11.25 13.0078C10.4883 13.0078 9.84375 12.3633 9.84375 11.6016C9.84375 9.31641 11.6602 7.5 13.8926
                            7.5H16.8867C19.2773 7.5 21.0938 9.31641 21.0938 11.6016C21.0938 13.0078 20.332 14.3555 19.0488 15.1172Z" fill="black"/>
                        </svg>
                        <span class="tooltip-text">Les mots de passe ne sont pas identiques</span>
                    </span>
                </div>
                <button type="submit" class="bouton-connexion" name="inscription-submit">S'inscrire</button>
            </div>
            <div class="footer-connexion">
                <p>Déjà inscrit ?</p>
                <a href="connexion.php" class="bouton-connexion">Je me connecte</a>
            </div>
        </form>
        
        <script src="https://unpkg.com/vue@3"></script>
        <script src="js/script-inscription.js"></script>
    </body>
</html>