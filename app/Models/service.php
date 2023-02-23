<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class service
 * @package App\Models
 * @version June 5, 2018, 5:06 am UTC
 *
 * @property string nomcorto
 * @property string nombre
 * @property string descripcion
 */
class service extends Model
{
    use SoftDeletes;

    public $table = 'services';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nomcorto',
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nomcorto' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nomcorto' => 'required|max:8|min:1',
        'nombre' => 'required|max:35|min:1',
        'descripcion' => 'required|max:150|min:1'
    ];

    
}
