<?php

namespace App\Repositories;

use App\Models\PersInmuReltipoReqDoc;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersInmuReltipoReqDocRepository
 * @package App\Repositories
 * @version April 21, 2018, 12:18 am UTC
 *
 * @method PersInmuReltipoReqDoc findWithoutFail($id, $columns = ['*'])
 * @method PersInmuReltipoReqDoc find($id, $columns = ['*'])
 * @method PersInmuReltipoReqDoc first($columns = ['*'])
*/
class PersInmuReltipoReqDocRepository extends BaseRepository
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
        return PersInmuReltipoReqDoc::class;
    }

    //================================================
    // Funcion creada por JB para listar Documentos requeridos para una relacion persona inmueble desde un SP
    public function gPersInmuReltipoReqDocs()  
    {   
        return \DB::select('call sp_cPersInmuReltipoReqDocs');        
    }

    //================================================
    // Funcion creada por JB para listar tipos de documentos desde un SP
    public function gdoctypeLista($trel)  
    {   
        return \DB::select('call sp_cDocTypesLista(?)',array($trel));        
    }

    //================================================
    // Funcion creada por JB para listar tipos de relacion persona inmueble desde un SP
    public function gpersinmreltipos()  
    {   
        return \DB::select('call sp_cPersInmRelTipos');        
    }


}
