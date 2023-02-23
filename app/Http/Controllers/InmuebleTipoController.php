<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInmuebleTipoRequest;
use App\Http\Requests\UpdateInmuebleTipoRequest;
use App\Repositories\InmuebleTipoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InmuebleTipoController extends AppBaseController
{
    /** @var  InmuebleTipoRepository */
    private $inmuebleTipoRepository;

    public function __construct(InmuebleTipoRepository $inmuebleTipoRepo)
    {
        $this->inmuebleTipoRepository = $inmuebleTipoRepo;
    }

    /**
     * Display a listing of the InmuebleTipo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmuebleTipoRepository->pushCriteria(new RequestCriteria($request));
        $inmuebleTipos = $this->inmuebleTipoRepository->all();

        return view('inmueble_tipos.index')
            ->with('inmuebleTipos', $inmuebleTipos);
    }

    /**
     * Show the form for creating a new InmuebleTipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('inmueble_tipos.create');
    }

    /**
     * Store a newly created InmuebleTipo in storage.
     *
     * @param CreateInmuebleTipoRequest $request
     *
     * @return Response
     */
    public function store(CreateInmuebleTipoRequest $request)
    {
        $input = $request->all();

        $inmuebleTipo = $this->inmuebleTipoRepository->create($input);

        Flash::success('Inmueble Tipo saved successfully.');

        return redirect(route('inmuebleTipos.index'));
    }

    /**
     * Display the specified InmuebleTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inmuebleTipo = $this->inmuebleTipoRepository->findWithoutFail($id);

        if (empty($inmuebleTipo)) {
            Flash::error('Inmueble Tipo not found');

            return redirect(route('inmuebleTipos.index'));
        }

        return view('inmueble_tipos.show')->with('inmuebleTipo', $inmuebleTipo);
    }

    /**
     * Show the form for editing the specified InmuebleTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inmuebleTipo = $this->inmuebleTipoRepository->findWithoutFail($id);

        if (empty($inmuebleTipo)) {
            Flash::error('Inmueble Tipo not found');

            return redirect(route('inmuebleTipos.index'));
        }

        return view('inmueble_tipos.edit')->with('inmuebleTipo', $inmuebleTipo);
    }

    /**
     * Update the specified InmuebleTipo in storage.
     *
     * @param  int              $id
     * @param UpdateInmuebleTipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInmuebleTipoRequest $request)
    {
        $inmuebleTipo = $this->inmuebleTipoRepository->findWithoutFail($id);

        if (empty($inmuebleTipo)) {
            Flash::error('Inmueble Tipo not found');

            return redirect(route('inmuebleTipos.index'));
        }

        $inmuebleTipo = $this->inmuebleTipoRepository->update($request->all(), $id);

        Flash::success('Inmueble Tipo updated successfully.');

        return redirect(route('inmuebleTipos.index'));
    }

    /**
     * Remove the specified InmuebleTipo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inmuebleTipo = $this->inmuebleTipoRepository->findWithoutFail($id);

        if (empty($inmuebleTipo)) {
            Flash::error('Inmueble Tipo not found');

            return redirect(route('inmuebleTipos.index'));
        }

        $this->inmuebleTipoRepository->delete($id);

        Flash::success('Inmueble Tipo deleted successfully.');

        return redirect(route('inmuebleTipos.index'));
    }
}
