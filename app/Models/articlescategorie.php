<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class articlescategorie
 * @package App\Models
 * @version July 28, 2018, 4:06 am UTC
 *
 * @property string cve
 * @property string shortname
 * @property string name
 * @property string description
 * @property string observations
 */
class articlescategorie extends Model
{
    use SoftDeletes;

    public $table = 'articlescategories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cve',
        'shortname',
        'name',
        'description',
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
        'description' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:8|min:3',
        'shortname' => 'required|max:8|min:3',
        'name' => 'required|max:20|min:3',
        'description' => 'required|max:35|min:3',
        'observations' => 'required|max:150|min:3'
    ];

    
}
