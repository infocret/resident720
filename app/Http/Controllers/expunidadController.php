<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateInmuebleImagesidsRequest;
use App\Http\Requests\UpdateInmuebleImagesidsRequest;
use App\Http\Requests\CreateinmuebleRequest;
//use App\Http\Requests\UpdateinmuebleRequest;
use App\Repositories\InmuebleImagesidsRepository;
use App\Repositories\inmuebleRepository;
use App\Repositories\InmuebleMedioRepository;
use App\Repositories\InmuebleDirRepository;
use App\Repositories\InmuebleTipoRepository;
//use App\Repositories\propertyparameterRepository;
use App\Repositories\propertyvalueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Storage;    // para subir archivos
use Carbon\Carbon;


class expunidadController extends AppBaseController
{
    /** @var  inmuebleRepository */
    //inmuebleRepository $inmuebleRepo,               
    private $inmuebleRepository;

    public function __construct(inmuebleRepository $inmuebleRepo, 
        InmuebleImagesidsRepository $inmuebleImagesidsRepo,
        InmuebleMedioRepository $inmuebleMedioRepo,
        InmuebleDirRepository $inmuebleDirRepo,
        InmuebleTipoRepository $inmuebleTipoRepo,
        propertyvalueRepository $propertyvalueRepo
        //propertyparameterRepository $propertyparameterRepo
    )
    {
        $this->inmuebleRepository = $inmuebleRepo;
        $this->inmuebleImagesidsRepository = $inmuebleImagesidsRepo;
        $this->inmuebleMedioRepository = $inmuebleMedioRepo;
        $this->inmuebleDirRepository = $inmuebleDirRepo;
        $this->inmuebleTipoRepository = $inmuebleTipoRepo;
        //$this->propertyparameterRepository = $propertyparameterRepo;
        $this->propertyvalueRepository = $propertyvalueRepo;
    }

/**
     * Lista informacion del inmueble.
     *
     * @param Request $request
     * @return Response
     */
    public function unidadesindex()
    {
        $propexpid = Session('unidadexpid');     
        //dd($propexpid);
        $unidades = $this->inmuebleRepository->gInmuUnidades($propexpid);
        if (empty($unidades)) {
            Flash::error('No hay unidades asignadas');            
            //return ('No hay unidades asignadas');
        }
            
         return view('unidades.index')
         ->with('unidades',$unidades);
             

    }    

 /**
     * Show the form for creating a new InmuebleMedio.
     *Route::get('/inmumediosexp/create/',['as' => 'inmumediosexp.create', 
     *   'uses' => 'InmuebleMedioexpController@inmumediosreate']); 
     * @return Response
     */
    public function unidadcreate()
    {
        $propexpid = Session('unidadexpid');     
        $inmutipos = $this->inmuebleTipoRepository->gInmuebleTipos('1');
         //dd($inmutipos);
        return view('unidades.create')
          ->with('inmutipos', $inmutipos)
          ->with('propexpid', $propexpid);
    }

/**

/**
     * Guarda un medio de contacto para uninmueble.     
     *Route::post('/unidades',['as' => 'unidades.store', 
        'uses' => 'inmuebleexpController@unidadstore']); //Store 
     * @return Response
     */
    public function unidadstore(CreateinmuebleRequest $request)
    {
        
        $unidadexpid = Session('unidadexpid');  // inmuid tinyint, 
        $paramarray = array();      // Declara un array para parametros de procedimiento
        array_push($paramarray,$unidadexpid); 
        array_push($paramarray,$request->input("inmuebletipo_id","2")); 
        array_push($paramarray,$request->input("ident","99999")); 
        array_push($paramarray,$request->input("nombre","Depto sin nombre"));
        array_push($paramarray,$request->input("descripcion","Depto sin Descripcion"));
        array_push($paramarray,$request->input("namep","Propietario Sin nombre"));
        array_push($paramarray,$request->input("appatp","Sin Apellido Paterno"));
        array_push($paramarray,$request->input("apmatp","Sin Apellido Materno"));
        array_push($paramarray,$request->input("datemailp","N/A"));
        array_push($paramarray,$request->input("datphonep","N/A"));
        array_push($paramarray,$request->input("sendnewsp","NO"));
        array_push($paramarray,$request->input("sendrecipp","NO"));
        array_push($paramarray,$request->input("namei","Inquilino Sin nombre"));
        array_push($paramarray,$request->input("appati","Sin Apellido Paterno"));
        array_push($paramarray,$request->input("apmati","Sin Apellido Materno"));
        array_push($paramarray,$request->input("datemaili","N/A"));
        array_push($paramarray,$request->input("datphonei","N/A"));
        array_push($paramarray,$request->input("sendnewsi","NO"));
        array_push($paramarray,$request->input("sendrecipi","NO"));
       
        $unidadstatus = $this->inmuebleRepository->saveUnidad($paramarray);
        //dd($unidadstatus);        
        if ($unidadstats="OK"){
        Flash::success('Unidad agregada correctamente.');
        }        
        return redirect(route('unidades.index', $unidadexpid ));
    }


/**
     * Lista informacion del inmueble.
     *
     * @param Request $request
     * @return Response
     */
    public function expunidad(Request $request,$propexpid)

