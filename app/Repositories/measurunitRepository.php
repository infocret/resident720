<?php

namespace App\Repositories;

use App\Models\measurunit;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class measurunitRepository
 * @package App\Repositories
 * @version June 21, 2018, 9:03 pm UTC
 *
 * @method measurunit findWithoutFail($id, $columns = ['*'])
 * @method measurunit find($id, $columns = ['*'])
 * @method measurunit first($columns = ['*'])
*/
class measurunitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'nombre',
        'tipo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return measurunit::class;
    }
    //Obtiene unidad de medida por el nombre
    public function gunidmed($nom)
    {
     return measurunit::where('nombre','=',$nom)->first();   
    }   
    // obtiele lista para select de egresos
    public function gunidmedb()
    {
        return  measurunit::select ('id','cve','nombre')       
        ->orderby('cve')
        ->get();
    }





}
