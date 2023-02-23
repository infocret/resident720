<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonaImagesidsRequest;
use App\Http\Requests\UpdatePersonaImagesidsRequest;
use App\Repositories\PersonaImagesidsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon; //agregado JB

class PersonaImagesidsController extends AppBaseController
{
    /** @var  PersonaImagesidsRepository */
    private $personaImagesidsRepository;

    public function __construct(PersonaImagesidsRepository $personaImagesidsRepo)
    {
        $this->personaImagesidsRepository = $personaImagesidsRepo;
    }

    /**
     * Display a listing of the PersonaImagesids.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //dd(new RequestCriteria($request));
        $this->personaImagesidsRepository->pushCriteria(new RequestCriteria($request));
        $personaImagesids = $this->personaImagesidsRepository->all();

        return view('persona_imagesids.index')
            ->with('personaImagesids', $personaImagesids);
    }

    /**
     * Show the form for creating a new PersonaImagesids.
     *
     * @return Response
     */
    public function create()
    {
        return view('persona_imagesids.create');
    }

    /**
     * Store a newly created PersonaImagesids in storage.
     *
     * @param CreatePersonaImagesidsRequest $request
     *
     * @return Response
     */
    public function store(CreatePersonaImagesidsRequest $request)
    {
        $input = $request->all();
        //dd($input);
        $personaImagesids = $this->personaImagesidsRepository->create($input);

        Flash::success('Persona Imagesids saved successfully.');

        return redirect(route('personaImagesids.index'));
    }

    
    /**
     * Display the specified PersonaImagesids.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $personaImagesids = $this->personaImagesidsRepository->findWithoutFail($id);

        if (empty($personaImagesids)) {
            Flash::error('Persona Imagesids not found');

            return redirect(route('personaImagesids.index'));
        }

        return view('persona_imagesids.show')->with('personaImagesids', $personaImagesids);
    }

    /**
     * Show the form for editing the specified PersonaImagesids.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $personaImagesids = $this->personaImagesidsRepository->findWithoutFail($id);

        if (empty($personaImagesids)) {
            Flash::error('Persona Imagesids not found');

            return redirect(route('personaImagesids.index'));
        }

        return view('persona_imagesids.edit')->with('personaImagesids', $personaImagesids);
    }

    /**
     * Update the specified PersonaImagesids in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaImagesidsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersonaImagesidsRequest $request)
    {
        $personaImagesids = $this->personaImagesidsRepository->findWithoutFail($id);

        if (empty($personaImagesids)) {
            Flash::error('Persona Imagesids not found');

            return redirect(route('personaImagesids.index'));
        }

        $personaImagesids = $this->personaImagesidsRepository->update($request->all(), $id);

        Flash::success('Persona Imagesids updated successfully.');

        return redirect(route('personaImagesids.index'));
    }

    /**
     * Remove the specified PersonaImagesids from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $personaImagesids = $this->personaImagesidsRepository->findWithoutFail($id);

        if (empty($personaImagesids)) {
            Flash::error('Persona Imagesids not found');

            return redirect(route('personaImagesids.index'));
        }
        
        $deletefile =  'box/'.env('FOLDER_IMGIDS').'/'.$personaImagesids->filename; 
        
        $this->personaImagesidsRepository->delete($id);  

        if (file_exists($deletefile)) {
            
                if (unlink($deletefile)) {
                    Flash::success(
                    'Se elimino el registro y el archivo de imagen.');
                }
                else{                  
                
                    Flash::success(
                    'Se elimino el registro, NO se elimino archivo cargado:'.$deletefile);
               }   
            }
        else{
             Flash::success(
                'Se elimino el registro. NO se encontro archivo:'.$deletefile);
        }

        return redirect(route('personaImagesids.index'));
    }
//****************************************************** UPLOAD IMAGEN ID **********************
//  Presenta vista para seleccionar archivo
    public function uploadForm($persexpid)
    {
       //$StPath='../storage/app/public/imagen/';
       $filename="";
       $path="";
       //dd($persexpid);
       return view('persona_imagesids.upload')
       ->with('filename', $filename)
       ->with('path', $path)
        ->with('persexpid', $persexpid);
    }



/**
     * Sube imagen de perfil al servidor
     *
     * @param int              $id
     * @return Response    //
     */
    public function uploadImgid(Request $request)  
    {  
  
   //dd(public_path('box'));
      
    if ($request->hasfile('Archivo')){   
      $file=$request->file('Archivo');   
  
    
      // generar nombre con el nombre original y la fecha actual
          // $filename=$file->getClientOriginalName();  
          // $idfecha=carbon::now()->format('ymdhms');
          // $filename=$idfecha.$filename; 
      
      // generar el nombre con los datos de la persona y su id
            //$persona = $this->personaRepository->findWithoutFail($persexpid); 
            // $filename= 
           // $persona->appat.substr($persona->apmat,0,1).
           // substr($persona->name,0,1).$persona->id.".png";

        
        if  ($file->getClientMimeType()=="image/png"){
            $personaname=$request->session()->get('nomexp');
            $splitname=explode(" ",$personaname);
            $arrcount=count($splitname);   

            $filename=""; 
            $filename = $splitname[$arrcount-2].$splitname[$arrcount-1].$splitname[0];
            $idfecha=carbon::now()->format('ymdhms');
            $filename=$filename.$idfecha.'.png';
            
            //$path = $file->storeAs('box/imgids',$filename,'publicdev'); // se toma de filesystem.php     
          
            //storageAS( <'Foldername'>,<'FileName'>[,<DiskName] )                       
            $path = $file->storeAs('/'.env('FOLDER_IMGIDS').'/',$filename,'publicbox'); 
            // se forma la ruta relativa a dir public : box/imgids/
            // ruta completa public_html/box/imgids/ 
            // FOLDER_IMGIDS - se toma de las variables del archivo .env           
            // publicbox - se toma de filesystem.php   
                 
            //dd($path);
            $personaexpid=$request->session()->get('personaexpid');
            Flash::success('Carga de archivo correcta en: '.$path);
            
            //return view('filesUp.index')
            return view('persona_imagesids.CreateUp')
            ->with('filename', $filename)
            ->with('path', $path)
            ->with('personaexpid',$personaexpid);

        }
        else{
             $filename=$file->getClientOriginalName();  
          Flash::error('El archivo: '.$filename.' NO es una imagen valida.');
            return view('persona_imagesids.upload');
        }
     }
     else{        
        Flash::error('No se selecciono ningun archivo.'); 
               return view('persona_imagesids.upload');
     }   
    
   
    }


