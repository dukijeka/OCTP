<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $language_id
 * @property User $user
 * @property Language $language
 */
class KnowsLanguage extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'knows_language';

    /**
     * @var array
     */
    protected $fillable = [];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}
