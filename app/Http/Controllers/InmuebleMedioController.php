<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInmuebleMedioRequest;
use App\Http\Requests\UpdateInmuebleMedioRequest;
use App\Repositories\InmuebleMedioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InmuebleMedioController extends AppBaseController
{
    /** @var  InmuebleMedioRepository */
    private $inmuebleMedioRepository;

    public function __construct(InmuebleMedioRepository $inmuebleMedioRepo)
    {
        $this->inmuebleMedioRepository = $inmuebleMedioRepo;
    }

    /**
     * Display a listing of the InmuebleMedio.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmuebleMedioRepository->pushCriteria(new RequestCriteria($request));
        $inmuebleMedios = $this->inmuebleMedioRepository->all();

        return view('inmueble_medios.index')
            ->with('inmuebleMedios', $inmuebleMedios);
    }

    /**
     * Show the form for creating a new InmuebleMedio.
     *
     * @return Response
     */
    public function create()
    {
        return view('inmueble_medios.create');
    }

    /**
     * Store a newly created InmuebleMedio in storage.
     *
     * @param CreateInmuebleMedioRequest $request
     *
     * @return Response
     */
    public function store(CreateInmuebleMedioRequest $request)
    {
        $input = $request->all();

        $inmuebleMedio = $this->inmuebleMedioRepository->create($input);

        Flash::success('Inmueble Medio saved successfully.');

        return redirect(route('inmuebleMedios.index'));
    }

    /**
     * Display the specified InmuebleMedio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inmuebleMedio = $this->inmuebleMedioRepository->findWithoutFail($id);

        if (empty($inmuebleMedio)) {
            Flash::error('Inmueble Medio not found');

            return redirect(route('inmuebleMedios.index'));
        }

        return view('inmueble_medios.show')->with('inmuebleMedio', $inmuebleMedio);
    }

    /**
     * Show the form for editing the specified InmuebleMedio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inmuebleMedio = $this->inmuebleMedioRepository->findWithoutFail($id);

        if (empty($inmuebleMedio)) {
            Flash::error('Inmueble Medio not found');

            return redirect(route('inmuebleMedios.index'));
        }

        return view('inmueble_medios.edit')->with('inmuebleMedio', $inmuebleMedio);
    }

    /**
     * Update the specified InmuebleMedio in storage.
     *
     * @param  int              $id
     * @param UpdateInmuebleMedioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInmuebleMedioRequest $request)
    {
        $inmuebleMedio = $this->inmuebleMedioRepository->findWithoutFail($id);

        if (empty($inmuebleMedio)) {
            Flash::error('Inmueble Medio not found');

            return redirect(route('inmuebleMedios.index'));
        }

        $inmuebleMedio = $this->inmuebleMedioRepository->update($request->all(), $id);

        Flash::success('Inmueble Medio updated successfully.');

        return redirect(route('inmuebleMedios.index'));
    }

    /**
     * Remove the specified InmuebleMedio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inmuebleMedio = $this->inmuebleMedioRepository->findWithoutFail($id);

        if (empty($inmuebleMedio)) {
            Flash::error('Inmueble Medio not found');

            return redirect(route('inmuebleMedios.index'));
        }

        $this->inmuebleMedioRepository->delete($id);

        Flash::success('Inmueble Medio deleted successfully.');

        return redirect(route('inmuebleMedios.index'));
    }
}
