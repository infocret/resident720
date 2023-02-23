<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepresupuestoRequest;
use App\Http\Requests\UpdatepresupuestoRequest;
use App\Repositories\presupuestoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class presupuestoController extends AppBaseController
{
    /** @var  presupuestoRepository */
    private $presupuestoRepository;

    public function __construct(presupuestoRepository $presupuestoRepo)
    {
        $this->presupuestoRepository = $presupuestoRepo;
    }

    /**
     * Display a listing of the presupuesto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->presupuestoRepository->pushCriteria(new RequestCriteria($request));
        $presupuestos = $this->presupuestoRepository->all();

        return view('presupuestos.index')
            ->with('presupuestos', $presupuestos);
    }

    /**
     * Show the form for creating a new presupuesto.
     *
     * @return Response
     */
    public function create()
    {
        return view('presupuestos.create');
    }

    /**
     * Store a newly created presupuesto in storage.
     *
     * @param CreatepresupuestoRequest $request
     *
     * @return Response
     */
    public function store(CreatepresupuestoRequest $request)
    {
        $input = $request->all();
        
        $presupuesto = $this->presupuestoRepository->create($input);

        Flash::success('Presupuesto saved successfully.');

        return redirect(route('presupuestos.index'));
    }

    /**
     * Display the specified presupuesto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

        if (empty($presupuesto)) {
            Flash::error('Presupuesto not found');

            return redirect(route('presupuestos.index'));
        }

        return view('presupuestos.show')->with('presupuesto', $presupuesto);
    }

    /**
     * Show the form for editing the specified presupuesto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

        if (empty($presupuesto)) {
            Flash::error('Presupuesto not found');

            return redirect(route('presupuestos.index'));
        }

        return view('presupuestos.edit')->with('presupuesto', $presupuesto);
    }

    /**
     * Update the specified presupuesto in storage.
     *
     * @param  int              $id
     * @param UpdatepresupuestoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepresupuestoRequest $request)
    {
        $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

        if (empty($presupuesto)) {
            Flash::error('Presupuesto not found');

            return redirect(route('presupuestos.index'));
        }

        $presupuesto = $this->presupuestoRepository->update($request->all(), $id);

        Flash::success('Presupuesto updated successfully.');

        return redirect(route('presupuestos.index'));
    }

    /**
     * Remove the specified presupuesto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

        if (empty($presupuesto)) {
            Flash::error('Presupuesto not found');

            return redirect(route('presupuestos.index'));
        }

        $this->presupuestoRepository->delete($id);

        Flash::success('Presupuesto deleted successfully.');

        return redirect(route('presupuestos.index'));
    }
}
