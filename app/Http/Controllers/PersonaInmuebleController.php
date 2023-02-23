<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonaInmuebleRequest;
use App\Http\Requests\UpdatePersonaInmuebleRequest;
use App\Repositories\PersonaInmuebleRepository;
use App\Repositories\PersonaInmuebleReltipoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use carbon\carbon;

use Illuminate\Support\Collection as Collection;

class PersonaInmuebleController extends AppBaseController
{
    /** @var  PersonaInmuebleRepository */
    private $personaInmuebleRepository;

    public function __construct(
        PersonaInmuebleRepository $personaInmuebleRepo,
        PersonaInmuebleReltipoRepository $personaInmuebleReltipoRepo
    )
    {
        $this->personaInmuebleRepository = $personaInmuebleRepo;
        $this->personaInmuebleReltipoRepository = $personaInmuebleReltipoRepo;
    }
//*************************************************************************************************
//******************** DESDE EXPEDIENTE Condominio ***************************************************
//*************************************************************************************************
    /**
     * Lista de personas asignadas a un inmueble para el expediente de Inmueble
     *
     * @param Request $request
     * @return Response
     */
    public function expinmuindex(Request $request, $inmuid)
    {
        
        $this->personaInmuebleRepository->pushCriteria(new RequestCriteria($request));
        $personas = $this->personaInmuebleRepository->gPersonas($inmuid);       
        $comite = $this->personaInmuebleRepository->gConomite($inmuid);

        return view('persona_inmuebles.indexi')
            ->with('personas', $personas) 
            ->with('comite', $comite) 
            ->with('inmuid',$inmuid);
    }

    /**
     * Muestra forma de Asignacion de persona a inmueble 
     * desde la lista de personas existente que no esten asignadas  
     *
     * @param Request $request
     * @return Response
     */
    public function frompersonas(Request $request,$propertyid)
    {
       
       $this->personaInmuebleRepository->pushCriteria(new RequestCriteria($request));
       $personas = $this->personaInmuebleRepository->gPersonasno($propertyid);
        
        //$collpersonas = Collection::make($personas);
        //$collpers=$collpersonas->forPage(2, 3);
        //dd($collpers);
        
        
        return view('persona_inmuebles.indexiadd')
            ->with('personas', $personas)
            ->with('propertyid',$propertyid);
           
    }

    /**
     * Muestra la forma para agregar una relacion de Person a un inmueble
     * a partir de una persona ya existente elegida de la lista
     * 
     * @return Response
     */
    public function fromperscreate($propertyid,$personaid,$nombre)
    {
        //$propertyid = Session('propertyexpid');
        $reltypes = $this->personaInmuebleReltipoRepository->gpersinmreltipos();        
        $hoy = Carbon::now()->toDateString();
        return view('persona_inmuebles.createi')
        ->with('propertyid',$propertyid)
        ->with('personaid',$personaid)
        ->with('nombre',$nombre)
        ->with('reltypes',$reltypes)
        ->with('hoy',$hoy);
    }

 /**
     * Store a newly created PersonaInmueble in storage.
     *
     * @param CreatePersonaInmuebleRequest $request
     *
     * @return Response
     */
    public function fromperstore(CreatePersonaInmuebleRequest $request)
    {
        $propertyexpid =$request->input('inmueble_id') ;
        $input = $request->all();
        $personaInmueble = $this->personaInmuebleRepository->create($input);
        Flash::success('Persona Asignada correctamente.');
        return redirect(route('relinmp.expinmuindex',$propertyexpid));
    }

   /**
     * Muestra la forma para agregar una relacion de Person a un inmueble
     * a partir de una persona ya existente elejida de la lista
     * 
     * @return Response
     */
    public function newperson($propertyid)    
    {
         $hoy = Carbon::now()->toDateString();
         //dd($hoy);
        $reltypes = $this->personaInmuebleReltipoRepository->gpersinmreltipos();
        return view('persona_inmuebles.createpn')
        ->with('propertyid',$propertyid)        
        ->with('reltypes',$reltypes)
        ->with('hoy',$hoy);
    }

