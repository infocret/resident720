<?php

namespace App\Models;
use Jenssegers\Date\Date;               // manejo de fechas en español 
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class inmueble
 * @package App\Models
 * @version February 16, 2018, 8:24 am UTC
 *
 * @property \App\Models\InmuebleTipo inmuebleTipo
 * @property integer inmuebletipo_id
 * @property string ident
 * @property string nombre
 * @property string descripcion
 */
class inmueble extends Model
{
    use SoftDeletes;

    public $table = 'inmuebles';

    //Agregar esta linea con el array de campos de fecha que se desean manipular con carbon en Blade
    protected $dates = ['updated_at','created_at','deleted_at',];    


    public $fillable = [
        'inmuebletipo_id',
        'ident',
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmuebletipo_id' => 'integer',
        'ident' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ident' => 'required|max:8',
        'nombre' => 'required|max:25',
        'descripcion' => 'required|max:50'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmuebleTipo()
    {
        return $this->belongsTo(\App\Models\InmuebleTipo::class, 'inmuebletipo_id', 'id');
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function headmov()
    {
        return $this->hasMany(\App\Models\headmov::class,  'inmuebletipo_id', 'id');
    }
//*************************************************************************************
    
       // Manejo de fechas en español 
    public function getCreatedAtAttribute($created_at)
    {
        //dd('entro en modelo');
        return new Date($created_at);
    }
       // Manejo de fechas en español 
    public function getUpdatedAtAttribute($updated_at)
    {
        //dd('entro en modelo');
        return new Date($updated_at);
    }
    
//****************************************************************************************    
}
