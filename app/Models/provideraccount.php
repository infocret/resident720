<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class provideraccount
 * @package App\Models
 * @version July 27, 2018, 2:37 am UTC
 *
 * @property \App\Models\provider provider
 * @property \App\Models\bankaccount bankaccount
 * @property \App\Models\checkbook checkbook
 * @property integer provider_id
 * @property integer bankaccount_id
 * @property integer checkbook_id
 */
class provideraccount extends Model
{
    use SoftDeletes;

    public $table = 'provideraccounts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'provider_id',
        'bankaccount_id',
        'checkbook_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'provider_id' => 'integer',
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
    public function provider()
    {
        return $this->belongsTo(\App\Models\provider::class, 'provider_id', 'id');
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
