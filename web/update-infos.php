<?php
include 'php/update-infos_gestion.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>NoteKeeper - Mettre à jour ses informations</title>
            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="css/style-light.css" id="style-mode">
            <link rel="stylesheet" href="css/update-infos-light.scss" id="style-mode2">
    </head>
    <body>
        <?php include 'parts/header.php'; ?>
        <main class="update-infos-main">
            <form class="update-infos-form">
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
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="30" height="30" fill="#FCFCFF"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.80605 14.594C3.80605 20.682 8.22005 24.83 13.178 25.688C13.3129 25.7114 13.4419 25.7611 13.5575
                    25.8343C13.6732 25.9075 13.7733 26.0028 13.8521 26.1147C13.9309 26.2266 13.987 26.3529 14.017 26.4864C14.047 26.62 14.0504 26.7581 14.027 26.893C14.0037
                    27.0279 13.954 27.1568 13.8808 27.2725C13.8075 27.3881 13.7123 27.4882 13.6004 27.5671C13.4885 27.6459 13.3622 27.7019 13.2286 27.7319C13.0951 27.762 12.9569
                    27.7654 12.822 27.742C7.00005 26.734 1.72205 21.826 1.72205 14.594C1.72205 11.52 3.12005 9.104 4.75205 7.268C5.92205 5.952 7.26005 4.882 8.33605 4.064H5.06405C4.79883
                    4.064 4.54448 3.95864 4.35694 3.7711C4.1694 3.58357 4.06405 3.32921 4.06405 3.064C4.06405 2.79878 4.1694 2.54443 4.35694 2.35689C4.54448 2.16935 4.79883 2.064 5.06405
                    2.064H11.064C11.3293 2.064 11.5836 2.16935 11.7712 2.35689C11.9587 2.54443 12.064 2.79878 12.064 3.064V9.064C12.064 9.32921 11.9587 9.58357 11.7712 9.7711C11.5836 9.95864
                    11.3293 10.064 11.064 10.064C10.7988 10.064 10.5445 9.95864 10.3569 9.7711C10.1694 9.58357 10.064 9.32921 10.064 9.064V5.372L10.062 5.376C8.91805 6.236 7.52205 7.29 6.31205
                    8.652C4.88205 10.26 3.80605 12.204 3.80605 14.592V14.594ZM26.022 15.406C26.022 9.382 21.702 5.26 16.808 4.34C16.6716 4.31685 16.5412 4.26678 16.4244 4.19269C16.3075 4.1186
                    16.2066 4.02199 16.1275 3.90848C16.0484 3.79498 15.9927 3.66686 15.9636 3.53159C15.9345 3.39633 15.9327 3.25663 15.9582 3.12065C15.9837 2.98467 16.036 2.85512 16.1121
                    2.73958C16.1882 2.62403 16.2865 2.52479 16.4014 2.44766C16.5163 2.37052 16.6453 2.31703 16.7811 2.2903C16.9168 2.26358 17.0565 2.26415 17.192 2.292C22.94 3.372 28.106
                    8.252 28.106 15.406C28.106 18.48 26.708 20.894 25.076 22.732C23.906 24.048 22.568 25.118 21.492 25.936H24.764C25.0293 25.936 25.2836 26.0414 25.4712 26.2289C25.6587
                    26.4164 25.764 26.6708 25.764 26.936C25.764 27.2012 25.6587 27.4556 25.4712 27.6431C25.2836 27.8306 25.0293 27.936 24.764 27.936H18.764C18.4988 27.936 18.2445 27.8306
                    18.0569 27.6431C17.8694 27.4556 17.764 27.2012 17.764 26.936V20.936C17.764 20.6708 17.8694 20.4164 18.0569 20.2289C18.2445 20.0414 18.4988 19.936 18.764 19.936C19.0293
                    19.936 19.2836 20.0414 19.4712 20.2289C19.6587 20.4164 19.764 20.6708 19.764 20.936V24.626H19.768C20.91 23.762 22.308 22.71 23.516 21.346C24.946 19.74 26.022 17.796
                    26.022 15.406Z" fill="#401B37"/>
                </svg>
            </form>
            <form class="update-infos-form">
                <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.4815 24.4615C25.2369 24.3815 23.6907 23.6846 24.6569 20.7477H24.643C27.1615 18.1539 29.0861 13.98 29.0861 9.87077C29.0861 3.55231 24.8846
                    0.240005 20.0015 0.240005C15.1154 0.240005 10.9369 3.55077 10.9369 9.87077C10.9369 13.9969 12.8507 18.1877 15.3846 20.7754C16.3723 23.3662 14.6061 24.3277
                    14.2369 24.4631C9.12305 26.3123 3.12305 29.6831 3.12305 33.0108V34.2585C3.12305 38.7923 11.9138 39.8231 20.0492 39.8231C28.1969 39.8231 36.8769 38.7923 36.8769
                    34.2585V33.0108C36.8769 29.5831 30.8477 26.2385 25.4815 24.4615Z" fill="#401B37"/>
                </svg>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom" required v-model="prenom">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="30" height="30" fill="#FCFCFF"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.80605 14.594C3.80605 20.682 8.22005 24.83 13.178 25.688C13.3129 25.7114 13.4419 25.7611 13.5575
                    25.8343C13.6732 25.9075 13.7733 26.0028 13.8521 26.1147C13.9309 26.2266 13.987 26.3529 14.017 26.4864C14.047 26.62 14.0504 26.7581 14.027 26.893C14.0037
                    27.0279 13.954 27.1568 13.8808 27.2725C13.8075 27.3881 13.7123 27.4882 13.6004 27.5671C13.4885 27.6459 13.3622 27.7019 13.2286 27.7319C13.0951 27.762 12.9569
                    27.7654 12.822 27.742C7.00005 26.734 1.72205 21.826 1.72205 14.594C1.72205 11.52 3.12005 9.104 4.75205 7.268C5.92205 5.952 7.26005 4.882 8.33605 4.064H5.06405C4.79883
                    4.064 4.54448 3.95864 4.35694 3.7711C4.1694 3.58357 4.06405 3.32921 4.06405 3.064C4.06405 2.79878 4.1694 2.54443 4.35694 2.35689C4.54448 2.16935 4.79883 2.064 5.06405
                    2.064H11.064C11.3293 2.064 11.5836 2.16935 11.7712 2.35689C11.9587 2.54443 12.064 2.79878 12.064 3.064V9.064C12.064 9.32921 11.9587 9.58357 11.7712 9.7711C11.5836 9.95864
                    11.3293 10.064 11.064 10.064C10.7988 10.064 10.5445 9.95864 10.3569 9.7711C10.1694 9.58357 10.064 9.32921 10.064 9.064V5.372L10.062 5.376C8.91805 6.236 7.52205 7.29 6.31205
                    8.652C4.88205 10.26 3.80605 12.204 3.80605 14.592V14.594ZM26.022 15.406C26.022 9.382 21.702 5.26 16.808 4.34C16.6716 4.31685 16.5412 4.26678 16.4244 4.19269C16.3075 4.1186
                    16.2066 4.02199 16.1275 3.90848C16.0484 3.79498 15.9927 3.66686 15.9636 3.53159C15.9345 3.39633 15.9327 3.25663 15.9582 3.12065C15.9837 2.98467 16.036 2.85512 16.1121
                    2.73958C16.1882 2.62403 16.2865 2.52479 16.4014 2.44766C16.5163 2.37052 16.6453 2.31703 16.7811 2.2903C16.9168 2.26358 17.0565 2.26415 17.192 2.292C22.94 3.372 28.106
                    8.252 28.106 15.406C28.106 18.48 26.708 20.894 25.076 22.732C23.906 24.048 22.568 25.118 21.492 25.936H24.764C25.0293 25.936 25.2836 26.0414 25.4712 26.2289C25.6587
                    26.4164 25.764 26.6708 25.764 26.936C25.764 27.2012 25.6587 27.4556 25.4712 27.6431C25.2836 27.8306 25.0293 27.936 24.764 27.936H18.764C18.4988 27.936 18.2445 27.8306
                    18.0569 27.6431C17.8694 27.4556 17.764 27.2012 17.764 26.936V20.936C17.764 20.6708 17.8694 20.4164 18.0569 20.2289C18.2445 20.0414 18.4988 19.936 18.764 19.936C19.0293
                    19.936 19.2836 20.0414 19.4712 20.2289C19.6587 20.4164 19.764 20.6708 19.764 20.936V24.626H19.768C20.91 23.762 22.308 22.71 23.516 21.346C24.946 19.74 26.022 17.796
                    26.022 15.406Z" fill="#401B37"/>
                </svg>
            </form>
            <form class="update-infos-form">
                <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M33.3333 13.3333L19.9999 21.6667L6.66659 13.3333V10L19.9999 18.3333L33.3333 10M33.3333 6.66666H6.66659C4.81659 6.66666 3.33325 8.15 3.33325
                    10V30C3.33325 30.8841 3.68444 31.7319 4.30956 32.357C4.93468 32.9821 5.78253 33.3333 6.66659 33.3333H33.3333C34.2173 33.3333 35.0652 32.9821 35.6903
                    32.357C36.3154 31.7319 36.6666 30.8841 36.6666 30V10C36.6666 9.11594 36.3154 8.2681 35.6903 7.64297C35.0652 7.01785 34.2173 6.66666 33.3333 6.66666Z" fill="#401B37"/>
                </svg>
                <input type="email" name="mail" id="mail" placeholder="Adresse mail" required v-model="email">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="30" height="30" fill="#FCFCFF"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.80605 14.594C3.80605 20.682 8.22005 24.83 13.178 25.688C13.3129 25.7114 13.4419 25.7611 13.5575
                    25.8343C13.6732 25.9075 13.7733 26.0028 13.8521 26.1147C13.9309 26.2266 13.987 26.3529 14.017 26.4864C14.047 26.62 14.0504 26.7581 14.027 26.893C14.0037
                    27.0279 13.954 27.1568 13.8808 27.2725C13.8075 27.3881 13.7123 27.4882 13.6004 27.5671C13.4885 27.6459 13.3622 27.7019 13.2286 27.7319C13.0951 27.762 12.9569
                    27.7654 12.822 27.742C7.00005 26.734 1.72205 21.826 1.72205 14.594C1.72205 11.52 3.12005 9.104 4.75205 7.268C5.92205 5.952 7.26005 4.882 8.33605 4.064H5.06405C4.79883
                    4.064 4.54448 3.95864 4.35694 3.7711C4.1694 3.58357 4.06405 3.32921 4.06405 3.064C4.06405 2.79878 4.1694 2.54443 4.35694 2.35689C4.54448 2.16935 4.79883 2.064 5.06405
                    2.064H11.064C11.3293 2.064 11.5836 2.16935 11.7712 2.35689C11.9587 2.54443 12.064 2.79878 12.064 3.064V9.064C12.064 9.32921 11.9587 9.58357 11.7712 9.7711C11.5836 9.95864
                    11.3293 10.064 11.064 10.064C10.7988 10.064 10.5445 9.95864 10.3569 9.7711C10.1694 9.58357 10.064 9.32921 10.064 9.064V5.372L10.062 5.376C8.91805 6.236 7.52205 7.29 6.31205
                    8.652C4.88205 10.26 3.80605 12.204 3.80605 14.592V14.594ZM26.022 15.406C26.022 9.382 21.702 5.26 16.808 4.34C16.6716 4.31685 16.5412 4.26678 16.4244 4.19269C16.3075 4.1186
                    16.2066 4.02199 16.1275 3.90848C16.0484 3.79498 15.9927 3.66686 15.9636 3.53159C15.9345 3.39633 15.9327 3.25663 15.9582 3.12065C15.9837 2.98467 16.036 2.85512 16.1121
                    2.73958C16.1882 2.62403 16.2865 2.52479 16.4014 2.44766C16.5163 2.37052 16.6453 2.31703 16.7811 2.2903C16.9168 2.26358 17.0565 2.26415 17.192 2.292C22.94 3.372 28.106
                    8.252 28.106 15.406C28.106 18.48 26.708 20.894 25.076 22.732C23.906 24.048 22.568 25.118 21.492 25.936H24.764C25.0293 25.936 25.2836 26.0414 25.4712 26.2289C25.6587
                    26.4164 25.764 26.6708 25.764 26.936C25.764 27.2012 25.6587 27.4556 25.4712 27.6431C25.2836 27.8306 25.0293 27.936 24.764 27.936H18.764C18.4988 27.936 18.2445 27.8306
                    18.0569 27.6431C17.8694 27.4556 17.764 27.2012 17.764 26.936V20.936C17.764 20.6708 17.8694 20.4164 18.0569 20.2289C18.2445 20.0414 18.4988 19.936 18.764 19.936C19.0293
                    19.936 19.2836 20.0414 19.4712 20.2289C19.6587 20.4164 19.764 20.6708 19.764 20.936V24.626H19.768C20.91 23.762 22.308 22.71 23.516 21.346C24.946 19.74 26.022 17.796
                    26.022 15.406Z" fill="#401B37"/>
                </svg>
            </form>
            <form class="update-infos-form">
                <div class="update-infos-input-container">
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
                    <input type="password" name="ancienMotDePasse" placeholder="Ancien mot de passe" required v-model="ancienMotDePasse">
                </div>
                <div class="update-infos-input-container">
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
                    <input type="password" name="nouveauMotDePasse" placeholder="Nouveau mot de passe" required v-model="nouveauMotDePasse">
                </div>
                <div class="update-infos-input-container">
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
                    <input type="password" name="nouveauMotDePasse2" placeholder="Vérification du nouveau mot de passe" required v-model="nouveauMotDePasse2">
                </div>
                <button type="submit">Mettre à jour le mot de passe</button>
            </form>
        </main>
        <script src="https://unpkg.com/vue@3"></script>
        <script src="js/script-update-infos.js"></script>
    </body>
</html>