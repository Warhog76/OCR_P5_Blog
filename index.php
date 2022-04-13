<?php

/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 *
 * On va donc se connecter à la base de données, récupérer les 2 derniers articles du plus récent au plus ancien
 * puis on va boucler dessus pour afficher chacun d'entre eux

 */

use controllers\Article;

require_once ('libraries/database.php');
require_once ('libraries/controllers/Article.php');

$controller = new Article();
$controller->index();