<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class inmucharge
 * @package App\Models
 * @version September 2, 2019, 6:29 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\conceptservice conceptservice
 * @property \App\Models\propertyarea propertyarea
 * @property \App\Models\provider provider
 * @property integer inmu_id
 * @property integer conceptserv_id
 * @property integer proparea_id
 * @property integer provider_id
 * @property dateTime date
 * @property string folio
 * @property decimal stotal
 * @property decimal iva
 * @property decimal balance
 * @property string status
 * @property string description
 * @property string observ
 * @property string filelink
 */
class inmucharge extends Model
{
    use SoftDeletes;

    public $table = 'inmucharges';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmu_id',
        'conceptserv_id',
        'proparea_id',
        'provider_id',
        'date',
        'folio',
        'stotal',
        'iva',
        'balance',
        'status',
        'description',
        'observ',
        'filelink'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmu_id' => 'integer',
        'conceptserv_id' => 'integer',
        'proparea_id' => 'integer',
        'provider_id' => 'integer',
        'date' => 'datetime',
        'folio' => 'string',
        'status' => 'string',
        'description' => 'string',
        'observ' => 'string',
        'filelink' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required',
        'folio' => 'required|max:35|min:1',
        'stotal' => 'required|max:9999999|min:0',
        'iva' => 'required|max:9999999|min:0',
        'balance' => 'required|max:9999999|min:0',
        'status' => 'required|max:15|min:1',
        'description' => 'required|max:150|min:1',
        'observ' => 'required|max:250|min:1',
        'filelink' => 'required|max:250|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmu_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function conceptservice()
    {
        return $this->belongsTo(\App\Models\conceptservice::class, 'conceptserv_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function propertyarea()
    {
        return $this->belongsTo(\App\Models\propertyarea::class, 'proparea_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\provider::class, 'provider_id', 'id');
    }
}