    /**
     * Guarda los datos de la persona medio de contacto y relacion persona inmueble.
     *
     * @param CreatePersonaInmuebleRequest $request
     *
     * @return Response
     */
    public function nstore(CreatePersonaInmuebleRequest $request,$propertyid)
    {
        $input = $request->all();
        //dd($input);

        //$propertyexpid = Session('propertyexpid');  // inmuid tinyint, 
        $paramarray = array();      // Declara un array para parametros de procedimiento
        array_push($paramarray,$propertyid); 
        array_push($paramarray,$request->input("namep","N/A"));           //namep varchar(25), 
        array_push($paramarray,$request->input("appatp","N/A"));          //appatp varchar(25), 
        array_push($paramarray,$request->input("apmatp","N/A"));          //apmatp varchar(25), 
        array_push($paramarray,$request->input("datemailp","N/A"));       //emailp varchar(50), 
        array_push($paramarray,$request->input("datphonep","N/A"));       //phonep varchar(50),  
        array_push($paramarray,$request->input("reltipo_id","1"));        //relid tinyint ,
        array_push($paramarray,$request->input("observaciones","1"));    //observ varchar(30)        


// array:11 [▼
//   "_token" => "hct2zytYY7taFX6QbGaKsx3kGHJ33lSRXJYugk75"
//   "namep" => "N/A"               //namep varchar(25), 
//   "appatp" => "N/A"              //appatp varchar(25), 
//   "apmatp" => "N/A"              //apmatp varchar(25),
//   "datemailp" => "N/A"           //emailp varchar(50),
//   "datphonep" => "N/A"           //phonep varchar(50), 
//   "inmueble_id" => "1"           // inmuid tinyint, 
//   "reltipo_id" => "8"            //relid tinyint ,
//   "asignacion" => "2018-10-01"  
//   "baja" => null
//   "observaciones" => "N/A"       //observ varchar(30)
// ]        
// array:8 [▼
//   0 => "1"
//   1 => "Juan"
//   2 => "Camaney"
//   3 => "Elias"
//   4 => "elias@correo.com"
//   5 => "55445566"
//   6 => "5"
//   7 => "Miembro del comite de condominos"
// ]    
        //$propertyid = Session('propertyexpid');        
        //dd($paramarray);
        $Result = $this->personaInmuebleRepository->savePersonRelProperty($paramarray);
        if ($Result="OK"){
            Flash::success('Persona Relacionada correctamente.');            
        }
        return redirect(route('relinmp.expinmuindex',$propertyid));
    }


  /**
     * Remove the specified PersonaInmueble from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function expdestroy($relid,$inmuid)
    {

        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($relid);        
        
        if (empty($personaInmueble)) {
            Flash::error('Relación no localizada.');

            return redirect(route('relinmp.expinmuindex',$inmuid));
        }

        $this->personaInmuebleRepository->delete($relid);

        Flash::success('Relación Eliminada.');

        return redirect(route('relinmp.expinmuindex',$inmuid));
    }    

     /**
     * Show the form for editing the specified PersonaInmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function expedit($relid,$inmuid)
    {
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($relid);
        //$personaexpid = Session('personaexpid');
        
        $reltypes = $this->personaInmuebleReltipoRepository->gpersinmreltipos();

        if (empty($personaInmueble)) {
            Flash::error('Relación no localizada.');

            return redirect(route('personaInmuebles.index'));
        }

        return view('persona_inmuebles.editi')
        ->with('inmuid',$inmuid)
        ->with('personaInmueble', $personaInmueble)
        ->with('reltypes',$reltypes);
    }

    /**
     * Update the specified PersonaInmueble in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaInmuebleRequest $request
     *
     * @return Response
     */
    public function expupdate($id, UpdatePersonaInmuebleRequest $request)
    {
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);
        // $personaexpid = Session('personaexpid');

