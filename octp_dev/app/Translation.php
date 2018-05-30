<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $translation_text
 * @property int $language_id
 * @property float $average_rating
 * @property int $sentence_id
 * @property User $user
 * @property Rating[] $ratings
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
    public $incrementing = true;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'date', 'translation_text', 'language_id', 'average_rating', 'sentence_id'];

    /**
     * Disable timestamps
     */
    public $timestamps = false;
      
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }
}
