<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property User[] $users
 * @property Document[] $documents
 */
class Language extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'language';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    protected $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'knows_language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany('App\Document', 'wanted_translations');
    }
}
