<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonaInmuebleReltipoRequest;
use App\Http\Requests\UpdatePersonaInmuebleReltipoRequest;
use App\Repositories\PersonaInmuebleReltipoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PersonaInmuebleReltipoController extends AppBaseController
{
    /** @var  PersonaInmuebleReltipoRepository */
    private $personaInmuebleReltipoRepository;

    public function __construct(PersonaInmuebleReltipoRepository $personaInmuebleReltipoRepo)
    {
        $this->personaInmuebleReltipoRepository = $personaInmuebleReltipoRepo;
    }

    /**
     * Display a listing of the PersonaInmuebleReltipo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->personaInmuebleReltipoRepository->pushCriteria(new RequestCriteria($request));
        $personaInmuebleReltipos = $this->personaInmuebleReltipoRepository->all();

        return view('persona_inmueble_reltipos.index')
            ->with('personaInmuebleReltipos', $personaInmuebleReltipos);
    }

    /**
     * Show the form for creating a new PersonaInmuebleReltipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('persona_inmueble_reltipos.create');
    }

    /**
     * Store a newly created PersonaInmuebleReltipo in storage.
     *
     * @param CreatePersonaInmuebleReltipoRequest $request
     *
     * @return Response
     */
    public function store(CreatePersonaInmuebleReltipoRequest $request)
    {
        $input = $request->all();

        $personaInmuebleReltipo = $this->personaInmuebleReltipoRepository->create($input);

        Flash::success('Persona Inmueble Reltipo saved successfully.');

        return redirect(route('personaInmuebleReltipos.index'));
    }

    /**
     * Display the specified PersonaInmuebleReltipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $personaInmuebleReltipo = $this->personaInmuebleReltipoRepository->findWithoutFail($id);

        if (empty($personaInmuebleReltipo)) {
            Flash::error('Persona Inmueble Reltipo not found');

            return redirect(route('personaInmuebleReltipos.index'));
        }

        return view('persona_inmueble_reltipos.show')->with('personaInmuebleReltipo', $personaInmuebleReltipo);
    }

    /**
     * Show the form for editing the specified PersonaInmuebleReltipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $personaInmuebleReltipo = $this->personaInmuebleReltipoRepository->findWithoutFail($id);

        if (empty($personaInmuebleReltipo)) {
            Flash::error('Persona Inmueble Reltipo not found');

            return redirect(route('personaInmuebleReltipos.index'));
        }

        return view('persona_inmueble_reltipos.edit')->with('personaInmuebleReltipo', $personaInmuebleReltipo);
    }

    /**
     * Update the specified PersonaInmuebleReltipo in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaInmuebleReltipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersonaInmuebleReltipoRequest $request)
    {
        $personaInmuebleReltipo = $this->personaInmuebleReltipoRepository->findWithoutFail($id);

        if (empty($personaInmuebleReltipo)) {
            Flash::error('Persona Inmueble Reltipo not found');

            return redirect(route('personaInmuebleReltipos.index'));
        }

        $personaInmuebleReltipo = $this->personaInmuebleReltipoRepository->update($request->all(), $id);

        Flash::success('Persona Inmueble Reltipo updated successfully.');

        return redirect(route('personaInmuebleReltipos.index'));
    }

    /**
     * Remove the specified PersonaInmuebleReltipo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $personaInmuebleReltipo = $this->personaInmuebleReltipoRepository->findWithoutFail($id);

        if (empty($personaInmuebleReltipo)) {
            Flash::error('Persona Inmueble Reltipo not found');

            return redirect(route('personaInmuebleReltipos.index'));
        }

        $this->personaInmuebleReltipoRepository->delete($id);

        Flash::success('Persona Inmueble Reltipo deleted successfully.');

        return redirect(route('personaInmuebleReltipos.index'));
    }
}
