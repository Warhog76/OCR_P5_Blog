<?php

namespace App\Repositories;

Class ErrorMessage
{
    public function __construct(private Session $session)
    {
    }

    public function setError($text, $type): void
    {
        if($type == "error" ) {
            $this->session->write('errorMsg', $text);
        } elseif (  $type == "success" ) {
            $this->session->write('successMsg', $text);
        }
    }
}
