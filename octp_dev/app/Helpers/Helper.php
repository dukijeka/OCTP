<?php

namespace App\Helpers;

use App\Document;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class Helper
{
    public static function displayRatingStars(int $numStars)
    {

        $starsLeft = 5 - $numStars ;

        for ($i=0; $i < $numStars; $i++) {
            echo '<span class="fa fa-star checked"></span>';
        }

        for ($i=0; $i < $starsLeft; $i++) {
            echo '<span class="fa fa-star"></span>';
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
