<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InmuebleMedio
 * @package App\Models
 * @version May 2, 2018, 10:45 pm UTC
 *
 * @property \App\Models\medio medio
 * @property \App\Models\inmueble inmueble
 * @property integer medio_id
 * @property integer inmueble_id
 * @property string dato
 * @property string observaciones
 */
class InmuebleMedio extends Model
{
    use SoftDeletes;

    public $table = 'inmueble_medios';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'medio_id',
        'inmueble_id',
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
        'inmueble_id' => 'integer',
        'dato' => 'string',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
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
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }
}
