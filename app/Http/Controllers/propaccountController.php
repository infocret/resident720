<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepropaccountRequest;
use App\Http\Requests\UpdatepropaccountRequest;
use App\Repositories\propaccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

// se agregaron para listas desplegables
use App\Repositories\bankRepository;
use App\Repositories\bankaccountRepository;
use App\Repositories\checkbookRepository;

class propaccountController extends AppBaseController
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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propaccountRepository->pushCriteria(new RequestCriteria($request));
        $propaccounts = $this->propaccountRepository->all();

        return view('propaccounts.index')
            ->with('propaccounts', $propaccounts);
    }
    
    /**
     * Display a listing of the propaccount. ( Revisar si ya no se uas )
     *
     * @param propaccountDataTable $propaccountDataTable
     * @return Response
     */
    // public function inmuindex(Request $request,$inmuid)
    // {
     
    //   $cuentas = $this->propaccountRepository->gCuentas($inmuid);

    //   return view('propaccounts.indexexp')
    //         ->with('cuentas', $cuentas)
    //         ->with('inmuid', $inmuid);

    // }

    /**
     * Show the form for creating a new propaccount.
     *
     * @return Response
     */
    public function create()
    {
        // $propexpid = Session('propertyexpid');     
        // $bancos = $this->bankRepository->gBancos();
        // //dd($bancos);
        // return view('propaccounts.create')
        // ->with('bancos',$bancos)
        // ->with('propexpid',$propexpid);

        return view('propaccounts.create');
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
       
        // $propexpid = Session('propertyexpid');    
        // $input = $request->all();
        // $propaccount = $this->propaccountRepository->create($input);
        // Flash::success('Propaccount saved successfully.');
        // return redirect(route('propaccounts.inmuindex',$propexpid));

        $input = $request->all();
        $propaccount = $this->propaccountRepository->create($input);
        Flash::success('Propaccount saved successfully.');
        return redirect(route('propaccounts.index'));
    }

    /**
     * Display the specified propaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $propaccount = $this->propaccountRepository->findWithoutFail($id);

        if (empty($propaccount)) {
            Flash::error('Propaccount not found');

            return redirect(route('propaccounts.index'));
        }

        return view('propaccounts.show')->with('propaccount', $propaccount);
    }

    /**
     * Show the form for editing the specified propaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $propaccount = $this->propaccountRepository->findWithoutFail($id);

        if (empty($propaccount)) {
            Flash::error('Propaccount not found');

            return redirect(route('propaccounts.index'));
        }

        return view('propaccounts.edit')->with('propaccount', $propaccount);
    }

    /**
     * Update the specified propaccount in storage.
     *
     * @param  int              $id
     * @param UpdatepropaccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropaccountRequest $request)
    {
        $propaccount = $this->propaccountRepository->findWithoutFail($id);

        if (empty($propaccount)) {
            Flash::error('Propaccount not found');

            return redirect(route('propaccounts.index'));
        }

        $propaccount = $this->propaccountRepository->update($request->all(), $id);

        Flash::success('Propaccount updated successfully.');

        return redirect(route('propaccounts.index'));
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

        // $propaccount = $this->propaccountRepository->findWithoutFail($id);        
        // $propexpid = Session('propertyexpid');    
        // if (empty($propaccount)) {
        //     Flash::error('Propaccount not found');
        //     return redirect(route('propaccounts.inmuindex',$propexpid));
        // }
        // $this->propaccountRepository->delete($id);
        // Flash::success('Propaccount deleted successfully.');
        // return redirect(route('propaccounts.inmuindex',$propexpid));

        $propaccount = $this->propaccountRepository->findWithoutFail($id);

        if (empty($propaccount)) {
            Flash::error('Propaccount not found');

            return redirect(route('propaccounts.index'));
        }

        $this->propaccountRepository->delete($id);

        Flash::success('Propaccount deleted successfully.');

        return redirect(route('propaccounts.index'));
    }
}
