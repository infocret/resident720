<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class relationshipPropertie
 * @package App\Models
 * @version October 5, 2018, 4:23 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\inmueble inmueble
 * @property integer parent_property
 * @property integer son_property
 */
class relationshipPropertie extends Model
{
    use SoftDeletes;

    public $table = 'relationship_properties';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'parent_property',
        'son_property'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_property' => 'integer',
        'son_property' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function parent_property()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'parent_property', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function son_property()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'son_property', 'id');
    }
}
