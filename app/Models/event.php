<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class event
 * @package App\Models
 * @version August 4, 2018, 6:52 am UTC
 *
 * @property string title
 * @property dateTime start_date
 * @property dateTime end_date
 */
class event extends Model
{
    use SoftDeletes;

    public $table = 'events';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'start_date',
        'end_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:50|min:3',
        'start_date' => 'required',
        'end_date' => 'required'
    ];

    
}
