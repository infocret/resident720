<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class inmumovto
 * @package App\Models
 * @version September 2, 2019, 6:32 am UTC
 *
 * @property \App\Models\inmucharge inmucharge
 * @property \App\Models\unidadmovto unidadmovto
 * @property \App\Models\measureunit measureunit
 * @property integer inmucharg_id
 * @property integer unidmovto_id
 * @property integer catmovto_cve
 * @property dateTime date
 * @property string folio
 * @property decimal quantity
 * @property integer measureunit_id
 * @property decimal amount
 * @property decimal balance
 * @property string status
 * @property string apmode
 * @property string description
 * @property string observ
 * @property string filelink
 */
class inmumovto extends Model
{
    use SoftDeletes;

    public $table = 'inmumovtos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmucharg_id',
        'unidmovto_id',
        'catmovto_cve',
        'date',
        'folio',
        'quantity',
        'measurunit_id',
        'amount',
        'balance',
        'status',
        'apmode',
        'description',
        'observ',
        'filelink'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmucharg_id' => 'integer',
        'unidmovto_id' => 'integer',
        'catmovto_cve' => 'integer',
        'date' => 'datetime',
        'folio' => 'string',
        'measurunit_id' => 'integer',
        'status' => 'string',
        'apmode' => 'string',
        'description' => 'string',
        'observ' => 'string',
        'filelink' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'catmovto_cve' => 'required|max:11999|min:1',
        'date' => 'required',
        'folio' => 'required|max:35|min:1',
        'quantity' => 'required|max:9999999|min:0',
        'amount' => 'required|max:9999999|min:0',
        'balance' => 'required|max:9999999|min:0',
        'status' => 'required|max:15|min:1',
        'apmode' => 'required|max:35|min:1',
        'description' => 'required|max:150|min:1',
        'observ' => 'required|max:250|min:1',
        'filelink' => 'required|max:250|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmucharge()
    {
        return $this->belongsTo(\App\Models\inmucharge::class, 'inmucharg_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidadmovto()
    {
        return $this->belongsTo(\App\Models\unidadmovto::class, 'unidmovto_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function measureunit()
    {
        return $this->belongsTo(\App\Models\measureunit::class, 'measureunit_id', 'id');
    }
}
