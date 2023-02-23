<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class perioddate
 * @package App\Models
 * @version July 28, 2018, 6:13 am UTC
 *
 * @property \App\Models\period period
 * @property integer period_id
 * @property date date
 * @property integer yearday
 * @property string action
 * @property string status
 * @property string observations
 */
class perioddate extends Model
{
    use SoftDeletes;

    public $table = 'perioddates';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'period_id',
        'date',
        'yearday',
        'action',
        'status',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'period_id' => 'integer',
        'date' => 'date',
        'yearday' => 'integer',
        'action' => 'string',
        'status' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required',
        'yearday' => 'required|max:370|min:1',
        'action' => 'required|max:60|min:3',
        'status' => 'required|max:15|min:3',
        'observations' => 'required|max:150|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function period()
    {
        return $this->belongsTo(\App\Models\period::class, 'period_id', 'id');
    }
}
