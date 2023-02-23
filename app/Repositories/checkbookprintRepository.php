<?php

namespace App\Repositories;

use App\Models\checkbookprint;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class checkbookprintRepository
 * @package App\Repositories
 * @version March 27, 2020, 2:11 am UTC
 *
 * @method checkbookprint findWithoutFail($id, $columns = ['*'])
 * @method checkbookprint find($id, $columns = ['*'])
 * @method checkbookprint first($columns = ['*'])
*/
class checkbookprintRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'desc',
        'imgsample',
        'cssfile'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return checkbookprint::class;
    }
}
