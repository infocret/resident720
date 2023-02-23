<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class propertycontractservice
 * @package App\Models
 * @version July 28, 2018, 6:08 am UTC
 *
 * @property \App\Models\contract contract
 * @property \App\Models\propertyservice propertyservice
 * @property \App\Models\period period
 * @property integer contract_id
 * @property integer propertyservice_id
 * @property integer period_id
 * @property decimal amount
 */
class propertycontractservice extends Model
{
    use SoftDeletes;

    public $table = 'propertycontractservices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'contract_id',
        'propertyservice_id',
        'period_id',
        'amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'contract_id' => 'integer',
        'propertyservice_id' => 'integer',
        'period_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amount' => 'required|max:19|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function contract()
    {
        return $this->belongsTo(\App\Models\contract::class, 'contract_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function propertyservice()
    {
        return $this->belongsTo(\App\Models\propertyservice::class, 'propertyservice_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function period()
    {
        return $this->belongsTo(\App\Models\period::class, 'period_id', 'id');
    }
}
