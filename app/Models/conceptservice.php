<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class conceptservice
 * @package App\Models
 * @version September 2, 2019, 6:18 am UTC
 *
 * @property integer cve
 * @property string shortname
 * @property string name
 * @property string description
 * @property string observ
 */
class conceptservice extends Model
{
    use SoftDeletes;

    public $table = 'conceptservices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cve',
        'shortname',
        'name',
        'description',
        'observ'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cve' => 'integer',
        'shortname' => 'string',
        'name' => 'string',
        'description' => 'string',
        'observ' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:11999|min:1',
        'shortname' => 'required|max:12|min:1',
        'name' => 'required|max:60|min:1',
        'description' => 'required|max:150|min:1',
        'observ' => 'required|max:250|min:1'
    ];

    
}
