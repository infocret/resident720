<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class movdetailapplie
 * @package App\Models
 * @version July 27, 2018, 6:17 am UTC
 *
 * @property \App\Models\movtobankaccount movtobankaccount
 * @property \App\Models\movtodetail movtodetail
 * @property integer movtobankaccount_id
 * @property integer movtodetail_id
 * @property dateTime applie_date
 * @property decimal amount_applied
 * @property decimal detail_balance_amount
 */
class movdetailapplie extends Model
{
    use SoftDeletes;

    public $table = 'movdetailapplies';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'movtobankaccount_id',
        'movtodetail_id',
        'applie_date',
        'amount_applied',
        'detail_balance_amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'movtobankaccount_id' => 'integer',
        'movtodetail_id' => 'integer',
        'applie_date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'applie_date' => 'required',
        'amount_applied' => 'required|max:19|min:1',
        'detail_balance_amount' => 'required|max:19|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function movtobankaccount()
    {
        return $this->belongsTo(\App\Models\movtobankaccount::class, 'movtobankaccount_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function movtodetail()
    {
        return $this->belongsTo(\App\Models\movtodetail::class, 'movtodetail_id', 'id');
    }
}
