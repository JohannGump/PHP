<?php

/*
 * CrossDomain.php
 * 
 * http://10.57.217.9/jQueryAjaxCours/php/CrossDomain.php
 */

/*
 * Si la requete vient du meme domaine
 */
if (!isset($_SERVER['HTTP_ORIGIN'])) {
    // Ce n'est pas une requete cross-domain
    echo "Ce n'est pas une requête cross-domain, ça vient du même domaine";
    exit;
}
/*
 * Set $wildcard to TRUE if you do not plan to check or limit the domains
 * TRUE : tout le monde peut requeter
 * FALSE : il faut lister les domaines autorises
 */
$wildcard = TRUE;
/*
 * Set $credentials to TRUE if expects credential requests (Cookies, Authentication, SSL certificates)
 */
$credentials = FALSE;
/*
 * La liste des domaines autorises a requeter ici
 */
$allowedOrigins = array('http://10.57.255.168', 'http://localhost', 'http://127.0.0.1');
$allowedOrigins = array('http://localhost', 'http://127.0.0.1');
//$allowedOrigins = "*"; // KO ??? !!!
/*
 * Si c'est pas dans la liste ou pas *
 */
if (!in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins) && !$wildcard) {
    // Origin is not allowed
    echo "Ce domaine n'est pas autorisé";
    exit;
}

// SI 
$origin = $wildcard && !$credentials ? '*' : $_SERVER['HTTP_ORIGIN'];

// Liste des domaines autorises
header("Access-Control-Allow-Origin: " . $origin);
// Si credentiels
if ($credentials) {
    header("Access-Control-Allow-Credentials: true");
}
// Les methodes de requete autorisees
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// 
header("Access-Control-Allow-Headers: Origin");

// Handling the Preflight
// Si la methode est OPTIONS ... cf plus haut ???
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

// Response
echo "From CrossDomain.php, donc dans la liste des autorisés !"
?>

