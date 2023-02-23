<?php

namespace App\Repositories;

use App\Models\propertyareas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class propertyareasRepository
 * @package App\Repositories
 * @version May 24, 2018, 3:31 am UTC
 *
 * @method propertyareas findWithoutFail($id, $columns = ['*'])
 * @method propertyareas find($id, $columns = ['*'])
 * @method propertyareas first($columns = ['*'])
*/
class propertyareasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'planta',
        'filename',
        'filepath'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return propertyareas::class;
    }

    // Funcion creada por JB para lista areas de un inmueble
    public function gAreas($inmueble_id) 
    {
        return propertyareas::distinct()
        ->select("id","inmueble_id","nombre","descripcion","planta","filename","filepath")
        ->where('inmueble_id','=',$inmueble_id)->get();        
        //->orderBy('id','ASC')->get()->toarray(); 
        //->pluck('tipo','asentamiento','cp');//->tojson(); //->toarray();
    }
   

    // Funcion creada por JB para obtener id de area por nombre 
    public function gareabyname($condomid,$namearea) 
    {

    //SELECT propertyareas.id,propertyareas.descripcion FROM propertyareas 
    //WHERE propertyareas.inmueble_id = vcondomid AND  propertyareas.nombre ='Admin' limit 1;

        //dd($inmueble_id);
        return propertyareas::select("propertyareas.id","propertyareas.descripcion")
        ->where('inmueble_id','=',$condomid)
        ->where('propertyareas.nombre','=',$namearea)
        ->first();        
       }

 // Funcion creada por JB para lista areas de un inmueble para select de egresos
    public function gAreasB($inmueble_id) 
    {
        return propertyareas::        
        where('inmueble_id','=',$inmueble_id)
        ->select("id","descripcion")
        ->get();
        //->orderBy('id','ASC')->get()->toarray(); 
        //->pluck('tipo','asentamiento','cp');//->tojson(); //->toarray();
    }

 // Funcion creada por JB para lista areas de un inmueble para select de egresos
    public function gAreasC($inmueble_id) 
    {
        return propertyareas::    
        where('inmueble_id','=',$inmueble_id)        
        ->pluck("descripcion","id")    ;
        //->toarray();
        //->orderBy('id','ASC')->get()->toarray(); 
        //->pluck('tipo','asentamiento','cp');//->tojson(); //->toarray();
    }



}
