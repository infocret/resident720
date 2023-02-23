<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class propertyparameter
 * @package App\Models
 * @version October 16, 2018, 1:54 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property integer inmueble_id
 * @property string parametro
 * @property string valor
 */
class propertyparameter extends Model
{
    use SoftDeletes;

    public $table = 'propertyparameters';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'parametro',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'parametro' => 'string',
        'valor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parametro' => 'required|max:15|min:1',
        //'valor' => 'required|max:50|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }
}
