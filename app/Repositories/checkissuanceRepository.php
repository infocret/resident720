<?php

namespace App\Repositories;

use App\Models\checkissuance;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class checkissuanceRepository
 * @package App\Repositories
 * @version March 27, 2020, 2:07 am UTC
 *
 * @method checkissuance findWithoutFail($id, $columns = ['*'])
 * @method checkissuance find($id, $columns = ['*'])
 * @method checkissuance first($columns = ['*'])
*/
class checkissuanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'incluirleyenda',
        'datetext',
        'nametext',
        'amounttext',
        'amountletertext',
        'textleyenda',
        'status',
        'checknum',
        'cancelchargeid',
        'observ'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return checkissuance::class;
    }

public function gapchecks()
{

 return checkissuance:: select(    
'checkissuances.id',    
'checkissuances.inmucharge_id as egreso_id',
'banks.shortname as bankname',
'bankaccounts.name as acconame',
'bankaccounts.account as account',
'checkbooks.fullname as checkbook',
'checkissuances.nametext as nom',
'checkissuances.amounttext as amount',
'checkissuances.checknum as numcheck',
'checkissuances.status as estatus'
)
->join("checkbooks", "checkissuances.checkbook_id", "=", "checkbooks.id")
->join("bankaccounts", "checkbooks.bankaccount_id", "=", "bankaccounts.id")
->join("banks", "bankaccounts.bank_id", "=", "banks.id")
->orderBy("checkbooks.id")              
->get()
    ;    
}

public function gapcheck($apchid)
{

 return checkissuance:: select(    
'checkissuances.id',    
'checkissuances.inmucharge_id as egreso_id',
'banks.shortname as bankname',
'bankaccounts.name as acconame',
'bankaccounts.account as account',
'checkissuances.checkbook_id as checkbook_id',
'checkbooks.fullname as checkbook',
'checkissuances.datetext as datetext',
'checkissuances.nametext as nom',
'checkissuances.amounttext as amount',
'checkissuances.amountletertext as letamount',
'checkissuances.incluirleyenda as incluir',
'checkissuances.textleyenda as leyenda',
'checkissuances.cancelchargeid as cancelid',
'checkissuances.checknum as numcheck',
'checkissuances.status as estatus',
'checkissuances.observ as observ',
'checkissuances.created_at as creado',
'checkissuances.updated_at as mod'
)
->join("checkbooks", "checkissuances.checkbook_id", "=", "checkbooks.id")
->join("bankaccounts", "checkbooks.bankaccount_id", "=", "bankaccounts.id")
->join("banks", "bankaccounts.bank_id", "=", "banks.id")
->where('checkissuances.id',$apchid)
->orderBy("checkbooks.id")              
->get()
    ;    
}


public function gapchecksbycharge($chargeid)
{

 return checkissuance:: select(    
'checkissuances.id',    
'checkissuances.inmucharge_id as egreso_id',
'banks.shortname as bankname',
'bankaccounts.name as acconame',
'bankaccounts.account as account',
'checkissuances.checkbook_id as checkbook_id',
'checkbooks.fullname as checkbook',
'checkissuances.datetext as datetext',
'checkissuances.nametext as nom',
'checkissuances.amounttext as amount',
'checkissuances.amountletertext as letamount',
'checkissuances.incluirleyenda as incluir',
'checkissuances.textleyenda as leyenda',
'checkissuances.cancelchargeid as cancelid',
'checkissuances.checknum as numcheck',
'checkissuances.status as estatus',
'checkissuances.observ as observ',
'checkissuances.created_at as creado',
'checkissuances.updated_at as mod'
)
->join("checkbooks", "checkissuances.checkbook_id", "=", "checkbooks.id")
->join("bankaccounts", "checkbooks.bankaccount_id", "=", "bankaccounts.id")
->join("banks", "bankaccounts.bank_id", "=", "banks.id")
->where('checkissuances.inmucharge_id',$chargeid)
->orderBy("checkbooks.id")              
->get()
    ;    
}


// SELECT
// SUM(
// cast(
// checkissuances.amounttext as decimal(12,2)
// )
// )as amount
// FROM
// checkissuances
// where 
// checkissuances.inmucharge_id = 943
public function gapcheckssum($chargeid)
{
 return checkissuance:: 
 where('checkissuances.inmucharge_id',$chargeid)
 ->sum('amounttext') 
 ; 
}


}
