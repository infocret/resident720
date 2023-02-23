<?php

namespace App\Http\Controllers;

use App\DataTables\bankaccountDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatebankaccountRequest;
use App\Http\Requests\UpdatebankaccountRequest;
use App\Repositories\bankaccountRepository;
use App\Repositories\bankRepository;
use App\Repositories\banksquareRepository;
use App\Repositories\currencytypeRepository;

use App\Repositories\checkbookRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

use Illuminate\Http\Request;

class bankaccountController extends AppBaseController
{
    /** @var  bankaccountRepository */
    private $bankaccountRepository;

    public function __construct(
        bankaccountRepository $bankaccountRepo,
        bankRepository $bankRepo,
        banksquareRepository $banksquareRepo,
        currencytypeRepository $currencytypeRepo,
        checkbookRepository $checkbookRepo
    )
    {
        $this->bankaccountRepository = $bankaccountRepo;
        $this->bankRepository = $bankRepo;
        $this->banksquareRepository = $banksquareRepo;
        $this->currencytypeRepository = $currencytypeRepo;
        $this->checkbookRepository = $checkbookRepo;
    }

    /**
     * Display a listing of the bankaccount on datatables.
     *
     * @param bankaccountDataTable $bankaccountDataTable
     * @return Response
     */
    public function index(bankaccountDataTable $bankaccountDataTable)
    {
        return $bankaccountDataTable->render('bankaccounts.index');
    }

 /**
     * Display a listing of the bankaccount.
     *
     * @param Request $request
     * @return Response
     */
    public function indexb(Request $request)
    {
       // $this->bankaccount->pushCriteria(new RequestCriteria($request));
        $bankaccounts = $this->bankaccountRepository->gbankaccounts();

        //dd($bankaccounts);
        return view('bankaccounts.indexb')
            ->with('bankaccounts', $bankaccounts)
           
            ;
    }


    /**
     * Show the form for creating a new bankaccount.
     *
     * @return Response
     */
    public function create()
    {
        $banks = $this->bankRepository->all();        
        $banksqs = $this->banksquareRepository->all();
        $currencys = $this->currencytypeRepository->all();
        return view('bankaccounts.create')
            ->with('banks', $banks)
            ->with('banksqs', $banksqs)
            ->with('currencys', $currencys)
        ;
    }

    /**
     * Store a newly created bankaccount in storage.
     *
     * @param CreatebankaccountRequest $request
     *
     * @return Response
     */
    public function store(CreatebankaccountRequest $request)
    {
        $input = $request->all();
//dd($request->agregarch);


// array:19 [▼
//   "_token" => "yOaMA3CYzE0HceVf5LiUHblw7paXVBj6LTWSLkbM"
//   "clabe" => "123456789012345678"
//   "account" => "12345678901"
//   "opening_date" => "2020-10-01"
//   "bank_id" => "1"
//   "banksquare_id" => "4"
//   "currency_type" => "MXN"
//   "account_type" => "IYE"
//   "ident" => "1234567890"
//   "name" => "12345678901234567890123456789012345"
//   "description" => "12345678901234567890123456789012345678901234567890"
//   "accounting" => "12345678901234567890123456789012345"
//   "allow_overdrafts" => "1"

//   "agregarch" => "1"
//   "shortname" => "12345678901234567890"
//   "fullname" => "12345678901234567890"
//   "descriptionch" => "12345678901234567890"
//   "start" => "1"
//   "end" => "99"
// ]
            // crea array de registro cuenta
             $inputbaccont = array(                 
                "clabe" => $request->clabe,
                "account" =>$request->account,
                "opening_date" => $request->opening_date,
                "bank_id" => $request->bank_id,
                "banksquare_id" => $request->banksquare_id,
                "currency_type" => $request->currency_type,
                "account_type" => $request->account_type,
                "ident" => $request->ident,
                "name" => $request->name,
                "description" => $request->description,
                "accounting" => $request->clabe,
                "allow_overdrafts" => $request->allow_overdrafts
             );  

        $bankaccount = $this->bankaccountRepository->create($inputbaccont);

        if ( !empty($request->agregarch) && $request->agregarch == 1) {
               // crea array de registro chequera
                 $inputchekbook = array(  
                     "bankaccount_id" => $bankaccount->id,               
                     "shortname" => $request->shortname,
                      "fullname" => $request->fullname,
                      "description" => $request->descriptionch,
                      "start" => $request->start,
                      "end" => $request->end
                 );  
            $bankaccount = $this->checkbookRepository->create($inputchekbook);
        }

        Flash::success('Cuenta bancaria guardada.');

        return redirect(route('bankaccounts.indexb'));
    }




