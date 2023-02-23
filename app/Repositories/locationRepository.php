<?php

namespace App\Repositories;

use App\Models\location;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class locationRepository
 * @package App\Repositories
 * @version February 16, 2018, 9:52 am UTC
 *
 * @method location findWithoutFail($id, $columns = ['*'])
 * @method location find($id, $columns = ['*'])
 * @method location first($columns = ['*'])
*/
class locationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ident',
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return location::class;
    }

    public function gUbicaciones()  //$cp,$ciudad)
    {
        return Location::distinct()                       
        ->where('nombre','<>','')
        ->orderBy('nombre','ASC')->pluck('nombre','id');    
    }

}
