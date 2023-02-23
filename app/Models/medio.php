<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class medio
 * @package App\Models
 * @version February 16, 2018, 9:47 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection MedioPersona
 * @property string ident
 * @property string nombre
 * @property string descripcion
 * @property string mask
 * @property string imgfilename
 */
class medio extends Model
{
    use SoftDeletes;

    public $table = 'medios';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ident',
        'nombre',
        'descripcion',
        'mask',
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
        'mask' => 'string',
        'imgfilename' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ident' => 'required|max:8|min:4',
        'nombre' => 'required|max:25|min:5',
        'descripcion' => 'required|max:100|min:3',
        'mask' => 'required|max:50|min:3',
        'imgfilename' => 'required|max:50|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function medioPersonas()
    {
        return $this->hasMany(\App\Models\MedioPersona::class, 'medio_id', 'id');
    }
}
