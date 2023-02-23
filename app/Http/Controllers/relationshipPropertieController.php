<?php

namespace App\Http\Controllers;

use App\DataTables\relationshipPropertieDataTable;
use App\Http\Requests;
use App\Http\Requests\CreaterelationshipPropertieRequest;
use App\Http\Requests\UpdaterelationshipPropertieRequest;
use App\Repositories\relationshipPropertieRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class relationshipPropertieController extends AppBaseController
{
    /** @var  relationshipPropertieRepository */
    private $relationshipPropertieRepository;

    public function __construct(relationshipPropertieRepository $relationshipPropertieRepo)
    {
        $this->relationshipPropertieRepository = $relationshipPropertieRepo;
    }

    /**
     * Display a listing of the relationshipPropertie.
     *
     * @param relationshipPropertieDataTable $relationshipPropertieDataTable
     * @return Response
     */
    public function index(relationshipPropertieDataTable $relationshipPropertieDataTable)
    {
        return $relationshipPropertieDataTable->render('relationship_properties.index');
    }

    /**
     * Show the form for creating a new relationshipPropertie.
     *
     * @return Response
     */
    public function create()
    {
        return view('relationship_properties.create');
    }

    /**
     * Store a newly created relationshipPropertie in storage.
     *
     * @param CreaterelationshipPropertieRequest $request
     *
     * @return Response
     */
    public function store(CreaterelationshipPropertieRequest $request)
    {
        $input = $request->all();

        $relationshipPropertie = $this->relationshipPropertieRepository->create($input);

        Flash::success('Relationship Propertie saved successfully.');

        return redirect(route('relationshipProperties.index'));
    }

    /**
     * Display the specified relationshipPropertie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $relationshipPropertie = $this->relationshipPropertieRepository->findWithoutFail($id);

        if (empty($relationshipPropertie)) {
            Flash::error('Relationship Propertie not found');

            return redirect(route('relationshipProperties.index'));
        }

        return view('relationship_properties.show')->with('relationshipPropertie', $relationshipPropertie);
    }

    /**
     * Show the form for editing the specified relationshipPropertie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $relationshipPropertie = $this->relationshipPropertieRepository->findWithoutFail($id);

        if (empty($relationshipPropertie)) {
            Flash::error('Relationship Propertie not found');

            return redirect(route('relationshipProperties.index'));
        }

        return view('relationship_properties.edit')->with('relationshipPropertie', $relationshipPropertie);
    }

    /**
     * Update the specified relationshipPropertie in storage.
     *
     * @param  int              $id
     * @param UpdaterelationshipPropertieRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterelationshipPropertieRequest $request)
    {
        $relationshipPropertie = $this->relationshipPropertieRepository->findWithoutFail($id);

        if (empty($relationshipPropertie)) {
            Flash::error('Relationship Propertie not found');

            return redirect(route('relationshipProperties.index'));
        }

        $relationshipPropertie = $this->relationshipPropertieRepository->update($request->all(), $id);

        Flash::success('Relationship Propertie updated successfully.');

        return redirect(route('relationshipProperties.index'));
    }

    /**
     * Remove the specified relationshipPropertie from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $relationshipPropertie = $this->relationshipPropertieRepository->findWithoutFail($id);

        if (empty($relationshipPropertie)) {
            Flash::error('Relationship Propertie not found');

            return redirect(route('relationshipProperties.index'));
        }

        $this->relationshipPropertieRepository->delete($id);

        Flash::success('Relationship Propertie deleted successfully.');

        return redirect(route('relationshipProperties.index'));
    }
}
