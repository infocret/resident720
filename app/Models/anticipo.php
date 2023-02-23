<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class anticipo
 * @package App\Models
 * @version April 11, 2022, 8:02 pm UTC
 *
 * @property \App\Models\inmueble inmu
 * @property \App\Models\inmueble inmu
 * @property \App\Models\conceptservice conceptserv
 * @property integer condom_id
 * @property integer unid_id
 * @property integer conceptserv_id
 * @property string fechareg
 * @property string folio
 * @property string cobertura
 * @property number montoini
 * @property number saldo
 * @property string status
 * @property string desc
 * @property string observ
 * @property string docto
 * @property string filelink
 * @property string userreg
 */
class anticipo extends Model
{
    use SoftDeletes;

    public $table = 'anticipos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'condom_id',
        'unid_id',
        'conceptserv_id',
        'fechareg',
        'folio',
        'cobertura',
        'montoini',
        'saldo',
        'status',
        'desc',
        'observ',
        'docto',
        'filelink',
        'userreg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'condom_id' => 'integer',
        'unid_id' => 'integer',
        'conceptserv_id' => 'integer',
        'fechareg' => 'datetime',
        'folio' => 'string',
        'cobertura' => 'string',
        'montoini' => 'float',
        'saldo' => 'float',
        'status' => 'string',
        'desc' => 'string',
        'observ' => 'string',
        'docto' => 'string',
        'filelink' => 'string',
        'userreg' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fechareg' => 'required',
        'folio' => 'required|max:35|min:1',
        'cobertura' => 'required|max:150|min:1',
        'montoini' => 'required|max:9999999|min:0',
        'saldo' => 'required|max:9999999|min:0',
        'status' => 'required|max:15|min:1',
        'desc' => 'required|max:150|min:1',
        'observ' => 'required|max:250|min:1',
        'docto' => 'required|max:150|min:1',
        'filelink' => 'required|max:250|min:1',
        'userreg' => 'required|max:150|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmu()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmu_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function conceptserv()
    {
        return $this->belongsTo(\App\Models\conceptservice::class, 'conceptserv_id', 'id');
    }
}
