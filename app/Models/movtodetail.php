<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class movtodetail
 * @package App\Models
 * @version July 27, 2018, 3:00 am UTC
 *
 * @property \App\Models\movtohead movtohead
 * @property \App\Models\movimientotipo movimientotipo
 * @property integer movtohead_id
 * @property integer movimientotipo_id
 * @property integer cantidad
 * @property string unidad
 * @property string descripcion
 * @property decimal preciounit
 * @property decimal subtot
 */
class movtodetail extends Model
{
    use SoftDeletes;

    public $table = 'movtodetails';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'movtohead_id',
        'movimientotipo_id',
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
        'movtohead_id' => 'integer',
        'movimientotipo_id' => 'integer',
        'cantidad' => 'integer',
        'unidad' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cantidad' => 'required|max:99999999',
        'unidad' => 'required|max:5|min:1',
        'descripcion' => 'required|max:150|min:1',
        'preciounit' => 'required|max:19|min:1',
        'subtot' => 'required|max:19|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function movtohead()
    {
        return $this->belongsTo(\App\Models\movtohead::class, 'movtohead_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function movimientotipo()
    {
        return $this->belongsTo(\App\Models\movimientotipo::class, 'movimientoTipo_id', 'id');
    }
}
