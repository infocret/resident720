<?php

namespace App\Repositories;

use App\Models\CodPo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CodPoRepository
 * @package App\Repositories
 * @version February 19, 2018, 2:06 am UTC
 *
 * @method CodPo findWithoutFail($id, $columns = ['*'])
 * @method CodPo find($id, $columns = ['*'])
 * @method CodPo first($columns = ['*'])
*/
class CodPoRepository extends BaseRepository
{
    /**
     * @var array
     */
// JB: Se modifico especificando el modo de hacer la comparacion que por default era que fuera igual a // "=" , aqui se especifica el signo de comparacion con un like , y se llama desde la linea asi
    // http://testc1.dev/codPos?search=agri   y trae todo lo que contenga agri   como agricola 
    protected $fieldSearchable = [
        'cp'=>'like',
        'ciudad'=>'like',
        'estado'=>'like',
        'municipio'=>'like',
        'tipo'=>'like',
        'asentamiento'=>'like'        
        //'name'=>'like',
        //'email', // Default Condition "="
        //'your_field'=>'condition'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CodPo::class;
    }

    // Funcion creada por JB para personalizar busqueda y ejecutar paginate
    public function filtrado($request)  //$cp,$ciudad)
    {
        
        //dd($request);
        $cp="%{$request->cp}%";
        $ciudad="%{$request->ciudad}%";
        $estado="%{$request->estado}%";
        $municipio="%{$request->municipio}%";
        $tipo="%{$request->tipo}%";
        $asentamiento="%{$request->asentamiento}%";
        
        // dd( " cp:{$cp}
        //      --ciudad:{$ciudad}
        //      --estado:{$estado}
        //      --municipio:{$municipio}
        //      --tipo:{$tipo}
        //      --asentamiento:{$asentamiento}"
        // );

        return CodPo::where('cp','like', "{$cp}")
         ->where('ciudad','like', "{$ciudad}")
         ->where('estado','like', "{$estado}")
         ->where('municipio','like',"{$municipio}")
         ->where('tipo','like',"{$tipo}")
         ->where('asentamiento','like',"{$asentamiento}")
         ->paginate(10);
    }

 // **************************************************************************************   
 // **************************************************************************************
 // Funcion creada por JB para lista de estados en select (lista desplegable)
    public function gEstados($pais)  //$cp,$ciudad)
    {
        return CodPo::distinct()     
        ->where('estado','<>','')   
        ->orderBy('estado','ASC')
        ->pluck('estado');    
    }
  // Funcion creada por JB para lista de estados en select (lista desplegable)
    public function gEstados2($pais)  //$cp,$ciudad)
    {
        return CodPo::distinct()     
        ->where('estado','<>','')   
        ->orderBy('estado','ASC')
        ->pluck('id','estado')->toarray();    
    }
    // Funcion creada por JB para lista de estados de una ciudad o lista todo si $estado viene vacia
    public function gCiudades($estado)  //$cp,$ciudad)
    { 
        return CodPo::distinct() 
        ->where('estado','like','%'.$estado.'%')      
        ->where('ciudad','<>','')
        ->orderBy('ciudad','ASC')        
        ->pluck('ciudad');    
    }
      // Funcion creada por JB para lista de estados de una ciudad o lista todo si $estado viene vacia
    public function gCiudades2($estado)  //$cp,$ciudad)
    { 
        return CodPo::distinct() 
        ->where('estado','like','%'.$estado.'%')      
        ->where('ciudad','<>','')
        ->orderBy('ciudad','ASC')        
        ->pluck('id','ciudad')->toarray();    
    }

// Funcion creada por JB para lista de municipios de una ciudad o todos si $ciudad viene vacia
    public function gMunicipios($ciudad) 
    {
        return CodPo::distinct()
        ->where('ciudad','like','%'.$ciudad.'%')
        ->where('municipio','<>','')
        ->orderBy('municipio','ASC')->pluck('municipio');//->toarray(); 
    }
// Funcion creada por JB para lista de municipios de una ciudad o todos si $ciudad viene vacia
    public function gMunicipios2($ciudad) 
    {
        return CodPo::distinct()
        ->where('ciudad','like','%'.$ciudad.'%')
        ->where('municipio','<>','')
        ->orderBy('municipio','ASC')->pluck('id','municipio')->toarray();//->toarray(); 
    }
// Funcion creada por JB para lista de municipios devuelve un array de cadenas 
    public function gAsentamientos($municipio) 
    {
        return CodPo::distinct()       
        ->where('municipio','like','%'.$municipio.'%')
        ->where('asentamiento','<>','')
        ->orderBy('asentamiento','ASC')->pluck('asentamiento');
        //->pluck('tipo','asentamiento','cp');//->tojson(); //->toarray();
    }
// Funcion creada por JB para lista de municipios devuelve un array de cadenas 
    public function gAsentamientos3($municipio) 
    {
        return CodPo::distinct()       
        ->where('municipio','like','%'.$municipio.'%')
        ->where('asentamiento','<>','')
        ->orderBy('asentamiento','ASC')->pluck('id','asentamiento')->toarray();
        //->pluck('tipo','asentamiento','cp');//->tojson(); //->toarray();
    }
// Funcion creada por JB para lista de municipios devuelve un array de objetos
    public function gAsentamientos2($municipio) 
    {
        return CodPo::distinct()
        ->select("id","tipo","asentamiento","cp")
        ->where('municipio','like','%'.$municipio.'%')
        ->where('asentamiento','<>','')
        ->orderBy('asentamiento','ASC')->get()->toarray(); 
        //->pluck('tipo','asentamiento','cp');//->tojson(); //->toarray();
    }


}
