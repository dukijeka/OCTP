<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $translation_id
 * @property string $date
 * @property int $rating_value
 * @property Translation $translation
 * @property User $user
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

    /**
     * Disable timestamps
     */
    public $timestamps = false;
        
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo('App\Translation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
