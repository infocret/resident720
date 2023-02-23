<?php

namespace App\Http\Controllers;

use App\DataTables\movimientoTipoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemovimientoTipoRequest;
use App\Http\Requests\UpdatemovimientoTipoRequest;
use App\Repositories\movimientoTipoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class movimientoTipoController extends AppBaseController
{
    /** @var  movimientoTipoRepository */
    private $movimientoTipoRepository;

    public function __construct(movimientoTipoRepository $movimientoTipoRepo)
    {
        $this->movimientoTipoRepository = $movimientoTipoRepo;
    }

    /**
     * Display a listing of the movimientoTipo.
     *
     * @param movimientoTipoDataTable $movimientoTipoDataTable
     * @return Response
     */
    public function index(movimientoTipoDataTable $movimientoTipoDataTable)
    {
        return $movimientoTipoDataTable->render('movimiento_tipos.index');
    }

    /**
     * Show the form for creating a new movimientoTipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('movimiento_tipos.create');
    }

    /**
     * Store a newly created movimientoTipo in storage.
     *
     * @param CreatemovimientoTipoRequest $request
     *
     * @return Response
     */
    public function store(CreatemovimientoTipoRequest $request)
    {
        $input = $request->all();

        $movimientoTipo = $this->movimientoTipoRepository->create($input);

        Flash::success('Movimiento Tipo saved successfully.');

        return redirect(route('movimientoTipos.index'));
    }

    /**
     * Display the specified movimientoTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $movimientoTipo = $this->movimientoTipoRepository->findWithoutFail($id);

        if (empty($movimientoTipo)) {
            Flash::error('Movimiento Tipo not found');

            return redirect(route('movimientoTipos.index'));
        }

        return view('movimiento_tipos.show')->with('movimientoTipo', $movimientoTipo);
    }

    /**
     * Show the form for editing the specified movimientoTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $movimientoTipo = $this->movimientoTipoRepository->findWithoutFail($id);

        if (empty($movimientoTipo)) {
            Flash::error('Movimiento Tipo not found');

            return redirect(route('movimientoTipos.index'));
        }

        return view('movimiento_tipos.edit')->with('movimientoTipo', $movimientoTipo);
    }

    /**
     * Update the specified movimientoTipo in storage.
     *
     * @param  int              $id
     * @param UpdatemovimientoTipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovimientoTipoRequest $request)
    {
        $movimientoTipo = $this->movimientoTipoRepository->findWithoutFail($id);

        if (empty($movimientoTipo)) {
            Flash::error('Movimiento Tipo not found');

            return redirect(route('movimientoTipos.index'));
        }

        $movimientoTipo = $this->movimientoTipoRepository->update($request->all(), $id);

        Flash::success('Movimiento Tipo updated successfully.');

        return redirect(route('movimientoTipos.index'));
    }

    /**
     * Remove the specified movimientoTipo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $movimientoTipo = $this->movimientoTipoRepository->findWithoutFail($id);

        if (empty($movimientoTipo)) {
            Flash::error('Movimiento Tipo not found');

            return redirect(route('movimientoTipos.index'));
        }

        $this->movimientoTipoRepository->delete($id);

        Flash::success('Movimiento Tipo deleted successfully.');

        return redirect(route('movimientoTipos.index'));
    }
}
