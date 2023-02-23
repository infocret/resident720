<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class bankaccount
 * @package App\Models
 * @version July 26, 2018, 10:39 pm UTC
 *
 * @property \App\Models\bank bank
 * @property \App\Models\banksquare banksquare
 * @property integer bank_id
 * @property integer banksquare_id
 * @property string ident
 * @property string name
 * @property string account
 * @property string clabe
 * @property string description
 * @property string currency_type
 * @property dateTime opening_date
 * @property string account_type
 * @property string accounting
 * @property integer allow_overdrafts
 */
class bankaccount extends Model
{
    use SoftDeletes;

    public $table = 'bankaccounts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'bank_id',
        'banksquare_id',
        'ident',
        'name',
        'account',
        'clabe',
        'description',
        'currency_type',
        'opening_date',
        'account_type',
        'accounting',
        'allow_overdrafts'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bank_id' => 'integer',
        'banksquare_id' => 'integer',
        'ident' => 'string',
        'name' => 'string',
        'account' => 'string',
        'clabe' => 'string',
        'description' => 'string',
        'currency_type' => 'string',
        'opening_date' => 'datetime',
        'account_type' => 'string',
        'accounting' => 'string',
        'allow_overdrafts' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ident' => 'required|max:10|min:3',
        'name' => 'required|max:35|min:3',
        'account' => 'required|max:12|min:3',
        'clabe' => 'required|max:20|min:3',
        'description' => 'required|max:50|min:3',
        'currency_type' => 'required|max:3|min:3',
        'opening_date' => 'required',
        'account_type' => 'required|max:3|min:3',
        'accounting' => 'required|max:35|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bank()
    {
        return $this->belongsTo(\App\Models\bank::class, 'bank_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function banksquare()
    {
        return $this->belongsTo(\App\Models\banksquare::class, 'banksquare_id', 'id');
    }

   public function checkbook()
    {
        return $this->hasMany(\App\Models\checkbook::class,'bankaccount_id','id');
    } 
}
