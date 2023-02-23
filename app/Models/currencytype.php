<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class currencytype
 * @package App\Models
 * @version July 26, 2018, 10:47 pm UTC
 *
 * @property string territory
 * @property string currency
 * @property string symbol
 * @property string iso_code
 * @property string fractional_unit
 * @property string base_number
 */
class currencytype extends Model
{
    use SoftDeletes;

    public $table = 'currencytypes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'territory',
        'currency',
        'symbol',
        'iso_code',
        'fractional_unit',
        'base_number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'territory' => 'string',
        'currency' => 'string',
        'symbol' => 'string',
        'iso_code' => 'string',
        'fractional_unit' => 'string',
        'base_number' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'territory' => 'required|max:50|min:3',
        'currency' => 'required|max:35|min:3',
        'symbol' => 'required|max:10|min:3',
        'iso_code' => 'required|max:4|min:3',
        'fractional_unit' => 'required|max:6|min:3',
        'base_number' => 'required|max:3|min:3'
    ];

    
}
