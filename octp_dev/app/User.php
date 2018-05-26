<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $date_of_birth
 * @property string $date_joined
 * @property int $access_level
 * @property float $rating
 * @property Document[] $documents
 * @property Language[] $languages
 * @property Rating[] $ratings
 * @property Report[] $reports
 * @property Translation[] $translations
 */
class User extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['username', 'first_name', 'last_name', 'email', 'date_of_birth', 'date_joined', 'rating'];
    protected $guarded = ['password_hash', 'access_level'];
    /**
     * Disable timestamps
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany('App\Document', 'posting_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany('App\Language', 'knows_language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany('App\Rating');
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
    public function translations()
    {
        return $this->hasMany('App\Translation');
    }
}
