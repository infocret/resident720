<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class period
 * @package App\Models
 * @version July 28, 2018, 6:05 am UTC
 *
 * @property string cve
 * @property string shortname
 * @property string name
 * @property dateTime start_date
 * @property dateTime final_date
 * @property integer recurrence
 * @property integer interval
 * @property string unit_time
 * @property integer business_days
 * @property integer sub_add_day
 * @property string code
 * @property string observations
 */
class period extends Model
{
    use SoftDeletes;

    public $table = 'periods';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cve',
        'shortname',
        'name',
        'start_date',
        'final_date',
        'recurrence',
        'interval',
        'unit_time',
        'business_days',
        'sub_add_day',
        'code',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cve' => 'string',
        'shortname' => 'string',
        'name' => 'string',
        'start_date' => 'datetime',
        'final_date' => 'datetime',
        'recurrence' => 'integer',
        'interval' => 'integer',
        'unit_time' => 'string',
        'business_days' => 'integer',
        'sub_add_day' => 'integer',
        'code' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:5|min:3',
        'shortname' => 'required|max:8|min:3',
        'name' => 'required|max:30|min:3',
        'start_date' => 'required',
        'final_date' => 'required',
        'recurrence' => 'required|max:500|min:0',
        'interval' => 'required|max:360|min:1',
        'unit_time' => 'required|max:2|min:1',
        'business_days' => 'required|max:1|min:-1',
        'sub_add_day' => 'required|max:360|min:-360',
        'code' => 'required|max:28|min:1',
        'observations' => 'required|max:150|min:1'
    ];

    
}
