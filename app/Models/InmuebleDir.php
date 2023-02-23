<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InmuebleDir
 * @package App\Models
 * @version May 2, 2018, 10:42 pm UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\location location
 * @property \App\Models\CodPo codPo
 * @property integer inmueble_id
 * @property integer location_id
 * @property integer codpo_id
 * @property string pais
 * @property string calle
 * @property string numExt
 * @property string piso
 * @property string numInt
 * @property string referencia1
 * @property string referencia2
 * @property string linkmapa
 * @property string imagenMapa
 * @property string observaciones
 */
class InmuebleDir extends Model
{
    use SoftDeletes;

    public $table = 'inmueble_dirs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'location_id',
        'codpo_id',
        'pais',
        'calle',
        'numExt',
        'piso',
        'numInt',
        'referencia1',
        'referencia2',
        'linkmapa',
        'imagenMapa',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'location_id' => 'integer',
        'codpo_id' => 'integer',
        'pais' => 'string',
        'calle' => 'string',
        'numExt' => 'string',
        'piso' => 'string',
        'numInt' => 'string',
        'referencia1' => 'string',
        'referencia2' => 'string',
        'linkmapa' => 'string',
        'imagenMapa' => 'string',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pais' => 'required|max:40',
        'calle' => 'required|max:150',
        'numExt' => 'required|max:8',
        'piso' => 'required|max:8',
        'numInt' => 'required|max:8',
        'referencia1' => 'required|max:100',
        'referencia2' => 'required|max:100',
        'linkmapa' => 'required|max:300',
        'imagenMapa' => 'required|max:150',
        'observaciones' => 'required|max:150'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function location()
    {
        return $this->belongsTo(\App\Models\location::class, 'location_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function codPo()
    {
        return $this->belongsTo(\App\Models\CodPo::class, 'codpo_id', 'id');
    }
}
