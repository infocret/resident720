<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class parameter
 * @package App\Models
 * @version December 20, 2018, 9:05 pm UTC
 *
 * @property string clave
 * @property string descripcion
 * @property string tipo
 * @property string default
 * @property string observaciones
 */
class parameter extends Model
{
    use SoftDeletes;

    public $table = 'parameters';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'clave',
        'descripcion',
        'tipo',
        'default',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'clave' => 'string',
        'descripcion' => 'string',
        'tipo' => 'string',
        'default' => 'string',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clave' => 'required|max:15|min:1',
        'descripcion' => 'required|max:45|min:1',
        'tipo' => 'required|max:15|min:1',
        'default' => 'required|max:50|min:1',
        'observaciones' => 'required|max:100|min:1'
    ];

    
}
