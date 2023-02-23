<?php

namespace App\Repositories;

use App\Models\gasconsumption;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class gasconsumptionRepository
 * @package App\Repositories
 * @version October 1, 2019, 12:53 am UTC
 *
 * @method gasconsumption findWithoutFail($id, $columns = ['*'])
 * @method gasconsumption find($id, $columns = ['*'])
 * @method gasconsumption first($columns = ['*'])
*/
class gasconsumptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reading_date',
        'last_reading',
        'current_reading',
        'quantity',
        'gas_price',
        'amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return gasconsumption::class;
    }



public function getgasconsum($condomid, $vmonth,$vyear)
{
 return \DB::select('call sp_getgasconsum (?,?,?)', array($condomid,$vmonth,$vyear)); 
}


public function glastlect($unidid)
{
    // SELECT
    // IFNULL(gasconsumptions.current_reading,0)
    // FROM
    // gasconsumptions
    // WHERE
    // gasconsumptions.inmueble_id = 71
    // order by gasconsumptions.reading_date desc limit 1
    //$unidid =71;
    $lectant = gasconsumption::
                SELECT(
                'gasconsumptions.current_reading as lant',
                'gasconsumptions.reading_date as datelant'
                )
                ->where('gasconsumptions.inmueble_id',$unidid)
                ->orderby('gasconsumptions.reading_date','desc')
                ->take(1)
                ->first();

    if (is_null($lectant)) {
        $lectant = new \stdClass();
        $lectant->lant = 0;
        $lectant->datelant = '1971-01-01';       
    }
    
    return $lectant;
}



}
