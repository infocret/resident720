<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInmuebleDirRequest;
use App\Http\Requests\UpdateInmuebleDirRequest;
use App\Repositories\InmuebleDirRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InmuebleDirController extends AppBaseController
{
    /** @var  InmuebleDirRepository */
    private $inmuebleDirRepository;

    public function __construct(InmuebleDirRepository $inmuebleDirRepo)
    {
        $this->inmuebleDirRepository = $inmuebleDirRepo;
    }

    /**
     * Display a listing of the InmuebleDir.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmuebleDirRepository->pushCriteria(new RequestCriteria($request));
        $inmuebleDirs = $this->inmuebleDirRepository->all();

        return view('inmueble_dirs.index')
            ->with('inmuebleDirs', $inmuebleDirs);
    }

    /**
     * Show the form for creating a new InmuebleDir.
     *
     * @return Response
     */
    public function create()
    {
        return view('inmueble_dirs.create');
    }

    /**
     * Store a newly created InmuebleDir in storage.
     *
     * @param CreateInmuebleDirRequest $request
     *
     * @return Response
     */
    public function store(CreateInmuebleDirRequest $request)
    {
        $input = $request->all();

        $inmuebleDir = $this->inmuebleDirRepository->create($input);

        Flash::success('Inmueble Dir saved successfully.');

        return redirect(route('inmuebleDirs.index'));
    }

    /**
     * Display the specified InmuebleDir.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inmuebleDir = $this->inmuebleDirRepository->findWithoutFail($id);

        if (empty($inmuebleDir)) {
            Flash::error('Inmueble Dir not found');

            return redirect(route('inmuebleDirs.index'));
        }

        return view('inmueble_dirs.show')->with('inmuebleDir', $inmuebleDir);
    }

    /**
     * Show the form for editing the specified InmuebleDir.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inmuebleDir = $this->inmuebleDirRepository->findWithoutFail($id);

        if (empty($inmuebleDir)) {
            Flash::error('Inmueble Dir not found');

            return redirect(route('inmuebleDirs.index'));
        }

        return view('inmueble_dirs.edit')->with('inmuebleDir', $inmuebleDir);
    }

    /**
     * Update the specified InmuebleDir in storage.
     *
     * @param  int              $id
     * @param UpdateInmuebleDirRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInmuebleDirRequest $request)
    {
        $inmuebleDir = $this->inmuebleDirRepository->findWithoutFail($id);

        if (empty($inmuebleDir)) {
            Flash::error('Inmueble Dir not found');

            return redirect(route('inmuebleDirs.index'));
        }

        $inmuebleDir = $this->inmuebleDirRepository->update($request->all(), $id);

        Flash::success('Inmueble Dir updated successfully.');

        return redirect(route('inmuebleDirs.index'));
    }

    /**
     * Remove the specified InmuebleDir from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inmuebleDir = $this->inmuebleDirRepository->findWithoutFail($id);

        if (empty($inmuebleDir)) {
            Flash::error('Inmueble Dir not found');

            return redirect(route('inmuebleDirs.index'));
        }

        $this->inmuebleDirRepository->delete($id);

        Flash::success('Inmueble Dir deleted successfully.');

        return redirect(route('inmuebleDirs.index'));
    }
}
