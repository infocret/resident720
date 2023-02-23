<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprovcatsRequest;
use App\Http\Requests\UpdateprovcatsRequest;
use App\Repositories\provcatsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class provcatsController extends AppBaseController
{
    /** @var  provcatsRepository */
    private $provcatsRepository;

    public function __construct(provcatsRepository $provcatsRepo)
    {
        $this->provcatsRepository = $provcatsRepo;
    }

    /**
     * Display a listing of the provcats.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->provcatsRepository->pushCriteria(new RequestCriteria($request));
        $provcats = $this->provcatsRepository->all();

        return view('provcats.index')
            ->with('provcats', $provcats);
    }

    /**
     * Show the form for creating a new provcats.
     *
     * @return Response
     */
    public function create()
    {
        return view('provcats.create');
    }

    /**
     * Store a newly created provcats in storage.
     *
     * @param CreateprovcatsRequest $request
     *
     * @return Response
     */
    public function store(CreateprovcatsRequest $request)
    {
        $input = $request->all();

        $provcats = $this->provcatsRepository->create($input);

        Flash::success('Categoria guardada correctamente.');

        return redirect(route('provcats.index'));
    }

 /**
     * Agrega una categoria desde vista de proveedor
     *
     * @param CreateprovcatsRequest $request
     *
     * @return Response
     */
    public function storepop(CreateprovcatsRequest $request)
    {

        $input = $request->all();

        $tipo = $request->input("tipo");
        $cat = $request->input("categoria");

        $catexist = $this->provcatsRepository->existcat($tipo,$cat);
        //dd($catexist);

        if (empty($catexist)) {
           $provcats = $this->provcatsRepository->create($input);
           Flash::success('Categoria agregada.');
        }
        else{
           Flash::success('Esa categoria ya existe. '.
            $catexist->id.'|'.$catexist->tipo.'|'.$catexist->categoria);            
        }       

        return redirect(route('providers.create'));
    }



    /**
     * Display the specified provcats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $provcats = $this->provcatsRepository->findWithoutFail($id);

        if (empty($provcats)) {
            Flash::error('Categoria No localizada.');

            return redirect(route('provcats.index'));
        }

        return view('provcats.show')->with('provcats', $provcats);
    }

    /**
     * Show the form for editing the specified provcats.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $provcats = $this->provcatsRepository->findWithoutFail($id);

        if (empty($provcats)) {
            Flash::error('Categoria No localizada.');

            return redirect(route('provcats.index'));
        }

        return view('provcats.edit')->with('provcats', $provcats);
    }

    /**
     * Update the specified provcats in storage.
     *
     * @param  int              $id
     * @param UpdateprovcatsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprovcatsRequest $request)
    {
        $provcats = $this->provcatsRepository->findWithoutFail($id);

        if (empty($provcats)) {
            Flash::error('Categoria No localizada.');

            return redirect(route('provcats.index'));
        }

        $provcats = $this->provcatsRepository->update($request->all(), $id);

        Flash::success('Categoria actualizada..');

        return redirect(route('provcats.index'));
    }

    /**
     * Remove the specified provcats from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $provcats = $this->provcatsRepository->findWithoutFail($id);

        if (empty($provcats)) {
            Flash::error('Categoria No localizada.');

            return redirect(route('provcats.index'));
        }

        $this->provcatsRepository->delete($id);

        Flash::success('Categoria eliminada.');

        return redirect(route('provcats.index'));
    }
}
