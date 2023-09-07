<?php

//*******************Fonctions***********************

/**
 * Permet de vérifier si un user est connecté.
 * @return bool
 */
function userConnected()  
{   //On met && pour eviter un bug d'affichage si user non connecté on passe à l'étape suivante
    if (isset($_SESSION['connexion']) && $_SESSION['connexion'] === true) { 
        return true;
    }
    else {
        return false;
    }
}

/**
 * Permettre de savoir si user est connecté en tant qu'admin (isAdmin a 1) ou membre (0)
 * @return bool
 */
function AdminConnected()
{
    if (userConnected() && $_SESSION['isAdmin'] === 1) {
        return true;
    }
    return false;
}




?>