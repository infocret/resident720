<?php

namespace App\Repositories;

use App\Models\PersonaDocument;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonaDocumentRepository
 * @package App\Repositories
 * @version April 21, 2018, 12:57 am UTC
 *
 * @method PersonaDocument findWithoutFail($id, $columns = ['*'])
 * @method PersonaDocument find($id, $columns = ['*'])
 * @method PersonaDocument first($columns = ['*'])
*/
class PersonaDocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'path',
        'filename',
        'link',
        'activ'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonaDocument::class;
    }
}
