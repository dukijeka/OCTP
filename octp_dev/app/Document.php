<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $posting_user_id
 * @property string $date_created
 * @property int $language_id
 * @property User $user
 * @property Report[] $reports
 * @property Sentence[] $sentences
 * @property Language[] $languages
 */
class Document extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'document';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = true;

    /**
     * @var array
     */
    protected $fillable = ['posting_user_id', 'date_created', 'language_id', 'id'];

    /**
     * Disable timestamps
     */
    public $timestamps = false;
      
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'posting_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentences()
    {
        return $this->hasMany('App\Sentence');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany('App\Language', 'wanted_translations');
    }
}
