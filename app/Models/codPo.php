<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CodPo
 * @package App\Models
 * @version February 19, 2018, 2:06 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection PersonaDir
 * @property string cp
 * @property string ciudad
 * @property string estado
 * @property string municipio
 * @property string tipo
 * @property string asentamiento
 */
class CodPo extends Model
{
    use SoftDeletes;

    public $table = 'cod_pos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cp',
        'ciudad',
        'estado',
        'municipio',
        'tipo',
        'asentamiento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cp' => 'string',
        'ciudad' => 'string',
        'estado' => 'string',
        'municipio' => 'string',
        'tipo' => 'string',
        'asentamiento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cp' => 'required|max:5|min:5',
        'ciudad' => 'required|max:30',
        'estado' => 'required|max:60',
        'municipio' => 'required|max:30',
        'tipo' => 'required|max:30',
        'asentamiento' => 'required|max:30'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function personaDirs()
    {
        return $this->hasMany(\App\Models\PersonaDir::class, 'codpo_id', 'id');
    }
}
