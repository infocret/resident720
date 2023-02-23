<?php

namespace App\Repositories;

use App\Models\categorieProviders;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class categorieProvidersRepository
 * @package App\Repositories
 * @version May 25, 2018, 7:31 pm UTC
 *
 * @method categorieProviders findWithoutFail($id, $columns = ['*'])
 * @method categorieProviders find($id, $columns = ['*'])
 * @method categorieProviders first($columns = ['*'])
*/
class categorieProvidersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return categorieProviders::class;
    }
//*******************************************************************************
      // Funcion creada por JB para listar categorias de un proveedor
      // $param1  = id de proveedor , id provider o id persona
      // $opcion = 
      //  0 Categorias NO asignadas a proveedor, $param1=provider_id, 
      //  1 Categrias Asignadas a proveedor, $param1=provider_id,  
      //  2 categorias asignadas y no asignadas, $param1=provider_id, 
      //  3 Lista de todas las Categorias, $param1=0
      //  4 Lista de todos los proveedores y lista de sus categorias,$param1=0
      //  5 Lista de proveedores relacionados a una persona 
      //    y lista de sus categorias, $param1= persona_id
      //  6 Proveedor y categorias relacionadas por proveedor 
      //    $param1=provider_id, 
    public function gcategorias($param1,$opcion)  
    {   
        return \DB::select('call sp_cCatProviders(?,?)', array($param1,$opcion));        
    }
//*******************************************************************************

    //Elimina las relaciones cuyo id  recibe en un arreglo o matriz  (array)
    //Se utiliza desde el controlador de provvedor para borrar todas las categorias
    //asignadas a ese provedor
    public function deletecategorias(array $ids)  
    {   

      // Realiza una consulta donde los ids 
      // sean o esten en el array recibido y los elimina
      // Funciona ok pero creo es mas eficiente la otra
      //return categorieProviders::whereIn('id', $ids)->delete();
      
      // con el array de ids de la tabla elimina esos registros
      return categorieProviders::destroy($ids);
       
    }
//*******************************************************************************

    //Inserta las relaciones recibe en un arreglo o matriz  (array)
    //Se utiliza desde el controlador de provvedor para insertar todas las categorias
    //asignadas a ese provedor
    public function insertcategorias(array $catsprovider)  
    {   
      // con el array inserta esos registros
      return categorieProviders::insert($catsprovider); 
    }

}
