<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersInmuReltipoReqDocRequest;
use App\Http\Requests\UpdatePersInmuReltipoReqDocRequest;
use App\Repositories\PersInmuReltipoReqDocRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PersInmuReltipoReqDocController extends AppBaseController
{
    /** @var  PersInmuReltipoReqDocRepository */
    private $persInmuReltipoReqDocRepository;

    public function __construct(PersInmuReltipoReqDocRepository $persInmuReltipoReqDocRepo)
    {
        $this->persInmuReltipoReqDocRepository = $persInmuReltipoReqDocRepo;
    }

    /**
     * Display a listing of the PersInmuReltipoReqDoc.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->persInmuReltipoReqDocRepository->pushCriteria(new RequestCriteria($request));
        $persInmuReltipoReqDocs = $this->persInmuReltipoReqDocRepository->gPersInmuReltipoReqDocs();

        return view('pers_inmu_reltipo_req_docs.index')
            ->with('persInmuReltipoReqDocs', $persInmuReltipoReqDocs);
    }

    /**
     * Show the form for creating a new PersInmuReltipoReqDoc.
     *
     * @return Response
     */
    public function create()
    {
        $reltypes = $this->persInmuReltipoReqDocRepository->gpersinmreltipos();
        $doctypes = $this->persInmuReltipoReqDocRepository->gdoctypeLista(0);
            //dd( $doctypes);
        return view('pers_inmu_reltipo_req_docs.create')
        ->with('reltypes', $reltypes)
        ->with('doctypes', $doctypes);
    }

    /**
     * Store a newly created PersInmuReltipoReqDoc in storage.
     *
     * @param CreatePersInmuReltipoReqDocRequest $request
     *
     * @return Response
     */
    public function store(CreatePersInmuReltipoReqDocRequest $request)
    {
        $input = $request->all();
           // dd($input);
        $persInmuReltipoReqDoc = $this->persInmuReltipoReqDocRepository->create($input);

        Flash::success('Pers Inmu Reltipo Req Doc saved successfully.');

        return redirect(route('persInmuReltipoReqDocs.index'));
    }

    /**
     * Display the specified PersInmuReltipoReqDoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $persInmuReltipoReqDoc = $this->persInmuReltipoReqDocRepository->findWithoutFail($id);

        if (empty($persInmuReltipoReqDoc)) {
            Flash::error('Pers Inmu Reltipo Req Doc not found');

            return redirect(route('persInmuReltipoReqDocs.index'));
        }

        return view('pers_inmu_reltipo_req_docs.show')->with('persInmuReltipoReqDoc', $persInmuReltipoReqDoc);
    }

    /**
     * Show the form for editing the specified PersInmuReltipoReqDoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $persInmuReltipoReqDoc = $this->persInmuReltipoReqDocRepository->findWithoutFail($id);

        if (empty($persInmuReltipoReqDoc)) {
            Flash::error('Pers Inmu Reltipo Req Doc not found');

            return redirect(route('persInmuReltipoReqDocs.index'));
        }
        $reltypes = $this->persInmuReltipoReqDocRepository->gpersinmreltipos();
        $doctypes = $this->persInmuReltipoReqDocRepository->gdoctypeLista();

        return view('pers_inmu_reltipo_req_docs.edit')
        ->with('persInmuReltipoReqDoc', $persInmuReltipoReqDoc)
        ->with('reltypes', $reltypes)
        ->with('doctypes', $doctypes);

    }

    /**
     * Update the specified PersInmuReltipoReqDoc in storage.
     *
     * @param  int              $id
     * @param UpdatePersInmuReltipoReqDocRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersInmuReltipoReqDocRequest $request)
    {
        $persInmuReltipoReqDoc = $this->persInmuReltipoReqDocRepository->findWithoutFail($id);

        if (empty($persInmuReltipoReqDoc)) {
            Flash::error('Pers Inmu Reltipo Req Doc not found');

            return redirect(route('persInmuReltipoReqDocs.index'));
        }

        $persInmuReltipoReqDoc = $this->persInmuReltipoReqDocRepository->update($request->all(), $id);

        Flash::success('Pers Inmu Reltipo Req Doc updated successfully.');

        return redirect(route('persInmuReltipoReqDocs.index'));
    }

    /**
     * Remove the specified PersInmuReltipoReqDoc from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $persInmuReltipoReqDoc = $this->persInmuReltipoReqDocRepository->findWithoutFail($id);

        if (empty($persInmuReltipoReqDoc)) {
            Flash::error('Pers Inmu Reltipo Req Doc not found');

            return redirect(route('persInmuReltipoReqDocs.index'));
        }

        $this->persInmuReltipoReqDocRepository->delete($id);

        Flash::success('Pers Inmu Reltipo Req Doc deleted successfully.');

        return redirect(route('persInmuReltipoReqDocs.index'));
    }
    // funcion que devuelve la lista de documentos que no estan asignados a un tipo de relacion
     public function getTdocs(Request $request, $trel)
    {

        if ($request->ajax()){
            $ldocs= $this->persInmuReltipoReqDocRepository->gdoctypeLista($trel);                 
            return response()->json($ldocs); 
        } 
           $ldocs= $this->persInmuReltipoReqDocRepository->gdoctypeLista($trel); 

           dd($ldocs)                     ;
            return response()->json($ldocs); 
    }
}
