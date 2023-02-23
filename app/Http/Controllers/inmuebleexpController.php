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
use App\Repositories\propertyparameterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Storage;    // para subir archivos
use Carbon\Carbon;


class inmuebleexpController extends AppBaseController
{
    /** @var  inmuebleRepository */
    //inmuebleRepository $inmuebleRepo,               
    private $inmuebleRepository;

    public function __construct(inmuebleRepository $inmuebleRepo, 
        InmuebleImagesidsRepository $inmuebleImagesidsRepo,
        InmuebleMedioRepository $inmuebleMedioRepo,
        InmuebleDirRepository $inmuebleDirRepo,
        InmuebleTipoRepository $inmuebleTipoRepo,
        propertyparameterRepository $propertyparameterRepo
    )
    {
        $this->inmuebleRepository = $inmuebleRepo;
        $this->inmuebleImagesidsRepository = $inmuebleImagesidsRepo;
        $this->inmuebleMedioRepository = $inmuebleMedioRepo;
        $this->inmuebleDirRepository = $inmuebleDirRepo;
        $this->inmuebleTipoRepository = $inmuebleTipoRepo;
        $this->propertyparameterRepository = $propertyparameterRepo;
    }

/**
     * Lista informacion del inmueble.
     *
     * @param Request $request
     * @return Response
     */
    public function unidadesindex()
    {
        $propexpid = Session('propertyexpid');     
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
        $propexpid = Session('propertyexpid');     
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
        
        $propertyexpid = Session('propertyexpid');  // inmuid tinyint, 
        $paramarray = array();      // Declara un array para parametros de procedimiento
        array_push($paramarray,$propertyexpid); 
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
        //dd($paramarray);                 
        
            // "inmuebletipo_id" => "2"             // inmutipo tinyint,             
            // "ident" => "1303"                    // ident varchar(8),   
            // "nombre" => "103"                    // nom varchar(25), 
            // "descripcion" => "Departamento 103"  // descr varchar(50), 
            // "namep" => "Alfredo"                 // namep varchar(25),   
            // "appatp" => "Adame"                  // appatp varchar(25),  
            // "apmatp" => "Gomez"                  // apmatp varchar(25),  
            // "datemailp" => "agomez@micorreo.com" // emailp varchar(50),
            // "datphonep" => "55 35355618"         // phonep varchar(50), 
            // "sendnewsp" => "News"                // snewp varchar(25), 
            // "sendrecipp" => "Recips"             // srecipp varchar(25),
            // "namei" => "Carlos"                  // namei varchar(25), 
            // "appati" => "Hernandez"              // appati varchar(25), 
            // "apmati" => "Lopez"                  // apmati varchar(25), 
            // "datemaili" => "chdz@micorreo.com"   // emaili varchar(50), 
            // "datphonei" => "55 12548789"         // phonei varchar(50), 
            // "sendnewsi" => "News"                // snewi varchar(25), 
            // "sendrecipi" => "Recips"             // srecipi varchar(25)
        // $input = $request->all();  // obtiene los valores de la pagina
        // dd($request->input("sendnewsp","NO"));
        // //dd($input);
        // $paramarray = array();      // Declara un array para parametros de procedimiento
        // array_push($paramarray,$propertyexpid); // asigna el valor de id de condominio a el array
        // $i =0;                      // variablepara omtir tocket de el arreglo de input
        // foreach($input as $cve=>$valor) //barre el arreglo de calores de la pagina
        // {
        //     if ($i>0) {                     // para omitir el tocken
        //        array_push($paramarray,$valor); // agrega el valor a el array de parametros               
        //     }
        //     $i=$i+1;                        // incrementa para omitir el tocken
        // }
        
        $unidadstatus = $this->inmuebleRepository->saveUnidad($paramarray);
        //dd($unidadstatus);        
        if ($unidadstats="OK"){
        Flash::success('Unidad agregada correctamente.');
        }        
        return redirect(route('unidades.index', $propertyexpid ));
    }


/**
     * Lista informacion del inmueble.
     *
     * @param Request $request
     * @return Response
     */
    public function propertyexpindex(Request $request,$propexpid)

