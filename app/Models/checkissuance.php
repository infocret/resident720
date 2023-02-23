<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class checkissuance
 * @package App\Models
 * @version March 27, 2020, 2:07 am UTC
 *
 * @property \App\Models\inmucharges inmucharges
 * @property \App\Models\propaccounts propaccounts
 * @property \App\Models\checkbooks checkbooks
 * @property integer inmucharge_id
 * @property integer propaccount_id
 * @property integer checkbook_id
 * @property boolean incluirleyenda
 * @property string datetext
 * @property string nametext
 * @property string amounttext
 * @property string amountletertext
 * @property string textleyenda
 * @property string status
 * @property string checknum
 * @property string cancelchargeid
 * @property string observ
 */
class checkissuance extends Model
{
    use SoftDeletes;

    public $table = 'checkissuances';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmucharge_id',
        'propaccount_id',
        'checkbook_id',
        'incluirleyenda',
        'datetext',
        'nametext',
        'amounttext',
        'amountletertext',
        'textleyenda',
        'status',
        'checknum',
        'cancelchargeid',
        'observ'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmucharge_id' => 'integer',
        'propaccount_id' => 'integer',
        'checkbook_id' => 'integer',
        'incluirleyenda' => 'boolean',
        'datetext' => 'string',
        'nametext' => 'string',
        'amounttext' => 'string',
        'amountletertext' => 'string',
        'textleyenda' => 'string',
        'status' => 'string',
        'checknum' => 'string',
        'cancelchargeid' => 'string',
        'observ' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'datetext' => 'required|max:20|min:1',
        'nametext' => 'required|max:150|min:1',
        'amounttext' => 'required|max:20|min:1',
        'amountletertext' => 'required|max:150|min:1',
        'textleyenda' => 'required|max:150|min:1',
        'status' => 'required|max:20|min:1',
        'checknum' => 'required|max:20|min:1',
        'cancelchargeid' => 'required|max:20|min:1',
        'observ' => 'required|max:250|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmucharges()
    {
        return $this->belongsTo(\App\Models\inmucharges::class, 'inmucharge_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function propaccounts()
    {
        return $this->belongsTo(\App\Models\propaccounts::class, 'propaccount_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function checkbooks()
    {
        return $this->belongsTo(\App\Models\checkbooks::class, 'checkbook_id', 'id');
    }
}
