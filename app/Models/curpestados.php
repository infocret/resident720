<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class curpestados
 * @package App\Models
 * @version April 4, 2018, 12:34 am UTC
 *
 * @property string estado
 * @property string renapo
 * @property string abrev
 * @property string dosdig
 * @property string iso
 */
class curpestados extends Model
{
    use SoftDeletes;

    public $table = 'curpestados';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'estado',
        'renapo',
        'abrev',
        'dosdig',
        'iso'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'estado' => 'string',
        'renapo' => 'string',
        'abrev' => 'string',
        'dosdig' => 'string',
        'iso' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'estado' => 'required|max:25|min:3',
        'renapo' => 'required|max:2|min:2',
        'abrev' => 'required|max:10|min:2',
        'dosdig' => 'required|max:8|min:2',
        'iso' => 'required|max:10|min:2'
    ];

    
}