    {      
        $inmueble = $this->inmuebleRepository->findWithoutFail($propexpid); 
        $inmumedios =  $this->inmuebleMedioRepository->gMedios($propexpid); 
        $inmuDirs =  $this->inmuebleDirRepository->gUbicaciones($propexpid); 
        //$unidades = $this->inmuebleRepository->gInmuUnidades($propexpid);
        $personas = $this->inmuebleRepository->gPersonas($propexpid);
        $condominos = $this->inmuebleRepository->gCondominos($propexpid);
        $comite = $this->inmuebleRepository->gConomite($propexpid);
        $indivisos = $this->propertyvalueRepository->gIndivlUnid($propexpid);
        $values = $this->propertyvalueRepository->gIndiv1CuotaUnid($propexpid);        
        $indiv1 = $values[0]->indiv1 ;
        $cuota = $values[0]->cuota ;


        if (empty($inmueble)) {
            Flash::error('Inmueble no localizado');            
            return ('Inmueble no localizado');
        }
        else
        {         
         
         $request->session()->put('unidadexpid', $propexpid); // crear variable de session 
         
         //dd($inmueble->datebirth->format('l d, F Y'));              
         $unidnomexp=$inmueble->nombre;
         $request->session()->put('unidnomexp', $unidnomexp); // crear variable de session 

          
         //$edad = Carbon::parse($inmueble->created_at)->age;   
         //$edad = $inmueble->created_at;
         $imgid=$this->inmuebleImagesidsRepository->gpropimgid($propexpid);

        //dd($imgid);

          if (empty($imgid)) {
             $imgfilenam=ENV('DEFAULT_IMGINMU');
           }
          else{            
            $imgfilenam=$imgid->filename;
           }     
           $imgunidexp =  $imgfilenam;      
           $request->session()->put('imgunidexp', $imgunidexp); // crear variable de session 
                 
         return view('expedunidades.show')
         ->with('inmueble', $inmueble)
         ->with('inmuDirs',$inmuDirs)
         ->with('inmumedios',$inmumedios)
         ->with('imgfilenam',$imgfilenam)
         ->with('personas',$personas)
         ->with('condominos',$condominos)
         ->with('comite',$comite)
         ->with('indivisos',$indivisos)
         ->with('indiv1',$indiv1)
         ->with('cuota',$cuota);
        }
    }

