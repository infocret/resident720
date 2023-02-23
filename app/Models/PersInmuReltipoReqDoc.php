<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersInmuReltipoReqDoc
 * @package App\Models
 * @version April 21, 2018, 12:18 am UTC
 *
 * @property \App\Models\persona_inmueble_reltipo personaInmuebleReltipo
 * @property \App\Models\doc_type docType
 * @property integer reltipo_id
 * @property integer doctype_id
 */
class PersInmuReltipoReqDoc extends Model
{
   // use SoftDeletes;    // Esta tabla no puede usar el Soft Delete

    public $table = 'pers_inmu_reltipo_req_docs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'reltipo_id',
        'doctype_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'reltipo_id' => 'integer',
        'doctype_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function personaInmuebleReltipo()
    {
        return $this->belongsTo(\App\Models\PersonaInmuebleReltipo::class, 'reltipo_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function docType()
    {
        return $this->belongsTo(\App\Models\DocType::class, 'doctype_id', 'id');
    }
}
