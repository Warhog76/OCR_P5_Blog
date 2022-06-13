<?php

namespace App\Repositories;

Class ErrorMessage{

    public static function getError($text, $type): void
    {

        if($type == "error" ) {
            $_SESSION['errorMsg'] = $text;
        } elseif (  $type == "success" ) {
            $_SESSION['successMsg'] = $text;
        }
    }

    public static function displayError(): void
    {

        if(isset($_SESSION['errorMsg'])){
             ?>
                <div class="card red">
                        <div class="card-content white-text">
                            <?= $_SESSION['errorMsg'] . "<br/>"; ?>
                        </div>
                </div>
            <?php unset($_SESSION['errorMsg']);


        }elseif (isset($_SESSION['successMsg'])){ ?>
            <div class="card green">
                <div class="card-content white-text">

                    <?= $_SESSION['successMsg'] . "<br/>"; ?>
                </div>
            </div>
            <?php unset($_SESSION['successMsg']);
        }
    }
}