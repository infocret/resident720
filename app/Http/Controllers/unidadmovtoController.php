<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateunidadmovtoRequest;
use App\Http\Requests\UpdateunidadmovtoRequest;
use App\Repositories\unidadmovtoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class unidadmovtoController extends AppBaseController
{
    /** @var  unidadmovtoRepository */
    private $unidadmovtoRepository;

    public function __construct(unidadmovtoRepository $unidadmovtoRepo)
    {
        $this->unidadmovtoRepository = $unidadmovtoRepo;
    }

    /**
     * Display a listing of the unidadmovto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->unidadmovtoRepository->pushCriteria(new RequestCriteria($request));
        $unidadmovtos = $this->unidadmovtoRepository->paginate(10);

        return view('unidadmovtos.index')
            ->with('unidadmovtos', $unidadmovtos);
    }

    /**
     * Show the form for creating a new unidadmovto.
     *
     * @return Response
     */
    public function create()
    {
        return view('unidadmovtos.create');
    }

    /**
     * Store a newly created unidadmovto in storage.
     *
     * @param CreateunidadmovtoRequest $request
     *
     * @return Response
     */
    public function store(CreateunidadmovtoRequest $request)
    {
        $input = $request->all();

        $unidadmovto = $this->unidadmovtoRepository->create($input);

        Flash::success('Unidadmovto saved successfully.');

        return redirect(route('unidadmovtos.index'));
    }

    /**
     * Display the specified unidadmovto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unidadmovto = $this->unidadmovtoRepository->findWithoutFail($id);

        if (empty($unidadmovto)) {
            Flash::error('Unidadmovto not found');

            return redirect(route('unidadmovtos.index'));
        }

        return view('unidadmovtos.show')->with('unidadmovto', $unidadmovto);
    }

    /**
     * Show the form for editing the specified unidadmovto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unidadmovto = $this->unidadmovtoRepository->findWithoutFail($id);

        if (empty($unidadmovto)) {
            Flash::error('Unidadmovto not found');

            return redirect(route('unidadmovtos.index'));
        }

        return view('unidadmovtos.edit')->with('unidadmovto', $unidadmovto);
    }

    /**
     * Update the specified unidadmovto in storage.
     *
     * @param  int              $id
     * @param UpdateunidadmovtoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateunidadmovtoRequest $request)
    {
        $unidadmovto = $this->unidadmovtoRepository->findWithoutFail($id);

        if (empty($unidadmovto)) {
            Flash::error('Unidadmovto not found');

            return redirect(route('unidadmovtos.index'));
        }

        $unidadmovto = $this->unidadmovtoRepository->update($request->all(), $id);

        Flash::success('Unidadmovto updated successfully.');

        return redirect(route('unidadmovtos.index'));
    }

    /**
     * Remove the specified unidadmovto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $unidadmovto = $this->unidadmovtoRepository->findWithoutFail($id);

        if (empty($unidadmovto)) {
            Flash::error('Unidadmovto not found');

            return redirect(route('unidadmovtos.index'));
        }

        $this->unidadmovtoRepository->delete($id);

        Flash::success('Unidadmovto deleted successfully.');

        return redirect(route('unidadmovtos.index'));
    }
}
