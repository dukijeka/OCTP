<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $date
 * @property string $translation_text
 * @property int $user_id
 * @property int $language_id
 * @property float $average_rating
 * @property int $sentence_id
 */
class Translation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'translation';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    protected $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['date', 'translation_text', 'user_id', 'language_id', 'average_rating', 'sentence_id'];

}
