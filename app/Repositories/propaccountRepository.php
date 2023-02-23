<?php

namespace App\Repositories;

use App\Models\propaccount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class propaccountRepository
 * @package App\Repositories
 * @version April 10, 2019, 9:14 pm UTC
 *
 * @method propaccount findWithoutFail($id, $columns = ['*'])
 * @method propaccount find($id, $columns = ['*'])
 * @method propaccount first($columns = ['*'])
*/
class propaccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'inmueble_id',
        'bankaccount_id',
        'checkbook_id',
        'bank_agreement'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return propaccount::class;
    }

    //================================================
    // Funcion creada por JB para listar cuentas requeridos para una relacion persona inmueble desde un SP
    public function gCuentas($inmuid, $relid)  
    {  
        return \DB::select('call sp_cPropAccounts(?,?)',array($inmuid,$relid));        
    }

// Funcion creada por JB para lista de chequeras asignadas a un inmueble
    public function gcheckbooks($inmuid)  // inmueble id
    {

    return propaccount::select(    
    'checkbooks.id as checkbook_id',
    'propaccounts.id as propacc_id',
    'banks.shortname as banco',
    // 'banks.id as bank_id',
    // 'bankaccounts.id as bcta_id',
    // 'bankaccounts.name as ctanom',
     'bankaccounts.account as ctanum',
    // 'bankaccounts.clabe as clabe',
    // 'bankaccounts.description as ctadesc',
    // 'bankaccounts.currency_type as moneda',
    // 'bankaccounts.account_type as tipocta',
    // 'bankaccounts.accounting as contable',
    // 'bankaccounts.opening_date as apertura',
    // 'propaccounts.bank_agreement as convenio',
    // 'checkbooks.start as checkini',
    // 'checkbooks.end as checkfin' ,
    'checkbooks.description as checkdesc'    
        )
    ->join("bankaccounts", "propaccounts.bankaccount_id", "=", "bankaccounts.id")
    ->join("banks", "bankaccounts.bank_id", "=", "banks.id")
    ->join("checkbooks", "checkbooks.bankaccount_id", "=", "bankaccounts.id" )    
    ->where("propaccounts.inmueble_id",$inmuid) 
    ->orderBy("checkbooks.id")              
    ->get()
    ;    

    }

    //================================================
    // Funcion creada por JB para listar cuentas requeridos para una relacion persona inmueble desde un SP
    // public function gCuentasB($inmuid)  
    // {   
    //     //dd($inmuid);
    //     $ctas = propaccount:: 
    //     join("bankaccounts","propaccounts.bankaccount_id","=","bankaccounts.id")            
    //     ->join("banks","bankaccounts.bank_id","=","banks.id") 
    //     ->join("checkbooks","checkbooks.bankaccount_id","=","bankaccounts.id")
    //     ->where('propaccounts.checkbook_id','checkbooks.id')
    //     ->where('propaccounts.inmueble_id',$inmuid)        
    //     ->select(      
    //     'propaccounts.id as id',
    //     'banks.shortname as banco',
    //     'bankaccounts.name as ctanom',
    //     'bankaccounts.account as ctanum',
    //     'bankaccounts.description as ctadesc',
    //     'checkbooks.description as checkdesc',
    //     'checkbooks.start as checkini',
    //     'checkbooks.end as checkfin'
    //     )
    //     ->get();       

    //     dd($ctas);
        
    //     $results=$ctas;
    //     return $results;
    // }   
         
}
