<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class presupuesto
 * @package App\Models
 * @version December 9, 2018, 8:09 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\movimientoTipo movimientoTipo
 * @property integer inmueble_id
 * @property integer movtipo_id
 * @property decimal monto
 */
class presupuesto extends Model
{
    use SoftDeletes;

    public $table = 'presupuestos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'movtipo_id',
        'monto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'movtipo_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       // 'monto' => 'required|max:8|min:1'
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
    public function movimientoTipo()
    {
        return $this->belongsTo(\App\Models\movimientoTipo::class, 'movtipo_id', 'id');
    }
}
