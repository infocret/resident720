<?php

namespace App\Repositories;

use App\Models\InmuebleImagesids;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InmuebleImagesidsRepository
 * @package App\Repositories
 * @version May 12, 2018, 5:51 am UTC
 *
 * @method InmuebleImagesids findWithoutFail($id, $columns = ['*'])
 * @method InmuebleImagesids find($id, $columns = ['*'])
 * @method InmuebleImagesids first($columns = ['*'])
*/
class InmuebleImagesidsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'link',
        'filename',
        'activ'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InmuebleImagesids::class;
    }
    //########################################################################################3
    // Funcion creada por JB para obtener imagen aactiva de perfil o id
    public function gpropimgid($propertyid) 
    {
        return InmuebleImagesids::select('filename','link')
        ->where('inmueble_id',$propertyid)
        ->where('activ','1')
        ->where('filename','<>','')->first();        
    }

    // Funcion creada por JB para actualizar imagen activa       
    public function gUpdateImgId($propertyid,$InmuebleImagenid) 
    {   
        //dd('PersID:'.$propertyid.' ImgID:'.$InmuebleImagenid);
    return \DB::select('call sp_UpdateInmuebleImgid(?,?)', array($propertyid,$InmuebleImagenid));        
    }

}
