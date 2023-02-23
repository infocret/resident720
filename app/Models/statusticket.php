<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class statusticket
 * @package App\Models
 * @version July 28, 2018, 2:21 am UTC
 *
 * @property \App\Models\ticket ticket
 * @property \App\Models\user user
 * @property integer ticket_id
 * @property integer user_id
 * @property date status_date
 * @property string status
 * @property string observations
 */
class statusticket extends Model
{
    use SoftDeletes;

    public $table = 'statustickets';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ticket_id',
        'user_id',
        'status_date',
        'status',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ticket_id' => 'integer',
        'user_id' => 'integer',
        'status_date' => 'date',
        'status' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'status_date' => 'true',
        'status' => 'required|max:15|min:3',
        'observations' => 'required|max:150|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function ticket()
    {
        return $this->belongsTo(\App\Models\ticket::class, 'ticket_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\user::class, 'user_id', 'id');
    }
}
