<?php

namespace App\Repositories;

use App\Models\DocType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocTypeRepository
 * @package App\Repositories
 * @version April 20, 2018, 10:23 pm UTC
 *
 * @method DocType findWithoutFail($id, $columns = ['*'])
 * @method DocType find($id, $columns = ['*'])
 * @method DocType first($columns = ['*'])
*/
class DocTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'sizemin',
        'sizemax'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DocType::class;
    }

    //================================================
    // Funcion creada por JB para listar tipos de documentos con descripcion de tipos de archivo
    public function gtdocs()  
    {   
        return \DB::select('call sp_cTDocs');        
    }

    //================================================
    // Funcion creada por JB para listar tipos de archivos desde un SP
    public function gfiletypeLista()  
    {   
        return \DB::select('call sp_cFileTypesLista');        
    }
}

