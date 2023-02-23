<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateinmuebleRequest;
use App\Http\Requests\UpdateinmuebleRequest;
use App\Repositories\inmuebleRepository;
use App\Repositories\InmuebleTipoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class inmuebleController extends AppBaseController
{
    /** @var  inmuebleRepository */
    private $inmuebleRepository;

    public function __construct(
        inmuebleRepository $inmuebleRepo,
        InmuebleTipoRepository $InmuebleTipoRepo
    )
    {
        $this->inmuebleRepository = $inmuebleRepo;
        $this->InmuebleTipoRepository = $InmuebleTipoRepo;
    }

    

    /**
     * Display a listing of the inmueble.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmuebleRepository->pushCriteria(new RequestCriteria($request));
        $inmuebles = $this->inmuebleRepository->paginate(15); //all();
        

       

        return view('inmuebles.index')
            ->with('inmuebles', $inmuebles);
    }

    /**
     * Show the form for creating a new inmueble.
     *
     * @return Response
     */
    public function create()
    {
        $InmuTipos = $this->InmuebleTipoRepository->gInmuebleTipos(0); //0=Todos
        //dd($InmuTipos);
        return view('inmuebles.create')
        ->with('InmuTipos', $InmuTipos);
    }

    /**
     * Store a newly created inmueble in storage.
     *
     * @param CreateinmuebleRequest $request
     *
     * @return Response
     */
    public function store(CreateinmuebleRequest $request)
    {
        $input = $request->all();

        $inmueble = $this->inmuebleRepository->create($input);

        Flash::success('Inmueble saved successfully.');

        return redirect(route('inmuebles.index'));
    }

    /**
     * Display the specified inmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);
        //$inmutipo = $inmueble->inmuebleTipo->nombre;
        // dd($inmutipo);

        if (empty($inmueble)) {
            Flash::error('Inmueble not found');

            return redirect(route('inmuebles.index'));
        }

        return view('inmuebles.show')->with('inmueble', $inmueble);
    }

    /**
     * Show the form for editing the specified inmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $InmuTipos = $this->InmuebleTipoRepository->gInmuebleTipos(0); //0=Todos
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);
        if (empty($inmueble)) {
            Flash::error('Inmueble not found');

            return redirect(route('inmuebles.index'));
        }

        return view('inmuebles.edit')
        ->with('inmueble', $inmueble)
        ->with('InmuTipos', $InmuTipos);
    }

    /**
     * Update the specified inmueble in storage.
     *
     * @param  int              $id
     * @param UpdateinmuebleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinmuebleRequest $request)
    {
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);

        if (empty($inmueble)) {
            Flash::error('Inmueble not found');

            return redirect(route('inmuebles.index'));
        }

        $inmueble = $this->inmuebleRepository->update($request->all(), $id);

        Flash::success('Inmueble updated successfully.');

        return redirect(route('inmuebles.index'));
    }

    /**
     * Remove the specified inmueble from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);

        if (empty($inmueble)) {
            Flash::error('Inmueble not found');

            return redirect(route('inmuebles.index'));
        }

        $this->inmuebleRepository->delete($id);

        Flash::success('Inmueble deleted successfully.');

        return redirect(route('inmuebles.index'));
    }
}
