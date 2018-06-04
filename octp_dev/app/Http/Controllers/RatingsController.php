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
        info('rated');
        $data = $request->all();

        $translation = Translation::findOrFail($data['translationId']);

        // insert into db
        $r = new Rating();
        $r->user()->associate(Auth::user());
        $r->translation()->associate($translation);
        $r->date = Carbon::now();
        $r->rating_value = $data['myRating'];

        compute($r->translation->id);

        $r->saveOrFail();

        return response()->json(['result' => 'Success']);
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to edit rating']);
        }
        $rating = Rating::find($request['id']);
        if (Auth::id() != $rating->user->id) {
            return response()->json(['error' => 'You can only edit your own rating']);
        }
        $rating->rating_value = $request['newRating'];
        $rating->save();

        compute($rating->translation->id);

        return response()->json(['success' => 'Rating updated']);
    }

    public function compute($translationId) {
        $ratings = Rating::all();
        $sum_user_rating = 0;
        $sum_translation_rating = 0;

        foreach ($ratings as $rating) {
            if($rating->translation_id==$translationId) {
                $user = User::find($rating->user_id);
                $sum_user_rating += $user->userRating() / 100;
                $sum_translation_rating += $user->userRating() / 100 * $rating->rating_value;
            }
        }

        $rating = $sum_translation_rating/$sum_user_rating;

        $translation = Translation::find($translationId);
        $user2 = User::find($translation->user_id);
        $user2->updateUserRating($rating);

        return $rating;
    }


}