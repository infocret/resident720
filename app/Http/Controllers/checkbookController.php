<?php

namespace App\Http\Controllers;

use App\DataTables\checkbookDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecheckbookRequest;
use App\Http\Requests\UpdatecheckbookRequest;
use App\Repositories\checkbookRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

use Illuminate\Http\Request;

class checkbookController extends AppBaseController
{
    /** @var  checkbookRepository */
    private $checkbookRepository;

    public function __construct(checkbookRepository $checkbookRepo)
    {
        $this->checkbookRepository = $checkbookRepo;
    }

    /**
     * Display a listing of the checkbook.
     *
     * @param checkbookDataTable $checkbookDataTable
     * @return Response
     */
    public function index(checkbookDataTable $checkbookDataTable)
    {
        return $checkbookDataTable->render('checkbooks.index');
    }

  /**
     * Store a newly created checkbook in storage.
     *
     * @param CreatecheckbookRequest $request
     *
     * @return Response
     */
    public function store(CreatecheckbookRequest $request)
    {
        $input = $request->all();

        $checkbook = $this->checkbookRepository->create($input);

        Flash::success('Chequera guardada correctamente.');

        return '1hola';//redirect(route('checkbooks.index'));
    }

    /**
     * Show the form for creating a new checkbook.
     *
     * @return Response
     */
    public function create()
    {
        $rutstore = 'checkbooks.store';
        return view('checkbooks.create')
        ->with('rutstore',$rutstore);
    }

    /**
     * Muestra vista para nueva chequera desde cuenta bancaria.
     *
     * @return Response
     */
    public function createb($ctaid)
    {        
        $rutstore = 'checkbooks.storeb';
        return view('checkbooks.create')
        ->with('ctaid',$ctaid)
        ->with('rutstore',$rutstore)
        ;
    }

    /**
     * Guarda la chequera.
     *
     * @param CreatecheckbookRequest $request
     *
     * @return Response
     */
    public function storeb(CreatecheckbookRequest $request)
    {
        $input = $request->all();
        //dd( $request->all());
        $checkbook = $this->checkbookRepository->create($input);

  // #attributes: array:9 [▼
  //   "bankaccount_id" => "1"
  //   "shortname" => "nomcorto"
  //   "fullname" => "nombre"
  //   "description" => "descripcion"
  //   "start" => "1"
  //   "end" => "99"
  //   "updated_at" => "2020-10-08 01:58:24"
  //   "created_at" => "2020-10-08 01:58:24"
  //   "id" => 11
  // ]
        Flash::success('Chequera guardada correctamente.');

        return redirect(route('bankaccounts.show',$checkbook->bankaccount_id) );
    }

    /**
     * Display the specified checkbook.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        if (empty($checkbook)) {
            Flash::error('Chequera no localizada.');

            return redirect(route('checkbooks.index'));
        }

        return view('checkbooks.show')->with('checkbook', $checkbook);
    }

    /**
     * Show the form for editing the specified checkbook.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        $rutupdate = 'checkbooks.update';

        if (empty($checkbook)) {
            Flash::error('Chequera no localizada.');

            return redirect(route('checkbooks.index'));
        }

        return view('checkbooks.edit')
        ->with('checkbook', $checkbook)        
        ->with('rutupdate', $rutupdate)
        ;
    }

    /**
     * Update the specified checkbook in storage.
     *
     * @param  int              $id
     * @param UpdatecheckbookRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecheckbookRequest $request)
    {
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        if (empty($checkbook)) {
            Flash::error('Chequera no localizada.');

            return redirect(route('checkbooks.index'));
        }

        $checkbook = $this->checkbookRepository->update($request->all(), $id);

        Flash::success('Chequera actualizada..');

        return redirect(route('checkbooks.index'));
    }


/**
     * Show the form for editing the specified checkbook.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function editb($id)
    {
        $checkbook = $this->checkbookRepository->findWithoutFail($id);
        $rutupdate = 'checkbooks.updateb';  
        $ctaid = $checkbook->bankaccount_id;
        
        if (empty($checkbook)) {
            Flash::error('Chequera no localizada.');

            return redirect(route('checkbooks.index'));
        }

        return view('checkbooks.edit')
        ->with('checkbook', $checkbook)
        ->with('ctaid',$ctaid)
        ->with('rutupdate', $rutupdate)
        ;
    }


    /**
     * Update the specified checkbook in storage.
     *
     * @param  int              $id
     * @param UpdatecheckbookRequest $request
     *
     * @return Response
     */
    public function updateb($id, UpdatecheckbookRequest $request)
    {
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        if (empty($checkbook)) {
            Flash::error('Chequera no localizada.');

            return redirect(route('checkbooks.index'));
        }

        $checkbook = $this->checkbookRepository->update($request->all(), $id);

        Flash::success('Chequera actualizada..');

        //return redirect(route('checkbooks.index'));
        return redirect(route('bankaccounts.show',$checkbook->bankaccount_id) );
    }

    /**
     * Remove the specified checkbook from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        if (empty($checkbook)) {
            Flash::error('Chequera no localizada.');

            return redirect(route('checkbooks.index'));
        }

        $this->checkbookRepository->delete($id);

        Flash::success('Chequera desactivada.');

        return redirect(route('checkbooks.index'));
    }

    /**
     * Remove the specified checkbook from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroyb($id)
    {
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        if (empty($checkbook)) {
            Flash::error('Chequera no localizada.');

            return redirect(route('checkbooks.index'));
        }

        $this->checkbookRepository->delete($id);

        Flash::success('Chequera desactivada.');

        //return redirect(route('checkbooks.index'));
        return redirect(route('bankaccounts.show',$checkbook->bankaccount_id) );
    }
    //
     public function getCheckbooks(Request $request,$banaccountid)
    {

        if ($request->ajax()){
            $checkbooks= $this->checkbookRepository->gCheckbooks($banaccountid);            
            return response()->json($checkbooks); 
        } 
            $checkbooks= $this->checkbookRepository->gCheckbooks($banaccountid);            
             dd($checkbooks);
             return response()->json($checkbooks);      
    }
}
