<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class personaccount
 * @package App\Models
 * @version July 26, 2018, 11:16 pm UTC
 *
 * @property \App\Models\persona persona
 * @property \App\Models\bankaccount bankaccount
 * @property \App\Models\checkbook checkbook
 * @property integer persona_id
 * @property integer bankaccount_id
 * @property integer checkbook_id
 */
class personaccount extends Model
{
    use SoftDeletes;

    public $table = 'personaccounts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'persona_id',
        'bankaccount_id',
        'checkbook_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'persona_id' => 'integer',
        'bankaccount_id' => 'integer',
        'checkbook_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function persona()
    {
        return $this->belongsTo(\App\Models\persona::class, 'persona_id', 'id');
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
