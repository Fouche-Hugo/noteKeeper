<?php
function valid_donnees($donnees) {
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    $donnees = $GLOBALS['db']->real_escape_string($donnees);
    return $donnees;
}
?>