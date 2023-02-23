<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class countries
 * @package App\Models
 * @version March 19, 2018, 12:20 am UTC
 *
 * @property string continente
 * @property string pais
 * @property string capital
 */
class countries extends Model
{
    use SoftDeletes;

    public $table = 'countries';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'continente',
        'pais',
        'capital'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'continente' => 'string',
        'pais' => 'string',
        'capital' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'continente' => 'required|max:15|min:3',
        'pais' => 'required|max:40|min:3',
        'capital' => 'required|max:40|min:3'
    ];

    
}
