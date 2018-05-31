<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $document_id
 * @property string $text
 * @property Document $document
 * @property Translation[] $translations
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
    public $incrementing = true;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations() {
        return $this->hasMany('App\Translation');
    }
}
