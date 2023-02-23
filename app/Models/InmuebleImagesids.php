<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InmuebleImagesids
 * @package App\Models
 * @version May 12, 2018, 5:51 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property integer inmueble_id
 * @property string link
 * @property string filename
 * @property integer activ
 */
class InmuebleImagesids extends Model
{
    use SoftDeletes;

    public $table = 'inmueble_imagesids';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
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
        'inmueble_id' => 'integer',
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
        'filename' => 'required|max:150|min:3',
        'activ' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }
}
