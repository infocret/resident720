<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InmuebleTipo
 * @package App\Models
 * @version February 16, 2018, 8:22 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection inmueble
 * @property string ident
 * @property string nombre
 * @property string descripcion
 * @property string imgfilename
 */
class InmuebleTipo extends Model
{
    use SoftDeletes;

    public $table = 'inmueble_tipos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ident',
        'nombre',
        'descripcion',
        'imgfilename'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ident' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string',
        'imgfilename' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ident' => 'required|max:8',
        'nombre' => 'required|max:25',
        'descripcion' => 'required|max:50',
        'imgfilename' => 'required|max:50|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function inmuebles()
    {
        return $this->hasMany(\App\Models\inmueble::class, 'inmuebletipo_id', 'id');
    }
}
