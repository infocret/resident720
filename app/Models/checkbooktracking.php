<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class checkbooktracking
 * @package App\Models
 * @version March 27, 2020, 2:10 am UTC
 *
 * @property \App\Models\checkissuances checkissuances
 * @property \App\Models\users users
 * @property integer checkissuance_id
 * @property integer user_id
 * @property date datereg
 * @property string status
 * @property string observ
 */
class checkbooktracking extends Model
{
    use SoftDeletes;

    public $table = 'checkbooktrackings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'checkissuance_id',
        'user_id',
        'datereg',
        'status',
        'observ'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'checkissuance_id' => 'integer',
        'user_id' => 'integer',
        'datereg' => 'date',
        'status' => 'string',
        'observ' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'datereg' => 'required',
        'status' => 'required|max:20|min:1',
        'observ' => 'required|max:250|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function checkissuances()
    {
        return $this->belongsTo(\App\Models\checkissuances::class, 'checkissuance_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function users()
    {
        return $this->belongsTo(\App\Models\users::class, 'user_id', 'id');
    }
}
