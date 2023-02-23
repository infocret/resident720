<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class headmov
 * @package App\Models
 * @version June 20, 2018, 6:43 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\propertyareas propertyareas
 * @property \App\Models\provider provider
 * @property integer inmueble_id
 * @property integer propertyarea_id
 * @property integer provider_id
 * @property dateTime fecharegistro
 * @property dateTime fechafactura
 * @property string folio
 * @property string doc
 * @property decimal stotal
 * @property decimal iva
 * @property decimal gtotal
 */
class headmov extends Model
{
   //use SoftDeletes;

    public $table = 'headmovs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'propertyarea_id',
        'provider_id',
        'fecharegistro',
        'fechafactura',
        'folio',
        'doc',
        'stotal',
        'iva',
        'gtotal'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'propertyarea_id' => 'integer',
        'provider_id' => 'integer',
        'fecharegistro' => 'datetime',
        'fechafactura' => 'datetime',
        'folio' => 'string',
        'doc' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecharegistro' => 'required',
        'fechafactura' => 'required',
        'folio' => 'required|max:25|min:1',
        'doc' => 'required|max:100|min:1',
        'stotal' => 'required|max:19|min:1',
        'iva' => 'required|max:19|min:1',
        'gtotal' => 'required|max:19|min:1'
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
    public function propertyareas()
    {
        return $this->belongsTo(\App\Models\propertyareas::class, 'propertyarea_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\provider::class, 'provider_id', 'id');
    }

   /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detailmov()
    {
        return $this->hasMany(\App\Models\detailmov::class, 'headmov_id', 'id');
    }    
}
