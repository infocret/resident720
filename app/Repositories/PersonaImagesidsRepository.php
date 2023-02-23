<?php

namespace App\Repositories;

use App\Models\PersonaImagesids;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonaImagesidsRepository
 * @package App\Repositories
 * @version April 2, 2018, 7:44 am UTC
 *
 * @method PersonaImagesids findWithoutFail($id, $columns = ['*'])
 * @method PersonaImagesids find($id, $columns = ['*'])
 * @method PersonaImagesids first($columns = ['*'])
*/
class PersonaImagesidsRepository extends BaseRepository
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
        return PersonaImagesids::class;
    }
//########################################################################################3
    // Funcion creada por JB para obtener imagen aactiva de perfil o id
    public function gimgid($personaid) 
    {
        return PersonaImagesids::select('filename','link')
        ->where('persona_id',$personaid)
        ->where('activ','1')
        ->where('filename','<>','')->first();        
    }

   // Funcion creada por JB para actualizar imagen activa       
    public function gUpdateImgId($personaid,$PersonaImagenid)  //  persona_id , PersonaImagen_id
    {   
        //dd('PersID:'.$personaid.' ImgID:'.$PersonaImagenid);
    return \DB::select('call sp_UpdatePersonaImgid(?,?)', array($personaid,$PersonaImagenid));        
    }
}
