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

class inmupropertyvalueController extends AppBaseController
{
    /** @var  propertyvalueRepository */
    private $propertyvalueRepository;

    public function __construct(propertyvalueRepository $propertyvalueRepo)
    {
        $this->propertyvalueRepository = $propertyvalueRepo;
    }

    /**
     * Display a listing of the propertyvalue.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,$inmuid)
    {
        $this->propertyvalueRepository->pushCriteria(new RequestCriteria($request));
        $propertyvalues = $this->propertyvalueRepository->gValUnids($inmuid);
        //dd($propertyvalues);

        return view('inmupropertyvalues.index')
            ->with('propertyvalues', $propertyvalues)
            ->with('inmuid',$inmuid);
    }

    /**
     * Show the form for creating a new propertyvalue.
     *
     * @return Response
     */
    public function create()
    {
        return view('inmupropertyvalues.create');
    }

    /**
     * Store a newly created propertyvalue in storage.
     *
     * @param CreatepropertyvalueRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyvalueRequest $request)
    {
        $input = $request->all();

        $propertyvalue = $this->propertyvalueRepository->create($input);

        Flash::success('Propertyvalue saved successfully.');

        return redirect(route('ivalues.index'));
    }

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

            return redirect(route('ivalues.index',$inmuid));
        }

        return view('inmupropertyvalues.show')
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

            return redirect(route('ivalues.index',$inmuid));
        }

        return view('inmupropertyvalues.edit')
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

            return redirect(route('ivalues.index',$inmuid));
        }

        $propertyvalue = $this->propertyvalueRepository->update($request->all(), $id);

        Flash::success('Propertyvalue updated successfully.');

        return redirect(route('ivalues.index',$inmuid));
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

            return redirect(route('ivalues.index', $inmuid));
        }

        $this->propertyvalueRepository->delete($id);

        Flash::success('Propertyvalue deleted successfully.');

        return redirect(route('ivalues.index', $inmuid));
    }
}