     // Presenta imagen cargada en el servidor y permite guardar en Base de Datos     
     
    public function storeupload(CreatePersonaImagesidsRequest $request)
    {
        $input = $request->all();
        //dd($input);
        $personaImagesids = $this->personaImagesidsRepository->create($input);
        //dd($personaImagesids);
        $personaexpid=$personaImagesids->persona_id;
        $result = $this->personaImagesidsRepository->gUpdateImgId($personaexpid,$personaImagesids->id);
        //$personaexpid=$request->session()->get('personaexpid');
        //dd($result);       
        Flash::success('Imagen actualizada.');
        return redirect(route('personaexp.index', [$personaexpid]));
    }

     public function delfileimgid($filename)
     {
        //dd('ya');
        //$deletefile = public_path().env('PATH_IMGIDS').$filename;
        //$deletefile = url(env('PATH_IMGIDS')).$filename;
        $deletefile = 'box/'.env('FOLDER_IMGIDS').'/'.$filename;
      
        //dd($deletefile);
        //Storage::delete($deletefile);
       //File::delete($deletefile);
        $personaexpid=Session()->get('personaexpid');

        if (file_exists($deletefile)) {
            
                if (unlink($deletefile)) {
                    Flash::success(
                    'Cancelado el cambio de imagen, se elimino archivo cargado.');
                }
                else{                  
                
                    Flash::success(
                    'Cancelado el cambio de imagen, NO se elimino archivo cargado.'.$deletefile);
               }   
            }
        else{
             Flash::success(
                'Cancelado el cambio de imagen. NO se encontro archivo:'.$deletefile);
        }

        return redirect(route('personaexp.index', [$personaexpid]));
    }
//************************************************************************************
    public function showimgids(Request $request,$persexpid)
     {
         //dd(new RequestCriteria($request));
        $this->personaImagesidsRepository->pushCriteria(new RequestCriteria($request));
        $personaImagesids = $this->personaImagesidsRepository->all()
        ->where('persona_id',$persexpid)
        ->where('activ','<>','1');


            //dd($personaImagesids);

       //$personaexpid=Session()->get('personaexpid');        
        //Flash::success('Cancelado el cambio de imagen, se elimino archivo cargado.');
       
       return view('persona_imagesids.showimgids')
       ->with('personaImagesids',$personaImagesids);
        //return redirect(route('personaexp.index', [$personaexpid]));
    }
     
     // Presenta galeria de imagenes que se han subido para ese perfil y permite seleccionar una como activa
     // Cambiando la imagen de perfil
     public function selimgids(Request $request,$imagenid)
     {
        $personaexpid=Session()->get('personaexpid');

        //dd('exp:'.$personaexpid.' imgid:'.$imagenid);

        $result = $this->personaImagesidsRepository
        ->gUpdateImgId($personaexpid,$imagenid);
        
        Flash::success('Imagen actualizada.');

        return redirect(route('personaexp.index', $personaexpid));

     }

     



}
