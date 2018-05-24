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
    protected $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['username', 'password_hash', 'first_name', 'last_name', 'email', 'date_of_birth', 'date_joined', 'access_level', 'rating'];

    public function Translations() {
        return $this->hasMany('App\Post');
    }

    public function Rating() {
        return $this->hasOne('App\Rating');
    }

    public function Reports() {
        return $this->hasMany('App\Report');
    }

    public function Documents() {
        return $this->hasMany('App\Document');
    }

    public function KnowsLanguages() {
        return $this->hasMany('App\KnowsLanguage');
    }
}
