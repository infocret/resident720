<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class bank
 * @package App\Models
 * @version July 26, 2018, 10:26 pm UTC
 *
 * @property string cve
 * @property string ident
 * @property string shortname
 * @property string fullname
 * @property string participates
 * @property string website
 */
class bank extends Model
{
    use SoftDeletes;

    public $table = 'banks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cve',
        'ident',
        'shortname',
        'fullname',
        'participates',
        'website'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cve' => 'string',
        'ident' => 'string',
        'shortname' => 'string',
        'fullname' => 'string',
        'participates' => 'string',
        'website' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:3|min:3',
        'ident' => 'required|max:8|min:2',
        'shortname' => 'required|max:16|min:2',
        'fullname' => 'required|max:50|min:2',
        'participates' => 'required|max:2min:2',
        'website' => 'required|max:150|min:2'
    ];

    
}
