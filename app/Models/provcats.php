<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class provcats
 * @package App\Models
 * @version May 25, 2018, 7:27 pm UTC
 *
 * @property string tipo
 * @property string categoria
 */
class provcats extends Model
{
    use SoftDeletes;

    public $table = 'provcats';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo',
        'categoria'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tipo' => 'string',
        'categoria' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo' => 'required|max:2|min:2',
        'categoria' => 'required|max:20|min:2'
    ];

    
}