    {      
        $inmueble = $this->inmuebleRepository->findWithoutFail($propexpid); 
        $inmumedios =  $this->inmuebleMedioRepository->gMedios($propexpid); 
        $inmuDirs =  $this->inmuebleDirRepository->gUbicaciones($propexpid); 
        $unidades = $this->inmuebleRepository->gInmuUnidades($propexpid);
        $personas = $this->inmuebleRepository->gPersonas($propexpid);
        $condominos = $this->inmuebleRepository->gCondominos($propexpid);
        $comite = $this->inmuebleRepository->gConomite($propexpid);
        $indivisos = $this->propertyparameterRepository->gIndivisos($propexpid);
        //dd($indivisos);

        
    // "id" => 1
    // "inmuebletipo_id" => 1
    // "ident" => "GrdStafe"
    // "nombre" => "Condominio Grand Sta Fe"
    // "descripcion" => "Condominio Grand Sta Fe"
    // "created_at" => "2018-04-21 07:30:35"
    // "updated_at" => "2018-04-21 07:30:35"
    // "deleted_at" => null        
        //dd($inmueble);
    
    // array:1 [▼
    // 0 => {#1467 ▼
    // +"id": 1
    // +"dato": "555811"
    // +"observaciones": "Teléfono de las oficinas"
    // +"imgfilename": "glyphicon glyphicon-earphone"
    // +"descripcion": "Teléfono fijo de su trabajo con extención"
    // +"nombre": "Teléfono de su trabajo"
    // }
    // ]
        // dd($medios);
        
    // array:2 [▼
    //   0 => {#1466 ▼
    //     +"id": 1
    //     +"nombre": "Ubicación de Departamento"
    //     +"dir": "Av rosas Num. 888 Int. 999 Piso 5 Colonia Ampliación El Triunfo, Iztapalapa, Ciudad de México. CP 09438"
    //     +"linkmapa": "#"
    //   }
    //   1 => {#1468 ▼
    //     +"id": 2
    //     +"nombre": "Ubicación de condominio"
    //     +"dir": "Av rosas Num. 5 Int. 501 Piso 5 Colonia Adolfo López Mateos, Cuajimalpa de Morelos, Ciudad de México. CP 05280"
    //     +"linkmapa": "#"
    //   }
    // ]
    // dd($ubicaciones);
    
//     array:2 [▼
//   0 => {#1467 ▼
//     +"parent_property": 1
//     +"id": 3
//     +"inmuebletipo_id": 2
//     +"ident": "13801"
//     +"nombre": "101"
//     +"descripcion": "Departamento 101"
//   }
//   1 => {#1465 ▼
//     +"parent_property": 1
//     +"id": 4
//     +"inmuebletipo_id": 2
//     +"ident": "13802"
//     +"nombre": "102"
//     +"descripcion": "Departamento 102"
//   }
// ] 
// dd($unidades);

         //dd($condominos);
        if (empty($inmueble)) {
            Flash::error('Inmueble no localizado');            
            return ('Inmueble no localizado');
        }
        else
        {         
         
         $request->session()->put('propertyexpid', $propexpid); // crear variable de session 
         
         //dd($inmueble->datebirth->format('l d, F Y'));              
         $propnomexp=$inmueble->nombre;
         $request->session()->put('propnomexp', $propnomexp); // crear variable de session 

          
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
           $imgeinmuexp =  $imgfilenam;      
           $request->session()->put('imgeinmuexp', $imgeinmuexp); // crear variable de session 
          //dd(url(env('PATH_IMGIDS')) );
         //$imgfilenam=$imgid->filename;
         //dd($imgfilenam);
         //$imgid=
         //  $inmueble->appat.substr($inmueble->apmat,0,1).
         //  substr($inmueble->name,0,1).$inmueble->id.".jpg";
         //strtolower($string);
         //$imgid=strtolower($imgid);
         //dd(env('PATH_IMGIDS').$imgid);
         
         return view('expedinmueble.show')
         ->with('inmueble', $inmueble)
         ->with('inmuDirs',$inmuDirs)
         ->with('inmumedios',$inmumedios)
         ->with('unidades',$unidades)
         //->with('edad', $edad)
         ->with('imgfilenam',$imgfilenam)
         ->with('personas',$personas)
         ->with('condominos',$condominos)
         ->with('comite',$comite)
         ->with('indivisos',$indivisos);
        }
    }

  /**
     * Cierra el expediente de un inmueble.
     *
     * @return Response
     */
    public function propertyexpclose(Request $request)
    {
      //Elimina variaables de session
        $request->session()->forget('propertyexpid');
        $request->session()->forget('propnomexp');
        $request->session()->forget('imgeinmuexp');
      
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
            $propnomexp=$request->session()->get('propnomexp');
            $splitname=explode(" ",$propnomexp);
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
            $propexpid=$request->session()->get('propertyexpid');
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
        //$propexpid=$request->session()->get('propertyexpid');
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
        $propertyexpid=Session()->get('propertyexpid');

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

        return redirect(route('propertyexp.index', [$propertyexpid]));
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
        $propertyexpid=Session()->get('propertyexpid');

        //dd('exp:'.$propertyexpid.' imgid:'.$imagenid);

        $result = $this->inmuebleImagesidsRepository
        ->gUpdateImgId($propertyexpid,$imagenid);
        
        Flash::success('Imagen actualizada.');

        return redirect(route('propertyexp.index', $propertyexpid));

     }

    
}
