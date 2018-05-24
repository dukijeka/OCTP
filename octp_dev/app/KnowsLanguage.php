<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $language_id
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

}
