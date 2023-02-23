<?php

namespace App\Repositories;

use App\Models\provideraccount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class provideraccountRepository
 * @package App\Repositories
 * @version July 27, 2018, 2:37 am UTC
 *
 * @method provideraccount findWithoutFail($id, $columns = ['*'])
 * @method provideraccount find($id, $columns = ['*'])
 * @method provideraccount first($columns = ['*'])
*/
class provideraccountRepository extends BaseRepository
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
        return provideraccount::class;
    }

    // Funcion creada por JB para obtener la cuenta asignada para rel proveedor
        // SELECT
        // provideraccounts.provider_id,
        // banks.id,
        // provideraccounts.bankaccount_id,
        // provideraccounts.checkbook_id
        // FROM
        // provideraccounts
        // INNER JOIN bankaccounts ON provideraccounts.bankaccount_id = bankaccounts.id
        // INNER JOIN banks ON bankaccounts.bank_id = banks.id
        // WHERE
        // provideraccounts.provider_id = 56
     // Funcion creada por JB para obtener la cuenta asignada para rel proveedor
    public function gcta($provid)  // $provider_id
    {
        return
        provideraccount::
        select(      
        'provideraccounts.provider_id',
        'banks.id as bankid',
        'provideraccounts.bankaccount_id',
        'provideraccounts.checkbook_id'           
            )   
        ->join("bankaccounts", "provideraccounts.bankaccount_id", "=",
              "bankaccounts.id")    
        ->join("banks", "bankaccounts.bank_id", "=",
              "banks.id") 
         ->where("provideraccounts.provider_id",$provid)              
         ->first() //get() // ->toarray()       
        ;        
    }        
//*******************************************************************************

    //Elimina las relaciones cuyo id  recibe en un arreglo o matriz  (array)
    //Se utiliza desde el controlador de provvedor para borrar todas las categorias
    //asignadas a ese provedor
    public function deleteaccounts(array $ids)  
    {   
      
      // con el array de ids de la tabla elimina esos registros
      return provideraccount::destroy($ids);
       
    }
//*******************************************************************************


}
