<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $document_id
 * @property int $user_id
 * @property string $date
 * @property string $explanation
 * @property User $user
 * @property Document $document
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document()
    {
        return $this->belongsTo('App\Document');
    }
}
