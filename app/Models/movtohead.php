<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class movtohead
 * @package App\Models
 * @version July 27, 2018, 2:53 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\propertyarea propertyarea
 * @property \App\Models\provider provider
 * @property integer inmueble_id
 * @property integer propertyarea_id
 * @property integer provider_id
 * @property string movtype
 * @property dateTime fechafactura
 * @property string folio
 * @property string doc_link
 * @property decimal stotal
 * @property decimal iva
 * @property decimal gtotal
 * @property string status
 */
class movtohead extends Model
{
    use SoftDeletes;

    public $table = 'movtoheads';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'propertyarea_id',
        'provider_id',
        'movtype',
        'fechafactura',
        'folio',
        'doc_link',
        'stotal',
        'iva',
        'gtotal',
        'status'
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
        'movtype' => 'string',
        'fechafactura' => 'datetime',
        'folio' => 'string',
        'doc_link' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'movtype' => 'required|max:1|min:1',
        'fechafactura' => 'required',
        'folio' => 'required|max:21|min:1',
        'doc_link' => 'required|max:150|min:1',
        'stotal' => 'required|max:19|min:1',
        'iva' => 'required|max:19|min:1',
        'gtotal' => 'required|max:19|min:1',
        'status' => 'required|max:15|min:1'
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
    public function propertyarea()
    {
        return $this->belongsTo(\App\Models\propertyarea::class, 'propertyarea_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\provider::class, 'provider_id', 'id');
    }
}
