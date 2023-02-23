<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class propertyvalue
 * @package App\Models
 * @version October 27, 2018, 12:14 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property integer inmueble_id
 * @property decimal area
 * @property decimal porcentaje
 * @property decimal valor
 * @property decimal presupuesto
 * @property decimal cuota
 * @property decimal indiv1
 * @property decimal indiv2
 * @property decimal indiv3
 * @property decimal indiv4
 * @property decimal indiv5
 * @property string param1
 * @property string param2
 * @property string param3
 */
class propertyvalue extends Model
{
    use SoftDeletes;

    public $table = 'propertyvalues';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'area',
        'porcentaje',
        'valor',
        'presupuesto',
        'cuota',
        'indiv1',
        'indiv2',
        'indiv3',
        'indiv4',
        'indiv5',
        'param1',
        'param2',
        'param3'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'param1' => 'string',
        'param2' => 'string',
        'param3' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }
}
