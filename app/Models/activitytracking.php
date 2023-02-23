<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class activitytracking
 * @package App\Models
 * @version July 27, 2018, 6:22 am UTC
 *
 * @property \App\Models\movtobankaccount movtobankaccount
 * @property \App\Models\movtohead movtohead
 * @property \App\Models\checkbook checkbook
 * @property \App\Models\bankaccount bankaccount
 * @property \App\Models\user user
 * @property integer movtobankaccount_id
 * @property integer movtohead_id
 * @property integer checkbook_id
 * @property integer bankaccount_id
 * @property integer user_id
 * @property string act_type
 * @property dateTime activity_date
 * @property string status_applied
 * @property string observations
 */
class activitytracking extends Model
{
    use SoftDeletes;

    public $table = 'activitytrackings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'movtobankaccount_id',
        'movtohead_id',
        'checkbook_id',
        'bankaccount_id',
        'user_id',
        'act_type',
        'activity_date',
        'status_applied',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'movtobankaccount_id' => 'integer',
        'movtohead_id' => 'integer',
        'checkbook_id' => 'integer',
        'bankaccount_id' => 'integer',
        'user_id' => 'integer',
        'act_type' => 'string',
        'activity_date' => 'datetime',
        'status_applied' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'act_type' => 'required|max:15|min:3',
        'activity_date' => 'required',
        'status_applied' => 'required|max:15|min:3',
        'observations' => 'required|max:150|min:3'
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
    public function movtohead()
    {
        return $this->belongsTo(\App\Models\movtohead::class, 'movtohead_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function checkbook()
    {
        return $this->belongsTo(\App\Models\checkbook::class, 'checkbook_id', 'id');
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
    public function user()
    {
        return $this->belongsTo(\App\Models\user::class, 'user_id', 'id');
    }
}
