<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class movimientoTipo
 * @package App\Models
 * @version June 20, 2018, 3:33 am UTC
 *
 * @property string tipo
 * @property integer cve
 * @property string nombre
 * @property string descripcion
 */
class movimientoTipo extends Model
{
    use SoftDeletes;

    public $table = 'movimiento_tipos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo',
        'cve',
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tipo' => 'string',
        'cve' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo' => 'required|max:1|min:1',
        'cve' => 'required|max:9999|min:1',
        'nombre' => 'required|max:60|min:2',
        'descripcion' => 'required|max:150|min:2'
    ];
 /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detailmov()
    {
        return $this->hasMany(\App\Models\detailmov::class, 'movimientotipo_id', 'id');
    }
  /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    // public function headmov()
    // {
    //     return $this->hasMany(\App\Models\headmov::class, 'movimientotipo_id', 'id');
    // }
        
}
