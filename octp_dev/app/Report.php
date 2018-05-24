<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $document_id
 * @property int $user_id
 * @property string $date
 * @property string $explanation
 */
class Report extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'report';

    /**
     * @var array
     */
    protected $fillable = ['date', 'explanation'];

}
