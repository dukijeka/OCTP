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


    /**
     * Returns the translation with the most ratings
     * If more than one translation has the most ratings, returns the one with better average rating
     * @return Translation
     */
    public function getTranslationWithTheMostRatings() {
        $max = 0;
        $translationToReturn = null;
        foreach ($this->translations as $translation) {
            info("this is it". json_encode($translation));
            if ($translation->ratings->count() > $max) {
                $translationToReturn = $translation;
                $max = $translation->ratings->count();
            } elseif ($translation->ratings->count() == $max
                and $translation['average_rating'] > $translationToReturn['average_rating']) {
                // the number of ratings is the same, but this one has the better average rating, so we'll choose it
                $translationToReturn = $translation;
            }
        }

        return $translationToReturn;
    }
}
