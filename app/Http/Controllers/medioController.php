<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemedioRequest;
use App\Http\Requests\UpdatemedioRequest;
use App\Repositories\medioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class medioController extends AppBaseController
{
    /** @var  medioRepository */
    private $medioRepository;

    public function __construct(medioRepository $medioRepo)
    {
        $this->medioRepository = $medioRepo;
    }

    /**
     * Display a listing of the medio.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->medioRepository->pushCriteria(new RequestCriteria($request));
        $medios = $this->medioRepository->all();

        return view('medios.index')
            ->with('medios', $medios);
    }

    /**
     * Show the form for creating a new medio.
     *
     * @return Response
     */
    public function create()
    {
        return view('medios.create');
    }

    /**
     * Store a newly created medio in storage.
     *
     * @param CreatemedioRequest $request
     *
     * @return Response
     */
    public function store(CreatemedioRequest $request)
    {
        $input = $request->all();

        $medio = $this->medioRepository->create($input);

        Flash::success('Medio saved successfully.');

        return redirect(route('medios.index'));
    }

    /**
     * Display the specified medio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medio = $this->medioRepository->findWithoutFail($id);

        if (empty($medio)) {
            Flash::error('Medio not found');

            return redirect(route('medios.index'));
        }

        return view('medios.show')->with('medio', $medio);
    }

    /**
     * Show the form for editing the specified medio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medio = $this->medioRepository->findWithoutFail($id);

        if (empty($medio)) {
            Flash::error('Medio not found');

            return redirect(route('medios.index'));
        }

        return view('medios.edit')->with('medio', $medio);
    }

    /**
     * Update the specified medio in storage.
     *
     * @param  int              $id
     * @param UpdatemedioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemedioRequest $request)
    {
        $medio = $this->medioRepository->findWithoutFail($id);

        if (empty($medio)) {
            Flash::error('Medio not found');

            return redirect(route('medios.index'));
        }

        $medio = $this->medioRepository->update($request->all(), $id);

        Flash::success('Medio updated successfully.');

        return redirect(route('medios.index'));
    }

    /**
     * Remove the specified medio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medio = $this->medioRepository->findWithoutFail($id);

        if (empty($medio)) {
            Flash::error('Medio not found');

            return redirect(route('medios.index'));
        }

        $this->medioRepository->delete($id);

        Flash::success('Medio deleted successfully.');

        return redirect(route('medios.index'));
    }
}
