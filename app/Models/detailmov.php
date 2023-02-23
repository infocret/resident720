<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class detailmov
 * @package App\Models
 * @version June 20, 2018, 6:45 am UTC
 *
 * @property \App\Models\headmov headmov
 * @property \App\Models\movimientoTipo movimientoTipo
 * @property integer headmov_id
 * @property integer movimientoTipo_id
 * @property decimal cantidad
 * @property string unidad
 * @property string descripcion
 * @property decimal preciounit
 * @property decimal subtot
 */
class detailmov extends Model
{
    //use SoftDeletes;

    public $table = 'detailmovs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'headmov_id',
        'movimientoTipo_id',
        'cantidad',
        'unidad',
        'descripcion',
        'preciounit',
        'subtot'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'headmov_id' => 'integer',
        'movimientoTipo_id' => 'integer',
        'unidad' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cantidad' => 'required|max:8|min:1',
        'unidad' => 'required|max:8|min:1',
        'descripcion' => 'required|max:150|min:1',
        'preciounit' => 'required|max:19|min:1',
        'subtot' => 'required|max:19|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function headmov()
    {
        return $this->belongsTo(\App\Models\headmov::class, 'headmov_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function movimientoTipo()
    {
        return $this->belongsTo(\App\Models\movimientoTipo::class, 'movimientoTipo_id', 'id');
    }
}
