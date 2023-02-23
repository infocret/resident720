<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocTypeRequest;
use App\Http\Requests\UpdateDocTypeRequest;
use App\Repositories\DocTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DocTypeController extends AppBaseController
{
    /** @var  DocTypeRepository */
    private $docTypeRepository;

    public function __construct(DocTypeRepository $docTypeRepo)
    {
        $this->docTypeRepository = $docTypeRepo;
    }

    /**
     * Display a listing of the DocType.
     *
     * @param Request $request
     * @return Response
     * foreach ($docTypes as $doctype){
          dd( $doctype->fileType->nombre );
        };
     */
    public function index(Request $request)
    {
        $this->docTypeRepository->pushCriteria(new RequestCriteria($request));
        
        $docTypes = $this->docTypeRepository->gtdocs();    

        return view('doc_types.index')
            ->with('docTypes', $docTypes);
    }

    /**
     * Show the form for creating a new DocType.
     *
     * @return Response
     */
    public function create()
    {
        $filetypeList = $this->docTypeRepository->gfiletypeLista();

        //dd($filetypeList);

        return view('doc_types.create')
        
         ->with('filetypeList', $filetypeList);
    }

    /**
     * Store a newly created DocType in storage.
     *
     * @param CreateDocTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateDocTypeRequest $request)
    {
        $input = $request->all();

        $docType = $this->docTypeRepository->create($input);

        Flash::success('Doc Type saved successfully.');

        return redirect(route('docTypes.index'));
    }

    /**
     * Display the specified DocType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $docType = $this->docTypeRepository->findWithoutFail($id);

        if (empty($docType)) {
            Flash::error('Doc Type not found');

            return redirect(route('docTypes.index'));
        }

        $ftypeident = $docType->fileType->ident;
        $ftypenom = $docType->fileType->nombre;
        $filetype = $ftypeident ." - ". $ftypenom;

        return view('doc_types.show')
        ->with('docType', $docType)
        ->with('filetype', $filetype);
    }

    /**
     * Show the form for editing the specified DocType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $docType = $this->docTypeRepository->findWithoutFail($id);

        if (empty($docType)) {
            Flash::error('Doc Type not found');

            return redirect(route('docTypes.index'));
        }

        $filetypeList = $this->docTypeRepository->gfiletypeLista();

        return view('doc_types.edit')
        ->with('docType', $docType)
        ->with('filetypeList', $filetypeList);
    }

    /**
     * Update the specified DocType in storage.
     *
     * @param  int              $id
     * @param UpdateDocTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocTypeRequest $request)
    {
        $docType = $this->docTypeRepository->findWithoutFail($id);

        if (empty($docType)) {
            Flash::error('Doc Type not found');

            return redirect(route('docTypes.index'));
        }

        $docType = $this->docTypeRepository->update($request->all(), $id);

        Flash::success('Doc Type updated successfully.');

        return redirect(route('docTypes.index'));
    }

    /**
     * Remove the specified DocType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $docType = $this->docTypeRepository->findWithoutFail($id);

        if (empty($docType)) {
            Flash::error('Doc Type not found');

            return redirect(route('docTypes.index'));
        }

        $this->docTypeRepository->delete($id);

        Flash::success('Doc Type deleted successfully.');

        return redirect(route('docTypes.index'));
    }
}
