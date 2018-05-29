<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $document_id
 * @property string $text
 * @property Document $document
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
    protected $fillable = ['document_id', 'text'];

    /**
     * Disable timestamps
     */
    public $timestamps = false;
        
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document()
    {
        return $this->belongsTo('App\Document');
    }
}
