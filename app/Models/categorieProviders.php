<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class categorieProviders
 * @package App\Models
 * @version May 25, 2018, 7:31 pm UTC
 *
 * @property \App\Models\provcat provcat
 * @property \App\Models\provider provider
 * @property integer provcat_id
 * @property integer provider_id
 */
class categorieProviders extends Model
{
    //use SoftDeletes;

    public $table = 'categorie_providers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'provcat_id',
        'provider_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'provcat_id' => 'integer',
        'provider_id' => 'integer'
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
    public function provcat()
    {
        return $this->belongsTo(\App\Models\provcat::class, 'provcat_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\provider::class, 'provider_id', 'id');
    }
}
