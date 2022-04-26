<?php

use Controllers\Mail;

require_once('libraries/database.php');
require_once('libraries/controllers/Contact.php');

render('contact');

$controller = new Mail();
$controller->sendMail();