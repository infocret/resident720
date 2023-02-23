<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepropertyparameterRequest;
use App\Http\Requests\UpdatepropertyparameterRequest;
use App\Repositories\propertyparameterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class exppropparameterController extends AppBaseController
{
    /** @var  propertyparameterRepository */
    private $propertyparameterRepository;

    public function __construct(propertyparameterRepository $propertyparameterRepo)
    {
        $this->propertyparameterRepository = $propertyparameterRepo;
    }

    /**
     * Display a listing of the propertyparameter.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,$condomid)
    {
        $this->propertyparameterRepository->pushCriteria(new RequestCriteria($request));
       
        $propertyparameters = $this->propertyparameterRepository->gParamDesc($condomid);
        //dd($propertyparameters);
        
        //$paramname='';

        return view('expedpropparams.index')
            ->with('propertyparameters', $propertyparameters)
            ->with('condomid',$condomid);
    }

    /**
     * Show the form for creating a new propertyparameter.
     *
     * @return Response
     */
    public function create()
    {
        return view('expedpropparams.create');
    }

    /**
     * Store a newly created propertyparameter in storage.
     *
     * @param CreatepropertyparameterRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyparameterRequest $request)
    {
        $input = $request->all();

        $propertyparameter = $this->propertyparameterRepository->create($input);

        Flash::success('Propertyparameter saved successfully.');

        return redirect(route('pparams.index'));
    }

    /**
     * Display the specified propertyparameter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,$condomid)
    {
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            Flash::error('Propertyparameter not found');

            return redirect(route('pparams.index',$condomid));
        }

        return view('expedpropparams.show')->with('propertyparameter', $propertyparameter);
    }

    /**
     * Show the form for editing the specified propertyparameter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,$condomid)
    {
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);        
        //dd($propertyparameter);
        if (empty($propertyparameter)) {
            Flash::error('Propertyparameter not found');

            return redirect(route('pparams.index',$condomid));
        }

        $pclave = $propertyparameter->parametro;

        $paraminfo = $this->propertyparameterRepository->gParamInfo($pclave);  

        //dd($paraminfo[0]->descripcion) ;     

        return view('expedpropparams.edit')
        ->with('propertyparameter', $propertyparameter)
        ->with('paraminfo',$paraminfo)
        ->with('condomid', $condomid);
    }

    /**
     * Update the specified propertyparameter in storage.
     *
     * @param  int              $id
     * @param UpdatepropertyparameterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyparameterRequest $request,$condomid)
    {
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            Flash::error('Propertyparameter not found');

            return redirect(route('pparams.index',$condomid));
        }

        // si el campo 'valor' no viene definido o si se desmarco un checkbox
        if (empty($request->valor)){
            array_add($request, 'valor', 0);
            //dd($request->all());           
        }
        else{
            //dd('SI viene');
         }



        $propertyparameter = $this->propertyparameterRepository->update($request->all(), $id);

        Flash::success('Parametro Actualizado correctamente.');

        return redirect(route('pparams.index',$condomid));
    }

    /**
     * Remove the specified propertyparameter from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id,$condomid)
    {
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            Flash::error('Propertyparameter not found');

            return redirect(route('pparams.index',$condomid));
        }

        $this->propertyparameterRepository->delete($id);

        Flash::success('Propertyparameter deleted successfully.');

        return redirect(route('pparams.index',$condomid));
    }
}
