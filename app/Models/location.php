<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class location
 * @package App\Models
 * @version February 16, 2018, 9:52 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection PersonaDir
 * @property string ident
 * @property string nombre
 * @property string descripcion
 */
class location extends Model
{
    use SoftDeletes;

    public $table = 'locations';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ident',
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ident' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ident' => 'required|max:8',
        'nombre' => 'required|max:25',
        'descripcion' => 'required|max:100'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function personaDirs()
    {
        return $this->hasMany(\App\Models\PersonaDir::class, 'location_id', 'id');
    }
}
