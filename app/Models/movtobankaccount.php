<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class movtobankaccount
 * @package App\Models
 * @version July 27, 2018, 6:11 am UTC
 *
 * @property \App\Models\movtohead movtohead
 * @property \App\Models\checkbook checkbook
 * @property \App\Models\bankaccount bankaccount
 * @property integer movtohead_id
 * @property integer checkbook_id
 * @property integer bankaccount_id
 * @property string nchbook_ntrx_ref
 * @property string owner
 * @property decimal amount
 * @property integer partial_payment
 * @property string observations
 * @property decimal Head_balance_Amount
 * @property string status
 */
class movtobankaccount extends Model
{
    use SoftDeletes;

    public $table = 'movtobankaccounts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'movtohead_id',
        'checkbook_id',
        'bankaccount_id',
        'nchbook_ntrx_ref',
        'owner',
        'amount',
        'partial_payment',
        'observations',
        'Head_balance_Amount',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'movtohead_id' => 'integer',
        'checkbook_id' => 'integer',
        'bankaccount_id' => 'integer',
        'nchbook_ntrx_ref' => 'string',
        'owner' => 'string',
        'partial_payment' => 'integer',
        'observations' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nchbook_ntrx_ref' => 'required|max:35|min:3',
        'owner' => 'required|max:55|min:3',
        'amount' => 'required|max:19|min:1',
        'observations' => 'required|max:150|min:3',
        'Head_balance_Amount' => 'required|max:19|min:1',
        'status' => 'required|max:15|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function movtohead()
    {
        return $this->belongsTo(\App\Models\movtohead::class, 'movtohead_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function checkbook()
    {
        return $this->belongsTo(\App\Models\checkbook::class, 'checkbook_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bankaccount()
    {
        return $this->belongsTo(\App\Models\bankaccount::class, 'bankaccount_id', 'id');
    }
}
