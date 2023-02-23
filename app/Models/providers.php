<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class providers
 * @package App\Models
 * @version May 24, 2018, 2:48 am UTC
 *
 * @property \App\Models\persona persona
 * @property integer persona_id
 * @property string tipo
 * @property string nomcorto
 * @property string razonsocial
 * @property string rfcmoral
 */
class providers extends Model
{
    use SoftDeletes;

    public $table = 'providers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'persona_id',
        'tipo',
        'nomcorto',
        'razonsocial',
        'rfcmoral'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'persona_id' => 'integer',
        'tipo' => 'string',
        'nomcorto' => 'string',
        'razonsocial' => 'string',
        'rfcmoral' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo' => 'required|max:2|min:2',
        'nomcorto' => 'required|max:10|min:2',
        'razonsocial' => 'required|max:60|min:2',
        'rfcmoral' => 'required|max:13|min:12'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function persona()
    {
        return $this->belongsTo(\App\Models\persona::class, 'persona_id', 'id');
    }
    
    public function categorieprovider()
    {
        return $this->hasMany(\App\Models\categorieProviders::class,'provider_id','id');
    } 

    public function provideraccount()
    {
        return $this->hasMany(\App\Models\provideraccount::class,'provider_id','id');
    }    
 /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function headmov()
    {
        return $this->hasMany(\App\Models\headmov::class, 'provider_id', 'id');
    }

}
