<?php

namespace App\Helpers;

class Helper
{
    public static function displayRatingStars(int $numStars)
    {

        $starsLeft = 5 - $numStars ;

        for ($i=0; $i < $numStars; $i++) {
            echo '<span class="fa fa-star checked"></span> \n';
        }

        for ($i=0; $i < $starsLeft; $i++) {
            echo '<span class="fa fa-star"></span> \n';
        }

    }
}
