<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonaInmueble
 * @package App\Models
 * @version April 20, 2018, 10:33 pm UTC
 *
 * @property \App\Models\persona persona
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\persona_inmueble_reltipo personaInmuebleReltipo
 * @property integer persona_id
 * @property integer inmueble_id
 * @property integer reltipo_id
 * @property dateTime asignacion
 * @property dateTime baja
 * @property string observaciones
 */
class PersonaInmueble extends Model
{
    //use SoftDeletes;

    public $table = 'persona_inmuebles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'persona_id',
        'inmueble_id',
        'reltipo_id',
        'asignacion',
        'baja',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'persona_id' => 'integer',
        'inmueble_id' => 'integer',
        'reltipo_id' => 'integer',
        'asignacion' => 'datetime',
        'baja' => 'datetime',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'asignacion' => 'required',
        // 'baja' => 'required',
        'observaciones' => 'required|max:100|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function persona()
    {
        return $this->belongsTo(\App\Models\persona::class, 'persona_id', 'id');
    }

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
    public function personaInmuebleReltipo()
    {
        return $this->belongsTo(\App\Models\PersonaInmuebleReltipo::class, 'reltipo_id', 'id');
    }
}
