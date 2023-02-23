<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class procedmovto
 * @package App\Models
 * @version January 29, 2021, 12:39 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\conceptservice conceptservice
 * @property \App\Models\catmovto catmovto
 * @property integer inmueble_id
 * @property integer conceptservice_id
 * @property integer catmovto_id
 * @property integer concept_cve
 * @property integer movto_cve
 * @property string procedimiento
 * @property string parametros
 * @property integer execauto
 * @property string nombre
 * @property string desc
 * @property string observ
 */
class procedmovto extends Model
{
    //use SoftDeletes;

    public $table = 'procedmovtos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'conceptservice_id',
        'catmovto_id',
        'concept_cve',
        'movto_cve',
        'procedimiento',
        'parametros',
        'execauto',
        'nombre',
        'desc',
        'observ'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'conceptservice_id' => 'integer',
        'catmovto_id' => 'integer',
        'concept_cve' => 'integer',
        'movto_cve' => 'integer',
        'procedimiento' => 'string',
        'parametros' => 'string',
        'execauto' => 'integer',
        'nombre' => 'string',
        'desc' => 'string',
        'observ' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'concept_cve' => 'required|max:999999|min:1',
        'movto_cve' => 'required|max:999999|min:1',
        'procedimiento' => 'required|max:150|min:1',
        'parametros' => 'required|max:150|min:1',
        // 'execauto' => 'required|max:1|min:0',
        'nombre' => 'required|max:35|min:1',
        'desc' => 'required|max:150|min:1',
        'observ' => 'required|max:150|min:1'
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
    public function conceptservice()
    {
        return $this->belongsTo(\App\Models\conceptservice::class, 'conceptservice_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function catmovto()
    {
        return $this->belongsTo(\App\Models\catmovto::class, 'catmovto_id', 'id');
    }
}
