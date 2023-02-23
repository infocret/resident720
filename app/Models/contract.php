<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class contract
 * @package App\Models
 * @version July 28, 2018, 4:30 am UTC
 *
 * @property string cve
 * @property string shortname
 * @property string name
 * @property string descripcion
 * @property string content
 * @property string privileges
 * @property string obligations
 * @property string observations
 */
class contract extends Model
{
    use SoftDeletes;

    public $table = 'contracts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cve',
        'shortname',
        'name',
        'descripcion',
        'content',
        'privileges',
        'obligations',
        'observations'
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
        'descripcion' => 'string',
        'content' => 'string',
        'privileges' => 'string',
        'obligations' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:5|min:3',
        'shortname' => 'required|max:8|min:3',
        'name' => 'required|max:25|min:3',
        'descripcion' => 'required|max:65|min:3',
        'content' => 'required|max:150|min:3',
        'privileges' => 'required|max:150|min:3',
        'obligations' => 'required|max:150|min:3',
        'observations' => 'required|max:150|min:3'
    ];

    
}
