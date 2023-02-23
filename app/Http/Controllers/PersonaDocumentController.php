<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonaDocumentRequest;
use App\Http\Requests\UpdatePersonaDocumentRequest;
use App\Repositories\PersonaDocumentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PersonaDocumentController extends AppBaseController
{
    /** @var  PersonaDocumentRepository */
    private $personaDocumentRepository;

    public function __construct(PersonaDocumentRepository $personaDocumentRepo)
    {
        $this->personaDocumentRepository = $personaDocumentRepo;
    }

    /**
     * Display a listing of the PersonaDocument.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->personaDocumentRepository->pushCriteria(new RequestCriteria($request));
        $personaDocuments = $this->personaDocumentRepository->all();

        return view('persona_documents.index')
            ->with('personaDocuments', $personaDocuments);
    }

    /**
     * Show the form for creating a new PersonaDocument.
     *
     * @return Response
     */
    public function create()
    {
        return view('persona_documents.create');
    }

    /**
     * Store a newly created PersonaDocument in storage.
     *
     * @param CreatePersonaDocumentRequest $request
     *
     * @return Response
     */
    public function store(CreatePersonaDocumentRequest $request)
    {
        $input = $request->all();

        $personaDocument = $this->personaDocumentRepository->create($input);

        Flash::success('Persona Document saved successfully.');

        return redirect(route('personaDocuments.index'));
    }

    /**
     * Display the specified PersonaDocument.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $personaDocument = $this->personaDocumentRepository->findWithoutFail($id);

        if (empty($personaDocument)) {
            Flash::error('Persona Document not found');

            return redirect(route('personaDocuments.index'));
        }

        return view('persona_documents.show')->with('personaDocument', $personaDocument);
    }

    /**
     * Show the form for editing the specified PersonaDocument.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $personaDocument = $this->personaDocumentRepository->findWithoutFail($id);

        if (empty($personaDocument)) {
            Flash::error('Persona Document not found');

            return redirect(route('personaDocuments.index'));
        }

        return view('persona_documents.edit')->with('personaDocument', $personaDocument);
    }

    /**
     * Update the specified PersonaDocument in storage.
     *
     * @param  int              $id
     * @param UpdatePersonaDocumentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersonaDocumentRequest $request)
    {
        $personaDocument = $this->personaDocumentRepository->findWithoutFail($id);

        if (empty($personaDocument)) {
            Flash::error('Persona Document not found');

            return redirect(route('personaDocuments.index'));
        }

        $personaDocument = $this->personaDocumentRepository->update($request->all(), $id);

        Flash::success('Persona Document updated successfully.');

        return redirect(route('personaDocuments.index'));
    }

    /**
     * Remove the specified PersonaDocument from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $personaDocument = $this->personaDocumentRepository->findWithoutFail($id);

        if (empty($personaDocument)) {
            Flash::error('Persona Document not found');

            return redirect(route('personaDocuments.index'));
        }

        $this->personaDocumentRepository->delete($id);

        Flash::success('Persona Document deleted successfully.');

        return redirect(route('personaDocuments.index'));
    }
}
