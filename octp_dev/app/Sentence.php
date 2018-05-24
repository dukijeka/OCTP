<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $text
 * @property int $document_id
 */
class Sentence extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sentence';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    protected $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['text', 'document_id'];

}
