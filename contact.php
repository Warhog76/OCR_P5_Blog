<?php

use Controllers\mail;

require_once('libraries/database.php');
require_once('libraries/controllers/Contact.php');

render('contact');

$controller = new mail();
$controller->sendMail();