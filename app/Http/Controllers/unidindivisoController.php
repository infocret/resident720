<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepropertyvalueRequest;
use App\Http\Requests\UpdatepropertyvalueRequest;
use App\Repositories\propertyvalueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class unidindivisoController extends AppBaseController
{
    /** @var  propertyvalueRepository */
    private $propertyvalueRepository;

    public function __construct(propertyvalueRepository $propertyvalueRepo)
    {
        $this->propertyvalueRepository = $propertyvalueRepo;
    }

    /**
     * Muestra indivisos de unidades deun condominio
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,$inmuid)
    {
        $this->propertyvalueRepository->pushCriteria(new RequestCriteria($request));
        $this->propertyvalueRepository->pushCriteria(new RequestCriteria($request));
        $indivisos = $this->propertyvalueRepository->gIndivlUnid($inmuid);
        //dd($indivisos);

        return view('unidindivisos.index')
            ->with('indivisos', $indivisos)
            ->with('inmuid',$inmuid);
    }
   
    /**
     * Show the form for creating a new propertyvalue.
     *
     * @return Response
     */
    // public function create()
    // {
    //     return view('unidindivisos.create');
    // }

    /**
     * Store a newly created propertyvalue in storage.
     *
     * @param CreatepropertyvalueRequest $request
     *
     * @return Response
     */
    //public function store(CreatepropertyvalueRequest $request)
    // {
    //     $input = $request->all();

    //     $propertyvalue = $this->propertyvalueRepository->create($input);

    //     Flash::success('Propertyvalue saved successfully.');

    //     return redirect(route('indivisosu.index'));
    // }

    /**
     * Display the specified propertyvalue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,$inmuid)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('indivisosu.index',$inmuid));
        }

        return view('unidindivisos.show')
        ->with('propertyvalue', $propertyvalue)
        ->with('inmuid', $inmuid)
        ;
    }

    /**
     * Show the form for editing the specified propertyvalue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,$inmuid)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);
        $unidcve = $propertyvalue->inmueble->ident;
        $unidnom = $propertyvalue->inmueble->nombre;


        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('indivisosu.index',$inmuid));
        }

        return view('unidindivisos.edit')
        ->with('propertyvalue', $propertyvalue)
        ->with('unidcve', $unidcve)
        ->with('unidnom', $unidnom)
        ->with('inmuid', $inmuid)
        ;
    }

    /**
     * Update the specified propertyvalue in storage.
     *
     * @param  int              $id
     * @param UpdatepropertyvalueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyvalueRequest $request,$inmuid)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('indivisosu.index',$inmuid));
        }

        $propertyvalue = $this->propertyvalueRepository->update($request->all(), $id);

        Flash::success('Propertyvalue updated successfully.');

        return redirect(route('indivisosu.index',$inmuid));
    }

    /**
     * Remove the specified propertyvalue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id,$inmuid)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('indivisosu.index', $inmuid));
        }

        $this->propertyvalueRepository->delete($id);

        Flash::success('Propertyvalue deleted successfully.');

        return redirect(route('indivisosu.index', $inmuid));
    }
}
