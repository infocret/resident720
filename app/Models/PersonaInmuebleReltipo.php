<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonaInmuebleReltipo
 * @package App\Models
 * @version April 20, 2018, 11:26 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection persona_inmueble
 * @property \Illuminate\Database\Eloquent\Collection pers_inmu_reltipo_req_doc
 * @property string ident
 * @property string nombre
 * @property string descripcion
 */
class PersonaInmuebleReltipo extends Model
{
    use SoftDeletes;

    public $table = 'persona_inmueble_reltipos';
    

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
        'ident' => 'required|max:8|min:3',
        'nombre' => 'required|max:25|min:5',
        'descripcion' => 'required|max:100|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function personaInmuebles()
    {
        return $this->hasMany(\App\Models\PersonaInmueble::class, 'reltipo_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function persInmuReltipoReqDocs()
    {
        return $this->hasMany(\App\Models\PersInmuReltipoReqDoc::class, 'reltipo_id', 'id');
    }
}
