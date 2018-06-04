<?php

namespace App\Helpers;

use App\Document;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class Helper
{
    public static function displayRatingStars(int $numStars, int $id)
    {

        $starsLeft = 5 - $numStars ;

        $i = 0;
        for (; $i < $numStars; $i++) {
            echo '<span class="fa fa-star checked rate" data-star="'.($i + 1).'" data-id="'.$id.'"></span>';
        }

        for ($j=0; $j < $starsLeft; $j++, $i++) {
            echo '<span class="fa fa-star rate" data-star="'.($i + 1).'" data-id="'.$id.'"></span>';
        }
    }

    public static function displayMyRatingStars(int $numStars, int $id) {
        $starsLeft = 5 - $numStars;

        $i = 0;
        for(; $i < $numStars; $i++) {
            echo '<span class="fa fa-star checked change" data-star="'.($i + 1).'" data-id="'.$id.'"></span>';
        }
        for ($j = 0; $j < $starsLeft; $j++) {
            echo '<span class="fa fa-star change" data-star="'.($i + 1).'" data-id="'.$id.'"></span>';
        }

    }

    public static function setSuccessMessage($message) {
        session()->flash('success', $message);
    }

    public static function getCurrentUser() {
        return User::find(Auth::id());
    }

    public static function getCurrentUserOrFail() {
        $user = self::getCurrentUser();
        if($user != null)
            return $user;
        abort(403, 'You must be logged in to access this page.');
    }

    public static function hasUserReportedDocument(User $user, Document $doc) {
        return $user->reports()->where('document_id', $doc->id)->first() != null;
    }

}
