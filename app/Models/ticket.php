<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ticket
 * @package App\Models
 * @version July 27, 2018, 10:19 pm UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\propertyarea propertyarea
 * @property integer inmueble_id
 * @property integer propertyarea_id
 * @property string folio
 * @property string description
 */
class ticket extends Model
{
    use SoftDeletes;

    public $table = 'tickets';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'propertyarea_id',
        'folio',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'propertyarea_id' => 'integer',
        'folio' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'folio' => 'required|max:15|min:3',
        'description' => 'required|max:150|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function propertyarea()
    {
        return $this->belongsTo(\App\Models\propertyarea::class, 'propertyarea_id', 'id');
    }
}
