<?php

namespace App\Http\Controllers;

use App\DataTables\propaccountDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepropaccountRequest;
use App\Http\Requests\UpdatepropaccountRequest;
use App\Repositories\propaccountRepository;
// se agregaron para listas desplegables
use App\Repositories\bankRepository;
use App\Repositories\bankaccountRepository;
use App\Repositories\checkbookRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

use Illuminate\Http\Request;

class condomaccountController extends AppBaseController
{
    /** @var  propaccountRepository */
    private $propaccountRepository;

    public function __construct(
        propaccountRepository $propaccountRepo,
        bankRepository $bankRepo,
        bankaccountRepository $bankaccountRepo,
        checkbookRepository $checkbookRepo
    )
    {
        $this->propaccountRepository = $propaccountRepo;
        $this->bankRepository = $bankRepo;
        $this->bankaccountRepository = $bankaccountRepo;
        $this->checkbookRepository = $checkbookRepo;
    }

    /**
     * Display a listing of the propaccount.
     *
     * @param propaccountDataTable $propaccountDataTable
     * @return Response
     */
    // public function index(propaccountDataTable $propaccountDataTable)
    // {
    //     return $propaccountDataTable->render('propaccounts.index');
    // }

    /**
     * Display a listing of the propaccount.
     *
     * @param propaccountDataTable $propaccountDataTable
     * @return Response
     */
    public function index(Request $request,$inmuid)
    {
     
      $cuentas = $this->propaccountRepository->gCuentas($inmuid,0);
            
      return view('condomaccounts.indexexp')
            ->with('cuentas', $cuentas)
            ->with('inmuid', $inmuid);

    }

    /**
     * Show the form for creating a new propaccount.
     *
     * @return Response
     */
    public function create($inmuid)
    {       
        $bancos = $this->bankRepository->gBancos();     

        return view('condomaccounts.create')
        ->with('bancos',$bancos)
        ->with('inmuid',$inmuid);
    }

    /**
     * Store a newly created propaccount in storage.
     *
     * @param CreatepropaccountRequest $request
     *
     * @return Response
     */
    public function store(CreatepropaccountRequest $request)
    {
        $inmuid =$request->input('inmueble_id') ;
        $input = $request->all();

        $propaccount = $this->propaccountRepository->create($input);

        Flash::success('Cuenta asignada correctamente.');

        return redirect(route('condomaccounts.index',$inmuid));
    }

    /**
     * Display the specified propaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,$inmuid)
    {
        //$propaccount = $this->propaccountRepository->findWithoutFail($id);
        $arr_propaccount = $this->propaccountRepository->gCuentas(0,$id);
        $propaccount = $arr_propaccount[0];       
            //dd($propaccount);
        if (empty($propaccount)) {
            Flash::error('Cuenta bancaria no localizada');

            return redirect(route('condomaccounts.index',$inmuid));
        }

        return view('condomaccounts.show')
        ->with('propaccount', $propaccount)
        ->with('inmuid',$inmuid);
    }

    /**
     * Show the form for editing the specified propaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,$inmuid)
    {
        //$propaccount = $this->propaccountRepository->findWithoutFail($id);
        $arr_propaccount = $this->propaccountRepository->gCuentas(0,$id);
        $propaccount = $arr_propaccount[0]; 
        
        if (empty($propaccount)) {
            Flash::error('Cuenta bancaria no localizada');

            return redirect(route('condomaccounts.index',$inmuid));
        }
        $bankid = $propaccount->bank_id;
        $bankcta = $propaccount->bcta_id;  
        $bancos = $this->bankRepository->gBancos();       
        $bankaccounts = $this->bankaccountRepository->gAccounts($bankid);
        $bankchbooks = $this->checkbookRepository->gCheckbooks($bankcta);
        //        dd($bankchbooks); 
        return view('condomaccounts.edit')
        ->with('propaccount', $propaccount)
        ->with('bankaccounts', $bankaccounts)
        ->with('bankchbooks', $bankchbooks)
        ->with('bancos', $bancos)
        ->with('inmuid',$inmuid);
    }

    /**
     * Update the specified propaccount in storage.
     *
     * @param  int              $id
     * @param UpdatepropaccountRequest $request
     *
     * @return Response
     */
    public function update($id,$inmuid, UpdatepropaccountRequest $request)
    {
        $propaccount = $this->propaccountRepository->findWithoutFail($id);

        if (empty($propaccount)) {
            Flash::error('Propaccount not found');

            return redirect(route('condomaccounts.index',$inmuid));
        }

        $propaccount = $this->propaccountRepository->update($request->all(), $id);

        Flash::success('Propaccount updated successfully.');

        return redirect(route('condomaccounts.index',$inmuid));
    }

    /**
     * Remove the specified propaccount from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $propaccount = $this->propaccountRepository->findWithoutFail($id);        
        
        if (empty($propaccount)) {
            Flash::error('Propaccount not found');

            return redirect(route('condomaccounts.inmuindex',$propexpid));
        }
        $inmuid= $propaccount->inmueble_id;
        $this->propaccountRepository->delete($id);

        Flash::success('Cuenta desligada.');

        return redirect(route('condomaccounts.index',$inmuid));
    }


   
}
