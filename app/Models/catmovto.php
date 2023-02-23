<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class catmovto
 * @package App\Models
 * @version September 2, 2019, 6:22 am UTC
 *
 * @property \App\Models\conceptservice conceptservice
 * @property integer conceptserv_id
 * @property integer cve
 * @property string tipo
 * @property string shortname
 * @property string name
 * @property string description
 * @property string observ
 */
class catmovto extends Model
{
    use SoftDeletes;

    public $table = 'catmovtos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'conceptserv_id',
        'cve',
        'tipo',
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
        'conceptserv_id' => 'integer',
        'cve' => 'integer',
        'tipo' => 'string',
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
        'tipo' => 'required|max:1|min:1',
        'shortname' => 'required|max:12|min:1',
        'name' => 'required|max:60|min:1',
        'description' => 'required|max:150|min:1',
        'observ' => 'required|max:250|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function conceptservice()
    {
        return $this->belongsTo(\App\Models\conceptservice::class, 'conceptserv_id', 'id');
    }
}
