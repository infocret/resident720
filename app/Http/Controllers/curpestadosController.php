<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecurpestadosRequest;
use App\Http\Requests\UpdatecurpestadosRequest;
use App\Repositories\curpestadosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class curpestadosController extends AppBaseController
{
    /** @var  curpestadosRepository */
    private $curpestadosRepository;

    public function __construct(curpestadosRepository $curpestadosRepo)
    {
        $this->curpestadosRepository = $curpestadosRepo;
    }

    /**
     * Display a listing of the curpestados.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->curpestadosRepository->pushCriteria(new RequestCriteria($request));
        $curpestados = $this->curpestadosRepository->all();

        return view('curpestados.index')
            ->with('curpestados', $curpestados);
    }

    /**
     * Show the form for creating a new curpestados.
     *
     * @return Response
     */
    public function create()
    {
        return view('curpestados.create');
    }

    /**
     * Store a newly created curpestados in storage.
     *
     * @param CreatecurpestadosRequest $request
     *
     * @return Response
     */
    public function store(CreatecurpestadosRequest $request)
    {
        $input = $request->all();

        $curpestados = $this->curpestadosRepository->create($input);

        Flash::success('Curpestados saved successfully.');

        return redirect(route('curpestados.index'));
    }

    /**
     * Display the specified curpestados.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $curpestados = $this->curpestadosRepository->findWithoutFail($id);

        if (empty($curpestados)) {
            Flash::error('Curpestados not found');

            return redirect(route('curpestados.index'));
        }

        return view('curpestados.show')->with('curpestados', $curpestados);
    }

    /**
     * Show the form for editing the specified curpestados.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $curpestados = $this->curpestadosRepository->findWithoutFail($id);

        if (empty($curpestados)) {
            Flash::error('Curpestados not found');

            return redirect(route('curpestados.index'));
        }

        return view('curpestados.edit')->with('curpestados', $curpestados);
    }

    /**
     * Update the specified curpestados in storage.
     *
     * @param  int              $id
     * @param UpdatecurpestadosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecurpestadosRequest $request)
    {
        $curpestados = $this->curpestadosRepository->findWithoutFail($id);

        if (empty($curpestados)) {
            Flash::error('Curpestados not found');

            return redirect(route('curpestados.index'));
        }

        $curpestados = $this->curpestadosRepository->update($request->all(), $id);

        Flash::success('Curpestados updated successfully.');

        return redirect(route('curpestados.index'));
    }

    /**
     * Remove the specified curpestados from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $curpestados = $this->curpestadosRepository->findWithoutFail($id);

        if (empty($curpestados)) {
            Flash::error('Curpestados not found');

            return redirect(route('curpestados.index'));
        }

        $this->curpestadosRepository->delete($id);

        Flash::success('Curpestados deleted successfully.');

        return redirect(route('curpestados.index'));
    }
}
