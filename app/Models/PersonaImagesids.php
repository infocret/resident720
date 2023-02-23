<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonaImagesids
 * @package App\Models
 * @version April 2, 2018, 7:44 am UTC
 *
 * @property \App\Models\persona persona
 * @property integer persona_id
 * @property string link
 * @property string filename
 * @property integer activ
 */
class PersonaImagesids extends Model
{
    use SoftDeletes;

    public $table = 'persona_imagesids';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'persona_id',
        'link',
        'filename',
        'activ'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'persona_id' => 'integer',
        'link' => 'string',
        'filename' => 'string',
        'activ' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'link' => 'required|max:250|min:3',
        'filename' => 'required|max:150|min:3'
        //'activ' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function persona()
    {
        return $this->belongsTo(\App\Models\persona::class, 'persona_id', 'id');
    }
}
