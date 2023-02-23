<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepersonaRequest;
use App\Http\Requests\UpdatepersonaRequest;
use App\Repositories\personaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Storage;    // para subir archivos
use Carbon\Carbon;
// agregado para llenar lista de lugar de nacimienro
use App\Repositories\curpestadosRepository; 
use App\Repositories\PersonaImagesidsRepository;

class personaController extends AppBaseController
{
    /** @var  personaRepository */
    private $personaRepository;

    public function __construct(
                    personaRepository $personaRepo,
                    curpestadosRepository $curpestadosRepo,
                    PersonaImagesidsRepository $personaImagesidsRepo)
    {
        $this->personaRepository = $personaRepo;
        $this->curpestadosRepository = $curpestadosRepo; 
        $this->PersonaImagesidsRepository= $personaImagesidsRepo;     
    }

    /**
     * Display a listing of the persona.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->personaRepository->pushCriteria(new RequestCriteria($request));
        $personas = $this->personaRepository->paginate(15); //all();

        return view('personas.index')
            ->with('personas', $personas);
    }
/**
     * Display a listing of the persona.
     *
     * @param Request $request
     * @return Response
     */
    public function personaexpindex(Request $request,$persexpid)

    {      
        $persona = $this->personaRepository->findWithoutFail($persexpid);         

        if (empty($persona)) {
            Flash::error('Persona not found');            
            return ('Persona not found');
        }
        else
        {         
         $request->session()->put('personaexpid', $persexpid); // crear variable de session 
         //dd($persona->datebirth->format('l d, F Y'));              
         $nomexp=$persona->name." ".$persona->appat." ".$persona->apmat;
         $request->session()->put('nomexp', $nomexp); // crear variable de session 

          
         $edad = Carbon::parse($persona->datebirth)->age;   
         $imgid=$this->PersonaImagesidsRepository->gimgid($persexpid); 
         //dd($imgid);

          if (empty($imgid)) {
            $imgfilenam="personaid.png";
          }
          else{            
            $imgfilenam=$imgid->filename;
          }     
           $imgeidexp =  $imgfilenam;      
          $request->session()->put('imgeidexp', $imgeidexp); // crear variable de session 
         //$imgfilenam=$imgid->filename;
         //dd($imgfilenam);
         //$imgid=
         //  $persona->appat.substr($persona->apmat,0,1).
         //  substr($persona->name,0,1).$persona->id.".jpg";
         //strtolower($string);
         //$imgid=strtolower($imgid);
         //dd(env('PATH_IMGIDS').$imgid);
         
         return view('expedpersonas.show')
         ->with('persona', $persona)
         ->with('edad', $edad)
         ->with('imgfilenam',$imgfilenam);
        }
    }

    /**
     * Cierra el expediente de una persona.
     *
     * @return Response
     */
    public function personaexpclose(Request $request)
    {
       //$data = $request->session()->all();
       //dd($data);        
        $request->session()->forget('personaexpid');
        //return ($data);
        return redirect()->route("home.index");       
    }

    /**
     * Show the form for creating a new persona.
     *
     * @return Response
     */
    public function create()
    {
        $lugaresnac=$this->curpestadosRepository->gcurpEstados();
        //dd($lugaresnac);
        $orig = 'personidx' ;
        return view('personas.create')
        ->with('lugaresnac', $lugaresnac)
        ->with('orig', $orig)
        ;
    }

    /**
     * Store a newly created persona in storage.
     *
     * @param CreatepersonaRequest $request
     *
     * @return Response
     */
    public function store(CreatepersonaRequest $request)
    {
        $input = $request->all();
       // dd($input);

        $persona = $this->personaRepository->create($input);

        Flash::success('Persona saved successfully.');

        return redirect(route('personas.index'));
    }

