<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $translation_id
 * @property string $date
 * @property int $rating_value
 */
class Rating extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rating';

    /**
     * @var array
     */
    protected $fillable = ['date', 'rating_value'];

}
