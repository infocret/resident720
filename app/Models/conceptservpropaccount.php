<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class conceptservpropaccount
 * @package App\Models
 * @version October 1, 2019, 6:55 pm UTC
 *
 * @property \App\Models\conceptservice conceptservice
 * @property \App\Models\propaccounts propaccounts
 * @property integer conceptservices_id
 * @property integer propaccounts_id
 * @property string t_use
 * @property string bank_agreement
 * @property string bank_reference
 * @property string reciptext
 * @property string description
 * @property string observ
 */
class conceptservpropaccount extends Model
{
    use SoftDeletes;

    public $table = 'conceptservpropaccounts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'conceptservices_id',
        'propaccounts_id',
        't_use',
        'bank_agreement',
        'bank_reference',
        'reciptext',
        'description',
        'observ'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'conceptservices_id' => 'integer',
        'propaccounts_id' => 'integer',
        't_use' => 'string',
        'bank_agreement' => 'string',
        'bank_reference' => 'string',
        'reciptext' => 'string',
        'description' => 'string',
        'observ' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        't_use' => 'required|max:8|min:1',
        'bank_agreement' => 'required|max:50|min:1',
        'bank_reference' => 'required|max:50|min:1',
        'reciptext' => 'required|max:250|min:1',
        'description' => 'required|max:150|min:1',
        'observ' => 'required|max:150|min:1'
    ];

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
    public function propaccounts()
    {
        return $this->belongsTo(\App\Models\propaccounts::class, 'propaccounts_id', 'id');
    }
}