    /**
     * Display the specified persona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $persona = $this->personaRepository->findWithoutFail($id);

        //$medios = $persona->medioPersonas->toarray();
        //dd($medios);

        if (empty($persona)) {
            Flash::error('Persona not found');

            return redirect(route('personas.index'));
        }

        return view('personas.show')->with('persona', $persona);
    }

    /**
     * Show the form for editing the specified persona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,$orig)
    {
        $persona = $this->personaRepository->findWithoutFail($id);

        if (empty($persona)) {
            Flash::error('Persona not found');

            return redirect(route('personas.index'));
        }
        $lugaresnac=$this->curpestadosRepository->all()->pluck('estado','renapo');
        //dd($lugaresnac);
        return view('personas.edit')
        ->with('persona', $persona)
        ->with('lugaresnac', $lugaresnac)
        ->with('orig',$orig);
    }

    /**
     * Update the specified persona in storage.
     *
     * @param  int              $id
     * @param UpdatepersonaRequest $request
     *
     * @return Response
     */
    public function update($id,$orig, UpdatepersonaRequest $request)
    {
        // dd($request);
        //dd($orig);
        $persona = $this->personaRepository->findWithoutFail($id);

        if (empty($persona)) {
            Flash::error('Persona not found');

            return redirect(route('personas.index'));
        }

        $persona = $this->personaRepository->update($request->all(), $id);

        Flash::success('Persona updated successfully.');

        if ( $orig == 'expedp' ) {
            return redirect(route('personaexp.index',$id));
        }
        else
        {
            return redirect(route('personas.index'));           
        }
        
    }

// /**
//      * Sube imagen de perfil al servidor
//      *
//      * @param int              $id
//      * @return Response
//      */
//     public function uploadImgid(Request $request,$persexpid)  
//     {  
  
     
//     if ($request->hasfile('Archivo')){   
//       $file=$request->file('Archivo');

//       // generar nombre con el nombre original y la fecha actual
//       //$filename=$file->getClientOriginalName();  
//       //$idfecha=carbon::now()->format('ymdhms');
//       //$filename=$idfecha.$filename; 
      
//       // generar el nombre con los datos de la persona y su id
//         $filename=""; 
//        $persona = $this->personaRepository->findWithoutFail($persexpid);         
//        $filename= 
//             $persona->appat.substr($persona->apmat,0,1).
//             substr($persona->name,0,1).$persona->id.".png";

        
//         if  ($file->getClientMimeType()=="image/png"){
        
//           $path = $file->storeAs('box/imgids',$filename,'publicdev'); // se toma de filesystem.php
          
//           Flash::success('Carga de archivo correcta en: '.$path);
//         }
//         else{
//           Flash::error('El archivo: '.$filename.' NO es una imagen valida.'); 
//         }
//      }
//      else{        
//         Flash::error('No se selecciono ningun archivo.');      
//      }   
    
//       return view('filesUp.index')
//       ->with('filename', $filename)
//        ->with('path', $path);
//     }

//     public function uploadForm()
//     {
//        //$StPath='../storage/app/public/imagen/';
//        $filename="";
//        $path="";
//        return view('filesUp.index')
//        ->with('filename', $filename)
//        ->with('path', $path);
//     }

    /**
     * Muestra ubicaciones de una persona.
     *
     * @param  int $id      // Recibe el id de la persona
     *
     * @return Response     // Array de ubicaciones
     */
    // public function getUbicaciones($id)
    // {

    //     $ubicaciones = $this->personaRepository->gUbicaciones($id);

    //     if (empty($ubicaciones)) {
    //         Flash::error('No se encontraron ubicaciones para esta persona');

    //         return redirect(route('expedPerUbics.index'));
    //     }

    //     return view('expedPerUbics.index')->with('ubicaciones', $ubicaciones);
    // }

//=======================================================================

    /**
     * Remove the specified persona from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $persona = $this->personaRepository->findWithoutFail($id);

        if (empty($persona)) {
            Flash::error('Persona not found');

            return redirect(route('personas.index'));
        }

        $this->personaRepository->delete($id);

        Flash::success('Persona deleted successfully.');

        return redirect(route('personas.index'));
    }
}
