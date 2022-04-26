<?php

/**
 * CE FICHIER DOIT AFFICHER UN ARTICLE ET SES COMMENTAIRES !
 *
 */

use controllers\Article;

require_once('libraries/database.php');
require_once('libraries/utils.php');
require_once('libraries/controllers/Controller.php');
require_once('libraries/controllers/Article.php');

$controller = new Article();
$controller->show();


