<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class banksquare
 * @package App\Models
 * @version July 26, 2018, 10:32 pm UTC
 *
 * @property string cve
 * @property string square
 */
class banksquare extends Model
{
    use SoftDeletes;

    public $table = 'banksquares';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cve',
        'square'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cve' => 'string',
        'square' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:3|min:3',
        'square' => 'required|max:50|min:3'
    ];

    
}
