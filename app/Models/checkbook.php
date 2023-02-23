<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class checkbook
 * @package App\Models
 * @version July 26, 2018, 11:01 pm UTC
 *
 * @property \App\Models\bankaccount bankaccount
 * @property integer bankaccount_id
 * @property string shortname
 * @property string fullname
 * @property string description
 * @property string start
 * @property string end
 */
class checkbook extends Model
{
    use SoftDeletes;

    public $table = 'checkbooks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'bankaccount_id',
        'shortname',
        'fullname',
        'description',
        'start',
        'end'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bankaccount_id' => 'integer',
        'shortname' => 'string',
        'fullname' => 'string',
        'description' => 'string',
        'start' => 'string',
        'end' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'shortname' => 'required|max:8|min:3',
        'fullname' => 'required|max:35|min:3',
        'description' => 'required|max:150|min:3',
        'start' => 'required|max:12|min:1',
        'end' => 'required|max:12|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bankaccount()
    {
        return $this->belongsTo(\App\Models\bankaccount::class, 'bankaccount_id', 'id');
    }

}
 