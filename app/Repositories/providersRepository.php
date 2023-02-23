<?php

namespace App\Repositories;

use App\Models\providers;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class providersRepository
 * @package App\Repositories
 * @version May 24, 2018, 2:48 am UTC
 *
 * @method providers findWithoutFail($id, $columns = ['*'])
 * @method providers find($id, $columns = ['*'])
 * @method providers first($columns = ['*'])
*/
class providersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo' => 'like',
        'nomcorto' => 'like',
        'razonsocial' => 'like',
        'rfcmoral' => 'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return providers::class;
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
      //  6 Lista de proveedor y personas relacionadas por proveedor 
      //    $param1=provider_id, 
    public function gcategorias($param1,$opcion)  
    {   
        return \DB::select('call sp_cCatProviders(?,?)', array($param1,$opcion));        
    }
    //   ontenr proveedores aplica crit de busqueda para index
    public function getcategorias($param1,$opcion)  
    {   
        return \DB::select('call sp_get_providers(?,?)', array($param1,$opcion));        
    }    

    public function gprovbyname($name)
    {
    //SELECT id, nomcorto, razonsocial, rfcmoral
    //FROM providers WHERE nomcorto = 'ADP'
    $provider =
    providers:: select('id', 'nomcorto', 'razonsocial', 'rfcmoral')
    ->where('nomcorto',$name)
    ->whereNull('providers.deleted_at')
    ->first();
    return $provider;
    }   
// obtiene lista de proveedores para select de egresos
 public function gprovs()
    {    
    $providers =
    providers:: select('id', 'nomcorto', 'razonsocial', 'rfcmoral')
    ->whereNull('providers.deleted_at')
    ->orderby('nomcorto')
    ->get();
    return $providers;
    }   
// obtiene lista de proveedores para lista
 public function gproveedores()
    {    
    $providers =
    providers:: select(
    'personas.name',
    'personas.appat',
    'personas.apmat',
    'providers.id',
    'providers.persona_id',
    'providers.tipo',
    'providers.nomcorto',
    'providers.razonsocial',
    'providers.rfcmoral'
    )
    ->join("personas", "personas.id", "=",
              "providers.persona_id")         
    ->orderby('providers.nomcorto')
    ->whereNull('providers.deleted_at')
    ->get();
    return $providers;
    }       

// SELECT
// providers.id AS providerid,
// banks.id AS bankid,
// bankaccounts.id AS accountid,
// checkbooks.id as checkbookid,
// banks.shortname AS bankname,
// checkbooks.shortname as checkbookname,
// bankaccounts.`name` AS accountname,
// bankaccounts.clabe AS clabe,
// bankaccounts.account AS account
// FROM
// providers
// INNER JOIN provideraccounts ON provideraccounts.provider_id = providers.id
// INNER JOIN bankaccounts ON provideraccounts.bankaccount_id = bankaccounts.id
// INNER JOIN banks ON bankaccounts.bank_id = banks.id
// INNER JOIN checkbooks ON checkbooks.bankaccount_id = bankaccounts.id AND provideraccounts.checkbook_id = checkbooks.id
// WHERE
// providers.id = 56

// obtiene lista de cuentas del proveedor
 public function gaccounts($provid) {
   $accounts =
    providers:: select(
    'providers.id AS providerid',
    'banks.id AS bankid',
    'bankaccounts.id AS accountid',
    'checkbooks.id as checkbookid',
    'banks.shortname AS bankname',
    'checkbooks.shortname as checkbookname',
    'bankaccounts.name AS accountname',
    'bankaccounts.clabe AS clabe',
    'bankaccounts.account AS account'
    )
    ->join("provideraccounts", "provideraccounts.provider_id", "=","providers.id")         
    ->join("bankaccounts", "provideraccounts.bankaccount_id", "=","bankaccounts.id") 
    ->join("banks", "bankaccounts.bank_id", "=","banks.id")  
    ->join("checkbooks", "checkbooks.bankaccount_id", "=","bankaccounts.id")         
    // ->where('provideraccounts.checkbook_id','checkbooks.id')
    ->where('providers.id',$provid)    
    ->orderby('bankaccounts.id')
    ->get();
    return $accounts;
 }





}
