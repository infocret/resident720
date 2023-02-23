<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class measurunit
 * @package App\Models
 * @version June 21, 2018, 9:03 pm UTC
 *
 * @property string cve
 * @property string nombre
 * @property string tipo
 */
class measurunit extends Model
{
    use SoftDeletes;

    public $table = 'measurunits';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cve',
        'nombre',
        'tipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cve' => 'string',
        'nombre' => 'string',
        'tipo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:5|min:1',
        'nombre' => 'required|max:35|min:1',
        'tipo' => 'required|max:30|min:1'
    ];

    
}
