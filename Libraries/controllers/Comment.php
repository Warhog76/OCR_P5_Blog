<?php

namespace Controllers;

require_once ('libraries/database.php');
require_once ('libraries/utils.php');
require_once ('libraries/controllers/Controller.php');
require_once ('libraries/models/Comment.php');

class Comment extends Controller{

    protected $modelName = \models\Comment::class;

    public function getComments(){



    }
}