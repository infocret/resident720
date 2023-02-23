<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MedioPersona
 * @package App\Models
 * @version February 16, 2018, 9:47 am UTC
 *
 * @property \App\Models\medio medio
 * @property \App\Models\persona persona
 * @property integer medio_id
 * @property integer persona_id
 * @property string dato
 * @property string observaciones
 */
class MedioPersona extends Model
{
    use SoftDeletes;

    public $table = 'medio_personas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'medio_id',
        'persona_id',
        'dato',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'medio_id' => 'integer',
        'persona_id' => 'integer',
        'dato' => 'string',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'medio_id' => 'required',
        'persona_id' => 'required',
        'dato' => 'required|max:50|min:3',
        'observaciones' => 'required|max:100|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function medio()
    {
        return $this->belongsTo(\App\Models\medio::class, 'medio_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function persona()
    {
        return $this->belongsTo(\App\Models\persona::class, 'persona_id', 'id');
    }
}
