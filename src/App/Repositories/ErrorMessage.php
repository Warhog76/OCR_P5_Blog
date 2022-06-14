<?php

namespace App\Repositories;

Class ErrorMessage{

    public static function getError($text, $type): void
    {

        if($type == "error" ) {
            (new Session)->write('errorMsg', $text);
        } elseif (  $type == "success" ) {
            (new Session)->write('successMsg', $text);
        }
    }

}