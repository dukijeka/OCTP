<?php
/**
 * Created by PhpStorm.
 * User: Milica Jovanovic
 * Date: 3.6.2018.
 * Time: 20:08
 */

namespace App\Http\Controllers;

use App\Rating;
use App\User;
use App\Translation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RatingsController
{
    public function store(Request $request)
    {
        $data = $request->all();

        $translation = Translation::findOrFail($data['translationId']);

        $rating = Rating::where("user_id", Auth::id())->
                          where("translation_id", $data['translationId'])->first();
        if ($rating != null) {
            info($rating);
            return response()->json(['error' => 'You already rated this translation']);
        }
        // insert into db
        $r = new Rating();
        $r->user()->associate(Auth::user());
        $r->translation()->associate($translation);
        $r->date = Carbon::now();
        $r->rating_value = $data['num'];

        $r->saveOrFail();

        $this->compute($translation->id, $r->user_id, $r->rating_value());

        return response()->json(['success' => 'Rating saved']);
    }

    private function compute($translationId, $user_id, $rating_value) {
        $ratings = Rating::all();
        $sum_user_rating = 0.0;
        $sum_translation_rating = 0.0;

        foreach ($ratings as $rating) {
            if($rating->translation_id==$translationId) {
                $user = User::find($rating->user_id);
                $sum_user_rating += $user->userRating() / 100;
                $sum_translation_rating += $user->userRating() / 100 * $rating->rating_value;
            }
        }

        $translation = Translation::find($translationId);
        $average_rating =  $sum_translation_rating/$sum_user_rating;
        $translation->setAvgRating($average_rating);
        $translation->save();

        $user1 = User::find($user_id);
        $rating = $user1->rating / 100 * $rating_value;

        $user2 = User::find($translation->user_id);
        $user2->updateUserRating($rating, $user1->rating/100);
        $user2->save();

    }

}