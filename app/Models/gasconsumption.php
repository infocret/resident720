<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class gasconsumption
 * @package App\Models
 * @version October 1, 2019, 12:53 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property integer inmueble_id
 * @property date reading_date
 * @property decimal last_reading
 * @property decimal current_reading
 * @property decimal quantity
 * @property decimal gas_price
 * @property decimal amount
 * @property date application_date
 */
class gasconsumption extends Model
{
    use SoftDeletes;

    public $table = 'gasconsumptions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'inmucharge_id',
        'reading_date',
        'last_reading',
        'current_reading',
        'quantity',
        'gas_price',
        'amount',
        'application_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'inmucharge_id' => 'integer',
        'reading_date' => 'date',
        'application_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'last_reading' => 'required|max:9999999|min:0',
        'current_reading' => 'required|max:9999999|min:0',
        'quantity' => 'required|max:9999999|min:0',
        'gas_price' => 'required|max:9999999|min:0',
        'amount' => 'required|max:9999999|min:0'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
     public function inmucharge()
    {
        return $this->belongsTo(\App\Models\inmucharge::class, 'inmucharge_id', 'id');
    }
}
