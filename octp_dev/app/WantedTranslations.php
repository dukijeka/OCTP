<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $document_id
 * @property int $language_id
 * @property Document $document
 * @property Language $language
 */
class WantedTranslations extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}