  /**
     * Cierra el expediente de un inmueble.
     *
     * @return Response
     */
    public function expunidclose(Request $request)
    {
       //Elimina variables de session
       $request->session()->forget('unidadexpid');
       $request->session()->forget('unidnomexp');
       $request->session()->forget('imgunidexp');
        
        return redirect()->route("home.index");       
    }
// ###############################  Subir imaagenes #################################

//  Presenta vista para seleccionar archivo
//  Route::get('/addimginmu/{propertyid}',['as' => 'imginmu.add', 
//  'uses'=>'inmuebleexpController@uploadForm']);               //Lanza la vista
//  
    public function uploadForm($propertyid)
    {
      
       $filename="";
       $path="";
      
       return view('inmueble_imagesids.upload')
       ->with('filename', $filename)
       ->with('path', $path)
        ->with('propertyid', $propertyid);
    }

/**
     * Sube imagen de inmueble al servidor
     *
     * @param int              $id
     * @return Response    //
     */
    public function uploadImgid(Request $request)  
    {  
      
    if ($request->hasfile('Archivo')){   
      $file=$request->file('Archivo');   
      
      // generar el nombre con los datos del inmueble y su id
        
        if  ($file->getClientMimeType()=="image/png"){
            $unidnomexp=$request->session()->get('unidnomexp');
            $splitname=explode(" ",$unidnomexp);
            $arrcount=count($splitname);   

            $filename=""; 
            $filename = $splitname[$arrcount-2].$splitname[$arrcount-1].$splitname[0];
            $idfecha=carbon::now()->format('ymdhms');
            $filename=$filename.$idfecha.'.png';
          
            //storageAS( <'Foldername'>,<'FileName'>[,<DiskName] )                       
            $path = $file->storeAs('/'.env('FOLDER_IMGINMU').'/',$filename,'publicbox'); 
            // se forma la ruta relativa a dir public : box/imginmu/
            // ruta completa public_html/box/imginmu/ 
            // FOLDER_IMGINMU - se toma de las variables del archivo .env           
            // publicbox - se toma de filesystem.php   
                 
            //dd($path);
            $propexpid=$request->session()->get('unidadexpid');
            Flash::success('Carga de archivo correcta en: '.$path);
            
            return view('inmueble_imagesids.CreateUp')
            ->with('filename', $filename)
            ->with('path', $path)
            ->with('propexpid',$propexpid);

        }
        else{
             $filename=$file->getClientOriginalName();  
          Flash::error('El archivo: '.$filename.' NO es una imagen valida.');
            return view('inmueble_imagesids.upload');
        }
     }
     else{        
        Flash::error('No se selecciono ningun archivo.'); 
               return view('inmueble_imagesids.upload');
     }   
    
   
    }

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

 // Presenta imagen cargada en el servidor y permite guardar en Base de Datos     
     
    public function storeupload(CreateInmuebleImagesidsRequest $request)
    {
        $input = $request->all();
        //dd($input);
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->create($input);
        //dd($inmuebleImagesids);
        $propexpid=$inmuebleImagesids->inmueble_id;

        $result = $this->inmuebleImagesidsRepository->
        gUpdateImgId($propexpid,$inmuebleImagesids->id);
        //$propexpid=$request->session()->get('unidadexpid');
        //dd($result);       
        Flash::success('Imagen actualizada.');
        return redirect(route('propertyexp.index', [$propexpid]));
    }

//=====================================================================
     public function delfileimgid($filename)
     {
        //dd('ya');
        //$deletefile = public_path().env('PATH_IMGIDS').$filename;
        //$deletefile = url(env('PATH_IMGIDS')).$filename;
        $deletefile = 'box/'.env('FOLDER_IMGINMU').'/'.$filename;
        
        //dd($deletefile);
        //Storage::delete($deletefile);
       //File::delete($deletefile);
        $unidadexpid=Session()->get('unidadexpid');

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

        return redirect(route('propertyexp.index', [$unidadexpid]));
    }

//=====================================================================
public function showimgids(Request $request,$inmuexpid)
     {
         //dd(new RequestCriteria($request));
        $this->inmuebleImagesidsRepository->pushCriteria(new RequestCriteria($request));
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->all()
        ->where('inmueble_id',$inmuexpid)
        ->where('activ','<>','1');
       
       return view('inmueble_imagesids.showimgids')
       ->with('inmuebleImagesids',$inmuebleImagesids);
        
    }

//=====================================================================
   // Presenta galeria de imagenes que se han subido para ese inmueble 
   // y permite seleccionar una como activa
   // Cambiando la imagen de perfil
     public function selimgids(Request $request,$imagenid)
     {
        $unidadexpid=Session()->get('unidadexpid');

        //dd('exp:'.$unidadexpid.' imgid:'.$imagenid);

        $result = $this->inmuebleImagesidsRepository
        ->gUpdateImgId($unidadexpid,$imagenid);
        
        Flash::success('Imagen actualizada.');

        return redirect(route('propertyexp.index', $unidadexpid));

     }

    
}
