<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateInmuebleImagesidsRequest;
use App\Http\Requests\UpdateInmuebleImagesidsRequest;
use App\Http\Requests\CreateinmuebleRequest;
use App\Http\Requests\UpdateinmuebleRequest;
use App\Repositories\InmuebleImagesidsRepository;
use App\Repositories\inmuebleRepository;
use App\Repositories\medioRepository;
use App\Repositories\InmuebleMedioRepository;
use App\Repositories\InmuebleDirRepository;
use App\Repositories\InmuebleTipoRepository;
use App\Repositories\propertyvalueRepository;

use App\Repositories\PersonaInmuebleRepository;
use App\Repositories\propertyparameterRepository;
use App\Repositories\presupuestoRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Storage;    // para subir archivos
use Carbon\Carbon;


class expcondominioController extends AppBaseController
{
    /** @var  inmuebleRepository */
    //inmuebleRepository $inmuebleRepo,               
    private $inmuebleRepository;

    public function __construct(inmuebleRepository $inmuebleRepo, 
        InmuebleImagesidsRepository $inmuebleImagesidsRepo,
        InmuebleMedioRepository $inmuebleMedioRepo,
        InmuebleDirRepository $inmuebleDirRepo,
        medioRepository $medioRepo,
        InmuebleTipoRepository $inmuebleTipoRepo,        
        propertyvalueRepository $propertyvalueRepo,
        PersonaInmuebleRepository $personaInmuebleRepo,
        propertyparameterRepository $propertyparameterRepo,
        presupuestoRepository $presupuestoRepo
    )
    {
        $this->inmuebleRepository = $inmuebleRepo;
        $this->inmuebleImagesidsRepository = $inmuebleImagesidsRepo;
        $this->inmuebleMedioRepository = $inmuebleMedioRepo;
        $this->medioRepository = $medioRepo;
        $this->inmuebleDirRepository = $inmuebleDirRepo;
        $this->inmuebleTipoRepository = $inmuebleTipoRepo;
        $this->propertyvalueRepository = $propertyvalueRepo;
        $this->personaInmuebleRepository = $personaInmuebleRepo;
        $this->propertyparameterRepository = $propertyparameterRepo;
        $this->presupuestoRepository = $presupuestoRepo;

    }


/**
     * Lista informacion del inmueble.
     *
     * @param Request $request
     * @return Response
     */
    public function expcondominio(Request $request,$propexpid)

    {      
        $inmueble = $this->inmuebleRepository->findWithoutFail($propexpid); 
        $inmumedios =  $this->inmuebleMedioRepository->gMedios($propexpid);         
        $inmuDirs =  $this->inmuebleDirRepository->gUbicaciones($propexpid);         
        $unidades = $this->inmuebleRepository->gInmuUnidades($propexpid);        
        $personas = $this->inmuebleRepository->gPersonas($propexpid);        
        //$personas = $this->personaInmuebleRepository->gPersonasB($propexpid);          
        $condominos = $this->inmuebleRepository->gCondominos($propexpid);
        $comite = $this->inmuebleRepository->gConomite($propexpid);                
        $indivisos = $this->propertyvalueRepository->gIndivlUnids($propexpid);
        $propertyparameters = $this->propertyparameterRepository->all() 
        ->where('inmueble_id','=',$propexpid) ;
        $presupuestos = $this->presupuestoRepository->gpresupaplicado($propexpid);
        $totpresup = $this->propertyparameterRepository->gValParam($propexpid,'presupuesto');
        $totindiv = $this->propertyparameterRepository->gValParam($propexpid,'indiv1tot'); 
        $tcuotas = $this->propertyparameterRepository->gValParam($propexpid,'cuotas');                 
        //dd($inmuDirs);

        
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
         
         $request->session()->put('condominioexpid', $propexpid); // crear variable de session 
         
         //dd($inmueble->datebirth->format('l d, F Y'));              
         $condonomexp=$inmueble->nombre;
         $request->session()->put('condonomexp', $condonomexp); // crear variable de session 

          
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
           $imgcondomexp =  $imgfilenam;      
           $request->session()->put('imgcondomexp', $imgcondomexp); // crear variable de session 
          //dd(url(env('PATH_IMGIDS')) );
         //$imgfilenam=$imgid->filename;
         //dd($imgfilenam);
         //$imgid=
         //  $inmueble->appat.substr($inmueble->apmat,0,1).
         //  substr($inmueble->name,0,1).$inmueble->id.".jpg";
         //strtolower($string);
         //$imgid=strtolower($imgid);
         //dd(env('PATH_IMGIDS').$imgid);
         
         return view('expedcondominios.show')
         ->with('inmueble', $inmueble)
         ->with('inmuDirs',$inmuDirs)
         ->with('inmumedios',$inmumedios)
         ->with('unidades',$unidades)
         //->with('edad', $edad)
         ->with('imgfilenam',$imgfilenam)
         ->with('personas',$personas)
         ->with('condominos',$condominos)
         ->with('comite',$comite)
         ->with('indivisos',$indivisos)
         ->with('propertyparameters',$propertyparameters)
         ->with('presupuestos',$presupuestos)
         ->with('totpresup',$totpresup)
         ->with('totindiv',$totindiv)
         ->with('tcuotas',$tcuotas)
         ;
        }
    }

  /**
     * Cierra el expediente de un inmueble.
     *
     * @return Response
     */
    public function expcondclose(Request $request)
    {
       //Elimina las variables de session
        $request->session()->forget('condominioexpid');
        $request->session()->forget('imgcondomexp');
        $request->session()->forget('condonomexp');
        
        return redirect()->route("home.index");               
    }

