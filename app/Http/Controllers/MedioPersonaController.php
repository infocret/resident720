<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedioPersonaRequest;
use App\Http\Requests\UpdateMedioPersonaRequest;
use App\Repositories\MedioPersonaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MedioPersonaController extends AppBaseController
{
    /** @var  MedioPersonaRepository */
    private $medioPersonaRepository;

    public function __construct(MedioPersonaRepository $medioPersonaRepo)
    {
        $this->medioPersonaRepository = $medioPersonaRepo;
    }



    /**
     *   
     * Muestra los medios de contacto de una persona para el expediente.
     *
     * @param Request $request
     * @return Response
     */
    public function personamediosindex()
    {
        $personaexpid = Session('personaexpid');
        //dd($personaexpid);
        $medioPersonas = $this->medioPersonaRepository->gMedios( $personaexpid);
        //dd($medioPersonas);

        // if (empty($medioPersonas)) {
        //     Flash::error('No se encontraron medios de contacto para esta persona');

        //     return redirect(route('personamedios.index'));
        // }

        return view('personamedios.index')->with('medioPersonas', $medioPersonas);
    }

    /**
     * Display a listing of the MedioPersona.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->medioPersonaRepository->pushCriteria(new RequestCriteria($request));
        $medioPersonas = $this->medioPersonaRepository->all();

        return view('medio_personas.index')
            ->with('medioPersonas', $medioPersonas);
    }

   /**
     * Show the form for creating a new MedioPersona.
     *
     * @return Response
     */
    public function personamedioscreate()
    {

        $mediosList = $this->medioPersonaRepository->gMediosLista();
   // dd($mediosList);
        return view('personamedios.create')
          ->with('mediosList', $mediosList);
    }

    /**
     * Show the form for creating a new MedioPersona.
     *
     * @return Response
     */
    public function create()
    {


        return view('medio_personas.create');
    }

    /**
     * Store a newly created MedioPersona in storage.
     *
     * @param CreateMedioPersonaRequest $request
     *
     * @return Response
     */
    public function store(CreateMedioPersonaRequest $request)
    {
        
        $input = $request->all();
//dd($input);
        $medioPersona = $this->medioPersonaRepository->create($input);

        Flash::success('Medio Persona saved successfully.');

        return redirect(route('medioPersonas.index'));
    }

 /**
     * Guarda un medio decontacto para una persona.
     *
     * @param CreateMedioPersonaRequest $request
     *
     * @return Response
     */
    public function personamediostore(CreateMedioPersonaRequest $request)
    {
        $personaexpid = Session('personaexpid');
        //dd($personaexpid);
        
        $input = $request->all();
        //dd($input);
        $medioPersona = $this->medioPersonaRepository->create($input);

        Flash::success('Medio Persona saved successfully.');

        return redirect(route('personamedios.index', $personaexpid ));
    }

    /**
     * Display the specified MedioPersona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medioPersona = $this->medioPersonaRepository->findWithoutFail($id);

        if (empty($medioPersona)) {
            Flash::error('Medio Persona not found');

            return redirect(route('medioPersonas.index'));
        }

        return view('medio_personas.show')->with('medioPersona', $medioPersona);
    }

/**
     * Display the specified MedioPersona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personamediosshow($id)
    {
        $medioPersona = $this->medioPersonaRepository->findWithoutFail($id);
//dd($id);
        if (empty($medioPersona)) {
            Flash::error('Medio Persona not found');

            return redirect(route('personamedios.index','1'));
        }

        return view('personamedios.show')->with('medioPersona', $medioPersona);
    }

    /**
     * Show the form for editing the specified MedioPersona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medioPersona = $this->medioPersonaRepository->findWithoutFail($id);

        if (empty($medioPersona)) {
            Flash::error('Medio Persona not found');

            return redirect(route('medioPersonas.index'));
        }

        return view('medio_personas.edit')->with('medioPersona', $medioPersona);
    }

    /**
     * Show the form for editing the specified MedioPersona.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personamediosedit($id)
    {
        $personaexpid = Session('personaexpid');
        $medioPersona = $this->medioPersonaRepository->findWithoutFail($id);
    //dd($medioPersona);
    $mediosList=$this->medioPersonaRepository->gMediosLista();
// $mediosList =array(
//     '' => 'Seleccione',
//     'Sr.' => 'Sr.',
//     'Sra.' => 'Sra.',
//     'Br.' => 'Br.',
//     'TM.' => 'TM.',
//     'TSU.' => 'TSU.',
//     'Ing.' => 'Ing.',
//     'M.Sc' => 'M.Sc',
//     'Dr.' => 'Dr.',
//     'Dra.' => 'Dra.',
//         'Licdo' => 'Licdo.',
//         'Licda.' => 'Licda.'
// );

        if (empty($medioPersona)) {
            Flash::error('Medio Persona not found');

            return redirect(route('personamedios.index',$personaexpid));
        }
    //dd($mediosList);
        return view('personamedios.edit')
        ->with('mediosList', $mediosList)
        ->with('medioPersona', $medioPersona);
    }

    /**
     * Update the specified MedioPersona in storage.
     *
     * @param  int              $id
     * @param UpdateMedioPersonaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedioPersonaRequest $request)
    {
        $medioPersona = $this->medioPersonaRepository->findWithoutFail($id);

        if (empty($medioPersona)) {
            Flash::error('Medio Persona not found');

            return redirect(route('medioPersonas.index'));
        }

        $medioPersona = $this->medioPersonaRepository->update($request->all(), $id);

        Flash::success('Medio Persona updated successfully.');

        return redirect(route('medioPersonas.index'));
    }
    /**
     * Update the specified MedioPersona in storage.
     *
     * @param  int              $id
     * @param UpdateMedioPersonaRequest $request
     *
     * @return Response
     */
    public function personamediosupdate($id, UpdateMedioPersonaRequest $request)
    {
        $medioPersona = $this->medioPersonaRepository->findWithoutFail($id);
            //dd($request->all());
        if (empty($medioPersona)) {
            Flash::error('Medio Persona not found');

            return redirect(route('personamedios.index','1'));
        }

        $medioPersona = $this->medioPersonaRepository->update($request->all(), $id);

        Flash::success('Medio Persona updated successfully.');

        return redirect(route('personamedios.index','1'));
    }

    /**
     * Remove the specified MedioPersona from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medioPersona = $this->medioPersonaRepository->findWithoutFail($id);

        if (empty($medioPersona)) {
            Flash::error('Medio Persona not found');

            return redirect(route('medioPersonas.index'));
        }

        $this->medioPersonaRepository->delete($id);

        Flash::success('Medio Persona deleted successfully.');

        return redirect(route('medioPersonas.index'));
    }

    /**
     * Elimina el registro de un medio de contacto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function personamediodestroy($id)
    {
        //dd($id);
        $medioPersona = $this->medioPersonaRepository->findWithoutFail($id);

        if (empty($medioPersona)) {
            Flash::error('Medio Persona not found');

            return redirect(route('personamedios.index','1'));
        }

        $this->medioPersonaRepository->delete($id);

        Flash::success('Medio Persona deleted successfully.');

        return redirect(route('personamedios.index','1'));
    }
    
}
