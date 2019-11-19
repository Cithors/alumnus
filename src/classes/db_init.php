<?php
// La méthode select_db() de la classe mysqli retourne "false" si la bdd n'existe pas
try
{
    $mysqli = new mysqli('localhost', 'root', '');
}
catch (\Exception $e)
{
    echo $e->getMessage(), PHP_EOL;
}

if ($mysqli->select_db('alumnus') === false)
    $database = false;
else
    $database = true;
$bdd = null;

// Connexion
$bdd = new PDO('mysql:host=localhost', 'root', '');
$bdd->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
// Création de la base de donnéees 'alumnus' à moins qu'elle n'existe ou plutôt si elle n'existe pas
$sql = "CREATE DATABASE IF NOT EXISTS alumnus CHARACTER SET 'utf8';";
// Exécution de la requête
$bdd->exec($sql);
// Si la bdd n'existe pas, on importe le fichier "alumnus.sql"
if (!($database)) {
    echo "<script>alert('Database just created');</script>";
    setcookie('before', 'block', time() + 86400*10, '/');
    setcookie('after', 'none', time() + 86400*10, '/');
    Import();
}
// Déconnexion
$bdd = null;

// Importation des tables de la base "alumnus"
function Import() {
    // Fichier sql
    $filename = 'http://localhost/alumnus/alumnus.sql';

    // Connexion
    $bdd = new PDO('mysql:host=localhost; dbname=alumnus', 'root', '');
    // Variable temporaire stockant la requête (ligne par ligne)
    $templine = '';
    // Lecture entière du fichier
    $lines = file($filename);
    // Boucle à travers chaque ligne
    foreach ($lines as $line){
        // Passage à la ligne suivante si c'est un commentaire ('--' et '/* */') ou si la ligne est vide
        if (substr($line, 0, 2) == '--' || substr($line, 0, 2) == '/*' || $line == '')
            continue;

        // Ajout ou concaténation de la ligne au segment actuel
        $templine .= $line;
        // Détection de fin de ligne avec le point-virgule
        if (substr(trim($line), -1, 1) == ';') {
            // Exécution de la requête
            $bdd->exec($templine);
            // Réinitialisation de la variable temporaire
            $templine = '';
        }
    }

    // Déconnexion
    $bdd = null;
}
?>
