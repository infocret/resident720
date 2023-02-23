<?php

namespace App\Models;

//use App\Traits\DatesTranslator;
use Jenssegers\Date\Date;               // manejo de fechas en español 
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Carbon\Carbon;

/**
 * Class persona
 * @package App\Models
 * @version April 2, 2018, 3:15 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection MedioPersona
 * @property \Illuminate\Database\Eloquent\Collection PersonaDir
 * @property string name
 * @property string appat
 * @property string apmat
 * @property string lugarnac
 * @property dateTime datebirth
 * @property string genero
 * @property string rfc
 * @property string curp
 * @property string nss
 */
class persona extends Model
{

    use SoftDeletes;

    public $table = 'personas';
    
//Agregar esta linea con el array de campos de fecha que se desean manipular con carbon en Blade
    protected $dates = ['updated_at','created_at','deleted_at','datebirth',];


    public $fillable = [
        'name',
        'appat',
        'apmat',
        'lugarnac',
        'datebirth',
        'genero',
        'rfc',
        'curp',
        'nss'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'appat' => 'string',
        'apmat' => 'string',
        'lugarnac' => 'string',
        'datebirth' => 'datetime',
        'genero' => 'string',
        'rfc' => 'string',
        'curp' => 'string',
        'nss' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:25',
        'appat' => 'required|max:25',
        'apmat' => 'required|max:25',
        'lugarnac' => 'required|min:3|max:50',
        'datebirth' => 'required',
        'genero' => 'required|min:5|max:10',
        'rfc' => 'required|max:13',
        'curp' => 'required|max:18',
        'nss' => 'required|max:11'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function medioPersonas()
    {
        return $this->hasMany(\App\Models\MedioPersona::class, 'persona_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function personaDirs()
    {
        return $this->hasMany(\App\Models\PersonaDir::class, 'persona_id', 'id');
    }
//*************************************************************************************
    
   // Manejo de fechas en español 
    public function getDatebirthAttribute($datebirth)
    {
        //dd('entro en modelo');
        return new Date($datebirth);
    }
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
   //  public function setDatebirthAttribute($value){
   // if (($timestamp = strtotime(str_replace("/", "-", $value))) === false){
   //    $this->attributes['datebirth'] = null;
   // } else {
   //    $this->attributes[' datebirth'] = date('Ymd', $timestamp) ;
   // }
   //  }
//****************************************************************************************
 // public function getDatebirthAttribute($value){
 //    dd($value);
 //    return date('d/m/Y', $value);
 // }

//****************************************************************************************
}
