<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class unidadmovto
 * @package App\Models
 * @version September 2, 2019, 6:25 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\catmovto catmovto
 * @property integer inmu_id
 * @property integer movto_id
 * @property string periodap
 * @property string validity
 * @property decimal amount
 * @property dateTime nextap
 * @property dateTime endvalidity
 * @property string observ
 */
class unidadmovto extends Model
{
    use SoftDeletes;

    public $table = 'unidadmovtos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmu_id',
        'movto_id',
        'periodap',
        'validity',
        'amount',
        'nextap',
        'endvalidity',
        'observ'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmu_id' => 'integer',
        'movto_id' => 'integer',
        'periodap' => 'string',
        'validity' => 'string',
        'nextap' => 'datetime',
        'endvalidity' => 'datetime',
        'observ' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'periodap' => 'required|max:25|min:1',
        'validity' => 'required|max:25|min:1',
        'amount' => 'required|max:9999999|min:0',
        'nextap' => 'required',
        'endvalidity' => 'required',
        'observ' => 'required|max:250|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmu_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function catmovto()
    {
        return $this->belongsTo(\App\Models\catmovto::class, 'movto_id', 'id');
    }
}