 /**
     * Agrega una cuenta desde vista de proveedor
     *
     * @param CreatebankaccountRequest $request
     *
     * @return Response
     */
    public function storepop(CreatebankaccountRequest $request)
    {
      $input = $request->all();
// dd($input);


// array:19 [▼
//   "_token" => "yOaMA3CYzE0HceVf5LiUHblw7paXVBj6LTWSLkbM"
//   "clabe" => "123456789012345678"
//   "account" => "12345678901"
//   "opening_date" => "2020-10-01"
//   "bank_id" => "1"
//   "banksquare_id" => "4"
//   "currency_type" => "MXN"
//   "account_type" => "IYE"
//   "ident" => "1234567890"
//   "name" => "12345678901234567890123456789012345"
//   "description" => "12345678901234567890123456789012345678901234567890"
//   "accounting" => "12345678901234567890123456789012345"
//   "allow_overdrafts" => "1"

//   "agregarch" => "1"
//   "shortname" => "12345678901234567890"
//   "fullname" => "12345678901234567890"
//   "descriptionch" => "12345678901234567890"
//   "start" => "1"
//   "end" => "99"
// ]
// 
// 
// 
        // crea array de registro cuenta
             $inputbaccont = array(                 
                "clabe" => $request->clabe,
                "account" =>$request->account,
                "opening_date" => $request->opening_date,
                "bank_id" => $request->bank_id,
                "banksquare_id" => $request->banksquare_id,
                "currency_type" => $request->currency_type,
                "account_type" => $request->account_type,
                "ident" => $request->ident,
                "name" => $request->name,
                "description" => $request->description,
                "accounting" => $request->clabe,
                "allow_overdrafts" => $request->allow_overdrafts
             );  

        $bankaccount = $this->bankaccountRepository->create($inputbaccont);

        if ( !empty($request->agregarch) && $request->agregarch == 1) {
               // crea array de registro chequera
                 $inputchekbook = array(  
                     "bankaccount_id" => $bankaccount->id,               
                     "shortname" => $request->shortname,
                      "fullname" => $request->fullname,
                      "description" => $request->descriptionch,
                      "start" => $request->start,
                      "end" => $request->end
                 );  
            $bankaccount = $this->checkbookRepository->create($inputchekbook);
        }

        Flash::success('Cuenta bancaria guardada.');

//        return redirect(route('bankaccounts.indexb'));
        return redirect(route('providers.create'));
    }


    /**
     * Display the specified bankaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
       //$bankaccount = $this->bankaccountRepository->findWithoutFail($id);
       $bankaccount = $this->bankaccountRepository->gbankaccount($id);
       $checkbooks = $this->checkbookRepository->gAccountCheckbooks($bankaccount->id);
//dd($checkbooks->shortname);
        if (empty($bankaccount)) {
            Flash::error('Cuenta bancaria no localizada.');

            return redirect(route('bankaccounts.indexb'));
        }

        return view('bankaccounts.show')
        ->with('bankaccount', $bankaccount)
        ->with('checkbooks', $checkbooks)
        ;
    }

    /**
     * Show the form for editing the specified bankaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bankaccount = $this->bankaccountRepository->findWithoutFail($id);

        $banks = $this->bankRepository->all();        
        $banksqs = $this->banksquareRepository->all();
        $currencys = $this->currencytypeRepository->all();

        if (empty($bankaccount)) {
            Flash::error('Cuenta bancaria no localizada.');

            return redirect(route('bankaccounts.indexb'));
        }

        return view('bankaccounts.edit')
        ->with('bankaccount', $bankaccount)
        ->with('banks', $banks)
        ->with('banksqs', $banksqs)
        ->with('currencys', $currencys)
        ;
    }

    /**
     * Update the specified bankaccount in storage.
     *
     * @param  int              $id
     * @param UpdatebankaccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebankaccountRequest $request)
    {
        $bankaccount = $this->bankaccountRepository->findWithoutFail($id);

        if (empty($bankaccount)) {
            Flash::error('Cuenta bancaria no localizada.');

            return redirect(route('bankaccounts.indexb'));
        }

        $bankaccount = $this->bankaccountRepository->update($request->all(), $id);

        Flash::success('Cuenta bancaria actualizada.');

        return redirect(route('bankaccounts.index'));
    }

    /**
     * Remove the specified bankaccount from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bankaccount = $this->bankaccountRepository->findWithoutFail($id);

        if (empty($bankaccount)) {
            Flash::error('Cuenta bancaria no localizada.');

            return redirect(route('bankaccounts.indexb'));
        }

        $this->bankaccountRepository->delete($id);

        Flash::success('Cuenta bancaria desactivada..');

        return redirect(route('bankaccounts.indexb'));
    }


 public function getAccounts(Request $request,$bankid)
    {

        if ($request->ajax()){
            $accounts= $this->bankaccountRepository->gAccounts($bankid);            
            return response()->json($accounts); 
        } 
            $accounts= $this->bankaccountRepository->gAccounts($bankid);            
             dd($accounts);
             return response()->json($accounts);      
    }
}
