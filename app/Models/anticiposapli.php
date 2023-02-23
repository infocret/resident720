<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class anticiposapli
 * @package App\Models
 * @version April 11, 2022, 8:03 pm UTC
 *
 * @property \App\Models\anticipo anticipo
 * @property \App\Models\inmucharge inmucharg
 * @property \App\Models\inmumovto inmumovto
 * @property integer anticipo_id
 * @property integer inmucharg_id
 * @property integer inmumovto_id
 * @property string fechareg
 * @property number saldoini
 * @property number monto
 * @property number saldofin
 * @property string status
 * @property string apmode
 * @property string desc
 * @property string observ
 * @property string userreg
 */
class anticiposapli extends Model
{
    use SoftDeletes;

    public $table = 'anticiposaplis';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'anticipo_id',
        'inmucharg_id',
        'inmumovto_id',
        'fechareg',
        'saldoini',
        'monto',
        'saldofin',
        'status',
        'apmode',
        'desc',
        'observ',
        'userreg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'anticipo_id' => 'integer',
        'inmucharg_id' => 'integer',
        'inmumovto_id' => 'integer',
        'fechareg' => 'datetime',
        'saldoini' => 'float',
        'monto' => 'float',
        'saldofin' => 'float',
        'status' => 'string',
        'apmode' => 'string',
        'desc' => 'string',
        'observ' => 'string',
        'userreg' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fechareg' => 'required',
        'saldoini' => 'required|max:9999999|min:0',
        'monto' => 'required|max:9999999|min:0',
        'saldofin' => 'required|max:9999999|min:0',
        'status' => 'required|max:15|min:1',
        'apmode' => 'required|max:35|min:1',
        'desc' => 'required|max:150|min:1',
        'observ' => 'required|max:250|min:1',
        'userreg' => 'required|max:150|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function anticipo()
    {
        return $this->belongsTo(\App\Models\anticipo::class, 'anticipo_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmucharg()
    {
        return $this->belongsTo(\App\Models\inmucharge::class, 'inmucharg_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmumovto()
    {
        return $this->belongsTo(\App\Models\inmumovto::class, 'inmumovto_id', 'id');
    }
}
