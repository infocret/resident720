<?php

namespace App\Repositories;

use App\Models\bankaccount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class bankaccountRepository
 * @package App\Repositories
 * @version July 26, 2018, 10:39 pm UTC
 *
 * @method bankaccount findWithoutFail($id, $columns = ['*'])
 * @method bankaccount find($id, $columns = ['*'])
 * @method bankaccount first($columns = ['*'])
*/
class bankaccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ident',
        'name',
        'account',
        'clabe',
        'description',
        'currency_type',
        'opening_date',
        'account_type',
        'accounting'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bankaccount::class;
    }

     // Funcion creada por JB para lista de cuentas de un banco (lista desplegable)
    public function gAccounts($bank)  // bank_id
    {
        return bankaccount::distinct()     
        ->where('bank_id',$bank)   
        ->orderBy('name','ASC')
        ->pluck('name','id')->toarray();    
    }

    // Funcion creada por JB para lista de cuentas bancarias
    // SELECT
    // bankaccounts.id,
    // banks.shortname,
    // banksquares.square,
    // bankaccounts.ident,
    // bankaccounts.`name`,
    // bankaccounts.account,
    // bankaccounts.clabe,
    // bankaccounts.description,
    // bankaccounts.account_type,
    // bankaccounts.accounting,
    // bankaccounts.allow_overdrafts
    // FROM
    // banks
    // INNER JOIN bankaccounts ON bankaccounts.bank_id = banks.id
    // INNER JOIN banksquares ON bankaccounts.banksquare_id = banksquares.id
    // **** Funcion creada por JB para lista de cuentas bancarias ***
    public function gbankaccounts()  // 
    {
        return bankaccount::select(
        'bankaccounts.id',
        'banks.shortname',
        'banksquares.square',
        'bankaccounts.ident',
        'bankaccounts.name',
        'bankaccounts.account',
        'bankaccounts.clabe',
        'bankaccounts.description',
        'bankaccounts.account_type',
        'bankaccounts.accounting',
        'bankaccounts.allow_overdrafts' 
        )
        ->join('banks','bankaccounts.bank_id',"=",'banks.id')  
        ->join('banksquares','bankaccounts.banksquare_id',"=",'banksquares.id')         
                    
        ->wherenull('bankaccounts.deleted_at')
        //->orderBy('banks.shortname','ASC')
        ->get();    
    }

 public function gbankaccount($id)  // 
    {
  return bankaccount::select(
        'bankaccounts.id',
        'banks.shortname',
        'banksquares.square',
        'bankaccounts.ident',
        'bankaccounts.name',
        'bankaccounts.account',
        'bankaccounts.clabe',
        'bankaccounts.description',
        'bankaccounts.account_type',
        'bankaccounts.accounting',
        'bankaccounts.allow_overdrafts' 
        )
        ->join('banks','bankaccounts.bank_id',"=",'banks.id')  
        ->join('banksquares','bankaccounts.banksquare_id',"=",'banksquares.id')   
        ->where('bankaccounts.id',$id)                          
        ->wherenull('bankaccounts.deleted_at')
        //->orderBy('banks.shortname','ASC')
        ->first();    
    }


}
