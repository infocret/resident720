<?php

namespace App\Repositories;

use App\Models\FileType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FileTypeRepository
 * @package App\Repositories
 * @version April 20, 2018, 9:49 pm UTC
 *
 * @method FileType findWithoutFail($id, $columns = ['*'])
 * @method FileType find($id, $columns = ['*'])
 * @method FileType first($columns = ['*'])
*/
class FileTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    
    protected $fieldSearchable = [
        'ident' => 'like',
        'nombre' => 'like',
        'ext'  => 'like',
        'mimetype'  => 'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FileType::class;
    }
}
