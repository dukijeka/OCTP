<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;

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
 * @property int $num_of_ratings
 * @property Document[] $documents
 * @property Language[] $languages
 * @property Rating[] $ratings
 * @property Report[] $reports
 * @property Translation[] $translations
 */
class User extends Model implements Authenticatable, CanResetPasswordContract
{

    use AuthenticableTrait, CanResetPassword, Notifiable;
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
    protected $fillable = ['username',
                           'first_name', 
                           'last_name', 
                           'email', 
                           'password', 
                           'date_of_birth', 
                           'date_joined', 
                           'access_level', 
                           'rating',
                           'num_of_ratings'];
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

    public function isAdmin() {
        return $this->access_level == 10;
    }

    public function isModerator() {
        return $this->access_level == 5;
    }

    public function isAdminOrModerator() {
        return $this->isAdmin() || $this->isModerator();
    }

    public function fullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function userRating() {
        return $this->rating;
    }

    public function updateUserRating($rating) {
        $this->userRating = (($this->rating/20*$this->num_of_ratings + $rating)/($this->num_of_ratings + 1))*20;
        if ($this->userRating > 100)
            $this->userRating = 100;
        $this->num_of_ratings++;
    }
}
