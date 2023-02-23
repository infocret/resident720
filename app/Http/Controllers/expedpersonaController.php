<?php

namespace App\Http\Controllers;

//use App\Http\Requests\UpdatepersonaRequest;
use App\Repositories\personaRepository;             // Se agrego 
use App\Repositories\expedpersonaRepository;        // Se agrego

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;


class expedpersonaController extends AppBaseController
{
     
     /** @var Variables de repositorios en constructor */
     private $personaRepository;
     private $expedpersonaRepository;

    public function __construct(
        expedpersonaRepository $expedpersonaRepo, 
        personaRepository $personaRepo
    )
     {
         $this->middleware('auth');
         $this->expedpersonaRepository = $expedpersonaRepo;     // se agrego 
         $this->personaRepository = $personaRepo;               // se agrego 
     }

 /**
     * Extrae los datos del expediente de una.
     *
     * @param  int $id    // id de la tabla personas
     *
     * @return Response   // Objeto Response
     */
    public function show($id)
    {  
        
        // Trae los datos de la persona, se agrego el repositorio persona y se creo intancia  
        $persona = $this->personaRepository->findWithoutFail($id);  

         if (empty($persona)) {
            Flash::error('Persona not found');
            
            return redirect(route('expedpersonas.show'));
        }

         return view('expedpersonas.show')
         ->with('persona', $persona);
         //->with('personaContactos',$personacontactos);


    }

    /**
     * Display a listing of the persona.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $this->personaRepository->pushCriteria(new RequestCriteria($request));
        // $personas = $this->personaRepository->all();

       

        // return view('personas.index')
        //     ->with('personas', $personas);
    }

    /**
     * Show the form for creating a new persona.
     *
     * @return Response
     */
    public function create()
    {
        return view('personas.create');
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
        // $input = $request->all();

        // $persona = $this->personaRepository->create($input);

        // Flash::success('Persona saved successfully.');

        // return redirect(route('personas.index'));
    }



    /**
     * Show the form for editing the specified persona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // $persona = $this->personaRepository->findWithoutFail($id);

        // if (empty($persona)) {
        //     Flash::error('Persona not found');

        //     return redirect(route('personas.index'));
        // }

        // return view('personas.edit')->with('persona', $persona);
    }

    /**
     * Update the specified persona in storage.
     *
     * @param  int              $id
     * @param UpdatepersonaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepersonaRequest $request)
    {
        // $persona = $this->personaRepository->findWithoutFail($id);

        // if (empty($persona)) {
        //     Flash::error('Persona not found');

        //     return redirect(route('personas.index'));
        // }

        // $persona = $this->personaRepository->update($request->all(), $id);

        // Flash::success('Persona updated successfully.');

        // return redirect(route('personas.index'));
    }

    /**
     * Remove the specified persona from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // $persona = $this->personaRepository->findWithoutFail($id);

        // if (empty($persona)) {
        //     Flash::error('Persona not found');

        //     return redirect(route('personas.index'));
        // }

        // $this->personaRepository->delete($id);

        // Flash::success('Persona deleted successfully.');

        // return redirect(route('personas.index'));
    }
}

