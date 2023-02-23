<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class propaccount
 * @package App\Models
 * @version April 10, 2019, 9:14 pm UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\bankaccount bankaccount
 * @property \App\Models\checkbook checkbook
 * @property integer inmueble_id
 * @property integer bankaccount_id
 * @property integer checkbook_id
 * @property string bank_agreement
 */
class propaccount extends Model
{
    //use SoftDeletes;

    public $table = 'propaccounts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'bankaccount_id',
        'checkbook_id',
        'bank_agreement'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'bankaccount_id' => 'integer',
        'checkbook_id' => 'integer',
        'bank_agreement' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'inmueble_id' => 'required|min:1',
        'bankaccount_id' => 'required|min:1',
        //'checkbook_id' => 'min:1',
        //'bank_agreement' => 'max:50|min:1'
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
    public function bankaccount()
    {
        return $this->belongsTo(\App\Models\bankaccount::class, 'bankaccount_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function checkbook()
    {
        return $this->belongsTo(\App\Models\checkbook::class, 'checkbook_id', 'id');
    }
}