// ###############################  UNIDADES    #####################################
/**
     * Lista informacion del inmueble.
     *
     * @param Request $request
     * @return Response
     */
    public function unidadesindex()
    {
        $propexpid = Session('condominioexpid');             
        $unidades = $this->inmuebleRepository->gInmuUnidades($propexpid);
        if (empty($unidades)) {
            Flash::error('No hay unidades asignadas');                        
        }            
         return view('unidades.index')
         ->with('unidades',$unidades);
    }    

 /**
     *      
     * @return Response
     */
    public function unidadcreate()
    {
        $propexpid = Session('condominioexpid');     
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
        //dd($request->all());
        $condominioexpid = Session('condominioexpid');  // inmuid tinyint, 
        $paramarray = array();      // Declara un array para parametros de procedimiento
        array_push($paramarray,$condominioexpid); 
        array_push($paramarray,$request->input("inmuebletipo_id","2")); 
        array_push($paramarray,$request->input("ident","99999")); 
        array_push($paramarray,$request->input("nombre","Depto sin nombre"));
        array_push($paramarray,$request->input("descripcion","Depto sin Descripcion"));
        array_push($paramarray,$request->input("bancref", "0"));
        array_push($paramarray,$request->input("namep","Propietario Sin nombre"));
        array_push($paramarray,$request->input("appatp","Sin Apellido Paterno"));
        array_push($paramarray,$request->input("apmatp","Sin Apellido Materno"));
        array_push($paramarray,$request->input("datemailp","N/A"));
        array_push($paramarray,$request->input("datphonep","N/A"));
        array_push($paramarray,$request->input("sendnewsp","N/A"));
        array_push($paramarray,$request->input("sendrecipp","N/A"));
        array_push($paramarray,$request->input("miembroc","N/A"));
        array_push($paramarray,$request->input("namei","Inquilino Sin nombre"));
        array_push($paramarray,$request->input("appati","Sin Apellido Paterno"));
        array_push($paramarray,$request->input("apmati","Sin Apellido Materno"));
        array_push($paramarray,$request->input("datemaili","N/A"));
        array_push($paramarray,$request->input("datphonei","N/A"));
        array_push($paramarray,$request->input("sendnewsi","N/A"));
        array_push($paramarray,$request->input("sendrecipi","N/A"));

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
        // array_push($paramarray,$condominioexpid); // asigna el valor de id de condominio a el array
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
        return redirect(route('unidades.index', $condominioexpid ));
    }

    /**
     * Muestra vista y datos para edicion de unidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function unidadedit($id)
    {
        //$InmuTipos = $this->InmuebleTipoRepository->gInmuebleTipos(0); //0=Todos
        $inmutipos = $this->inmuebleTipoRepository->gInmuebleTipos('1');
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);
        // dd($inmueble->inmuebletipo_id);
        $inmutipoid = $inmueble->inmuebletipo_id;
  
        if (empty($inmueble)) {
            Flash::error('Unidad no localizada');

            return redirect(route('unidades.index'));
        }

        return view('unidades.edit')
        ->with('inmueble', $inmueble)
        ->with('inmutipos', $inmutipos)
        ->with('inmutipoid', $inmutipoid);
    }

     /**
     * Actualiza datos de la unidad.
     *
     * @param  int              $id
     * @param UpdateinmuebleRequest $request
     *
     * @return Response
     */
    public function unidadupdate($id, UpdateinmuebleRequest $request)
    {
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);

        if (empty($inmueble)) {
            Flash::error('Unidad no localizada');

            return redirect(route('unidades.index'));
        }

        $inmueble = $this->inmuebleRepository->update($request->all(), $id);

        Flash::success('Unidad actualizada correctamente.');

        return redirect(route('unidades.index'));
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
            $condonomexp=$request->session()->get('condonomexp');
            $splitname=explode(" ",$condonomexp);
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
            $propexpid=$request->session()->get('condominioexpid');
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
        //$propexpid=$request->session()->get('condominioexpid');
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
        $condominioexpid=Session()->get('condominioexpid');

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

        return redirect(route('propertyexp.index', [$condominioexpid]));
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
        $condominioexpid=Session()->get('condominioexpid');

        //dd('exp:'.$condominioexpid.' imgid:'.$imagenid);

        $result = $this->inmuebleImagesidsRepository
        ->gUpdateImgId($condominioexpid,$imagenid);
        
        Flash::success('Imagen actualizada.');

        return redirect(route('propertyexp.index', $condominioexpid));

     }

    
}
