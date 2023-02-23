<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class propertyservice
 * @package App\Models
 * @version July 28, 2018, 4:36 am UTC
 *
 * @property string cve
 * @property string shortname
 * @property string name
 * @property string description
 * @property string content
 * @property string privileges
 * @property string obligations
 */
class propertyservice extends Model
{
    use SoftDeletes;

    public $table = 'propertyservices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cve',
        'shortname',
        'name',
        'description',
        'content',
        'privileges',
        'obligations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cve' => 'string',
        'shortname' => 'string',
        'name' => 'string',
        'description' => 'string',
        'content' => 'string',
        'privileges' => 'string',
        'obligations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:3|min:3',
        'shortname' => 'required|max:8|min:3',
        'name' => 'required|max:25|min:3',
        'description' => 'required|max:50|min:3',
        'content' => 'required|max:150|min:3',
        'privileges' => 'required|max:150|min:3',
        'obligations' => 'required|max:150|min:3'
    ];

    
}