        if (empty($personaInmueble)) {
            Flash::error('Relación no localizada.');

            return redirect(route('relperinmu.expindex',$personaexpid));
        }

        $inmuid =$request->input('inmueble_id') ;
        $personaInmueble = $this->personaInmuebleRepository->update($request->all(), $id);

        Flash::success('Relación actualizada correctamente.');

        return redirect(route('relinmp.expinmuindex',$inmuid));
    }

//*************************************************************************************************
//******************** DESDE EXPEDIENTE PERSONA ***************************************************
//*************************************************************************************************
    /**
     * Lista relaciones de una persona para el expediente de persona
     *
     * @param Request $request
     * @return Response
     */
    public function expindex(Request $request, $personaexpid)
    {
        // $personaexpid = Session('personaexpid');
        $this->personaInmuebleRepository->pushCriteria(new RequestCriteria($request));
        $personaInmuebles = $this->personaInmuebleRepository->gRelPersInmu($personaexpid,0);
        //dd($personaInmuebles);
        return view('persona_inmuebles.indexp')
            ->with('personaInmuebles', $personaInmuebles)
            ->with('personaexpid',$personaexpid);
    }

    /**
     * Lista inmuebles para elejir y agregar a relacion de una persona en el Expediente
     *
     * @param Request $request
     * @return Response
     */
    public function expindexadd(Request $request,$personaexpid)
    {
       //$personaexpid = Session('personaexpid');
       $this->personaInmuebleRepository->pushCriteria(new RequestCriteria($request));
       $Inmuebles = $this->personaInmuebleRepository->gInmuLista(0);

       // dd($Inmuebles);

        return view('persona_inmuebles.indexpadd')
            ->with('Inmuebles', $Inmuebles)
            ->with('personaexpid',$personaexpid);
    }


    /**
     * Show the form for creating a new PersonaInmueble.
     * 
     * @return Response
     */
    public function relperinmucreate($id)
    {
        $hoy = Carbon::now()->toDateString();
        $personaexpid = Session('personaexpid');
        $reltypes = $this->personaInmuebleReltipoRepository->gpersinmreltipos();
        return view('persona_inmuebles.createp')
        ->with('personaexpid',$personaexpid)
        ->with('id',$id)
        ->with('reltypes',$reltypes)
        ->with('hoy',$hoy);
    }

    /**
     * Store a newly created PersonaInmueble in storage.
     *
     * @param CreatePersonaInmuebleRequest $request
     *
     * @return Response
     */
    public function relperinmustore(CreatePersonaInmuebleRequest $request)
    {
        $personaexpid = Session('personaexpid');
        $input = $request->all();

        $personaInmueble = $this->personaInmuebleRepository->create($input);

        Flash::success('Persona Inmueble saved successfully.');

        return redirect(route('relperinmu.expindex',$personaexpid));
    }

    /**
     * Display the specified PersonaInmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function relperinmushow($id)
    {
       // $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);
        $personaexpid = Session('personaexpid');
        $personaInmuebles = $this->personaInmuebleRepository->gRelPersInmu($personaexpid,$id);
       
        if (empty($personaInmuebles)) {
            Flash::error('Persona Inmueble not found');

            return redirect(route('relperinmu.expindex',$personaexpid));
        }

        //dd($personaInmuebles[0]);
        $personaInmueble=$personaInmuebles[0]; //Toma el primer elemento del array
        
        // foreach ($personaInmuebles as $pinmu) {
        //     //dd($pinmu);
        //     $personaInmueble=$pinmu;
        // }
        //dd($personaInmueble);
        return view('persona_inmuebles.showp')
        ->with('personaInmueble', $personaInmueble)
        ->with('personaexpid',$personaexpid);
    }
    
    /**
     * Show the form for editing the specified PersonaInmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function relperinmuedit($id)
    {
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);
        $personaexpid = Session('personaexpid');
        $reltypes = $this->personaInmuebleReltipoRepository->gpersinmreltipos();

        if (empty($personaInmueble)) {
            Flash::error('Persona Inmueble not found');

            return redirect(route('personaInmuebles.index'));
        }

        return view('persona_inmuebles.editp')
        ->with('personaexpid',$personaexpid)
        ->with('personaInmueble', $personaInmueble)
        ->with('reltypes',$reltypes);
    }

/**
     * Update the specified PersonaInmueble in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaInmuebleRequest $request
     *
     * @return Response
     */
    public function relperinmuupdate($id, UpdatePersonaInmuebleRequest $request)
    {
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);
         $personaexpid = Session('personaexpid');

        if (empty($personaInmueble)) {
            Flash::error('Persona Inmueble not found');

            return redirect(route('relperinmu.expindex',$personaexpid));
        }

        $personaInmueble = $this->personaInmuebleRepository->update($request->all(), $id);

        Flash::success('Persona Inmueble updated successfully.');

        return redirect(route('relperinmu.expindex',$personaexpid));
    }



        /**
     * Remove the specified PersonaInmueble from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function relperinmudestroy($id)
    {
         $personaexpid = Session('personaexpid');
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);

        if (empty($personaInmueble)) {
            Flash::error('Persona Inmueble not found');

            return redirect(route('relperinmu.expindex',$personaexpid));
        }

        $this->personaInmuebleRepository->delete($id);

        Flash::success('Persona Inmueble deleted successfully.');



        return redirect(route('relperinmu.expindex',$personaexpid));
    }
//#################################################################################
    /**
     * Display a listing of the PersonaInmueble.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->personaInmuebleRepository->pushCriteria(new RequestCriteria($request));
        $personaInmuebles = $this->personaInmuebleRepository->all();

        return view('persona_inmuebles.index')
            ->with('personaInmuebles', $personaInmuebles);
    }



    /**
     * Show the form for creating a new PersonaInmueble.
     *
     * @return Response
     */
    public function create()
    {
        return view('persona_inmuebles.create');
    }

    /**
     * Store a newly created PersonaInmueble in storage.
     *
     * @param CreatePersonaInmuebleRequest $request
     *
     * @return Response
     */
    public function store(CreatePersonaInmuebleRequest $request)
    {
        $input = $request->all();

        $personaInmueble = $this->personaInmuebleRepository->create($input);

        Flash::success('Persona Inmueble saved successfully.');

        return redirect(route('personaInmuebles.index'));
    }

    /**
     * Display the specified PersonaInmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);

        if (empty($personaInmueble)) {
            Flash::error('Persona Inmueble not found');

            return redirect(route('personaInmuebles.index'));
        }
//dd( $personaInmueble);
        return view('persona_inmuebles.show')->with('personaInmueble', $personaInmueble);
    }

    /**
     * Show the form for editing the specified PersonaInmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);

        if (empty($personaInmueble)) {
            Flash::error('Persona Inmueble not found');

            return redirect(route('personaInmuebles.index'));
        }

        return view('persona_inmuebles.edit')->with('personaInmueble', $personaInmueble);
    }

    /**
     * Update the specified PersonaInmueble in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaInmuebleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersonaInmuebleRequest $request)
    {
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);

        if (empty($personaInmueble)) {
            Flash::error('Persona Inmueble not found');

            return redirect(route('personaInmuebles.index'));
        }

        $personaInmueble = $this->personaInmuebleRepository->update($request->all(), $id);

        Flash::success('Persona Inmueble updated successfully.');

        return redirect(route('personaInmuebles.index'));
    }

    /**
     * Remove the specified PersonaInmueble from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $personaInmueble = $this->personaInmuebleRepository->findWithoutFail($id);

        if (empty($personaInmueble)) {
            Flash::error('Persona Inmueble not found');

            return redirect(route('personaInmuebles.index'));
        }

        $this->personaInmuebleRepository->delete($id);

        Flash::success('Relación Eliminada.');

        return redirect(route('personaInmuebles.index'));
    }
}
