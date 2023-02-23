<?php

namespace App\Repositories;

use App\Models\conceptservpropaccount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class conceptservpropaccountRepository
 * @package App\Repositories
 * @version October 1, 2019, 6:55 pm UTC
 *
 * @method conceptservpropaccount findWithoutFail($id, $columns = ['*'])
 * @method conceptservpropaccount find($id, $columns = ['*'])
 * @method conceptservpropaccount first($columns = ['*'])
*/
class conceptservpropaccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        't_use',
        'bank_agreement',
        'bank_reference',
        'reciptext',
        'description',
        'observ'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return conceptservpropaccount::class;
    }

    // Funcion creada por JB para consultar cuentas relacionadas
    // a un concepto / servicio
    // $id = conceptservices - id del concepto / servmovimientos 
    public function gCtaConcept($cid)  
    {
        // SELECT
        // conceptservices.cve,
        // conceptservices.shortname,
        // banks.shortname,
        // bankaccounts.account,
        // bankaccounts.clabe,
        // conceptservpropaccounts.bank_agreement,
        // conceptservpropaccounts.bank_reference,
        // conceptservpropaccounts.reciptext,
        // conceptservpropaccounts.description
        // FROM
        // conceptservpropaccounts
        // INNER JOIN conceptservices ON 
        // conceptservices.id = conceptservpropaccounts.conceptservices_id
        // INNER JOIN propaccounts ON 
        // conceptservpropaccounts.propaccounts_id = propaccounts.id
        // INNER JOIN bankaccounts ON propaccounts.bankaccount_id = bankaccounts.id
        // INNER JOIN banks ON bankaccounts.bank_id = banks.id
        // where conceptservices.cve = 1100
        $datcta =
        conceptservpropaccount::
        select(      
         'conceptservices.cve AS scve',
         'conceptservices.shortname AS sname',
         'banks.shortname AS bname',
         'bankaccounts.account AS bcta',
         'bankaccounts.clabe AS bclabe',
         'conceptservpropaccounts.bank_agreement AS bconv',
         'conceptservpropaccounts.bank_reference AS bref',
         'conceptservpropaccounts.reciptext AS rtext',
         'conceptservpropaccounts.description AS desc'
           )    
         ->join( "conceptservices",  
             "conceptservices.id","=","conceptservpropaccounts.conceptservices_id")
        ->join("propaccounts", "conceptservpropaccounts.propaccounts_id", "=",
              "propaccounts.id")
        ->join( "bankaccounts",  "propaccounts.bankaccount_id","=", 
              "bankaccounts.id")
        ->join( "banks",  "bankaccounts.bank_id","=", 
              "banks.id")
        ->where( "conceptservices.cve",$cid)         
         //->orderBy("inmucharges.id")              
        ->get()        
        ;    

        if ($datcta->isEmpty()) {
            $datctas = array();
            $datcta = new \stdClass();
            $datcta->scve  = $cid;
            $datcta->sname = 'concepto';
            $datcta->bname = 'sin cuenta';
            $datcta->bcta  = 'sin cuenta';
            $datcta->bclabe = 'sin cuenta';
            $datcta->bconv  = 'sin cuenta';
            $datcta->bref  = 'sin cuenta';
            $datcta->rtext  = 'sin cuenta';
            $datcta->desc  = 'sin cuenta';
             $datctas[0] =  $datcta;
             return $datctas;
        }
        else{
            return $datcta;
        }

       
    }

}
