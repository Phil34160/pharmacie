<?php
    $db_username = ''; // entrez votre nom de connexion à la BDD
    $db_password = ''; // entrez votre mdp de connexion à la BDD
    $db_name     = 'pharmacy_management';
    $db_host     = 'localhost';
    
    // variable $db contient la connection à notre pharmacy_management

$dbco = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>