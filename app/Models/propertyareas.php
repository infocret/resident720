<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class propertyareas
 * @package App\Models
 * @version May 24, 2018, 3:31 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property integer inmueble_id
 * @property string nombre
 * @property string descripcion
 * @property string planta
 * @property string filename
 * @property string filepath
 */
class propertyareas extends Model
{
    use SoftDeletes;

    public $table = 'propertyareas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'nombre',
        'descripcion',
        'planta',
        'filename',
        'filepath'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'planta' => 'string',
        'filename' => 'string',
        'filepath' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|max:15|min:2',
        'descripcion' => 'required|max:40|min:2',
        'planta' => 'required|max:10|min:2',
        'filename' => 'required|max:50|min:2',
        'filepath' => 'required|max:150|min:2'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function headmov()
    {
        return $this->hasMany(\App\Models\headmov::class,  'propertyarea_id', 'id');
    }
}
