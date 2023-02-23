<?php

namespace App\Http\Controllers;

use App\DataTables\propertycontractserviceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepropertycontractserviceRequest;
use App\Http\Requests\UpdatepropertycontractserviceRequest;
use App\Repositories\propertycontractserviceRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class propertycontractserviceController extends AppBaseController
{
    /** @var  propertycontractserviceRepository */
    private $propertycontractserviceRepository;

    public function __construct(propertycontractserviceRepository $propertycontractserviceRepo)
    {
        $this->propertycontractserviceRepository = $propertycontractserviceRepo;
    }

    /**
     * Display a listing of the propertycontractservice.
     *
     * @param propertycontractserviceDataTable $propertycontractserviceDataTable
     * @return Response
     */
    public function index(propertycontractserviceDataTable $propertycontractserviceDataTable)
    {
        return $propertycontractserviceDataTable->render('propertycontractservices.index');
    }

    /**
     * Show the form for creating a new propertycontractservice.
     *
     * @return Response
     */
    public function create()
    {
        return view('propertycontractservices.create');
    }

    /**
     * Store a newly created propertycontractservice in storage.
     *
     * @param CreatepropertycontractserviceRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertycontractserviceRequest $request)
    {
        $input = $request->all();

        $propertycontractservice = $this->propertycontractserviceRepository->create($input);

        Flash::success('Propertycontractservice saved successfully.');

        return redirect(route('propertycontractservices.index'));
    }

    /**
     * Display the specified propertycontractservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $propertycontractservice = $this->propertycontractserviceRepository->findWithoutFail($id);

        if (empty($propertycontractservice)) {
            Flash::error('Propertycontractservice not found');

            return redirect(route('propertycontractservices.index'));
        }

        return view('propertycontractservices.show')->with('propertycontractservice', $propertycontractservice);
    }

    /**
     * Show the form for editing the specified propertycontractservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $propertycontractservice = $this->propertycontractserviceRepository->findWithoutFail($id);

        if (empty($propertycontractservice)) {
            Flash::error('Propertycontractservice not found');

            return redirect(route('propertycontractservices.index'));
        }

        return view('propertycontractservices.edit')->with('propertycontractservice', $propertycontractservice);
    }

    /**
     * Update the specified propertycontractservice in storage.
     *
     * @param  int              $id
     * @param UpdatepropertycontractserviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertycontractserviceRequest $request)
    {
        $propertycontractservice = $this->propertycontractserviceRepository->findWithoutFail($id);

        if (empty($propertycontractservice)) {
            Flash::error('Propertycontractservice not found');

            return redirect(route('propertycontractservices.index'));
        }

        $propertycontractservice = $this->propertycontractserviceRepository->update($request->all(), $id);

        Flash::success('Propertycontractservice updated successfully.');

        return redirect(route('propertycontractservices.index'));
    }

    /**
     * Remove the specified propertycontractservice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $propertycontractservice = $this->propertycontractserviceRepository->findWithoutFail($id);

        if (empty($propertycontractservice)) {
            Flash::error('Propertycontractservice not found');

            return redirect(route('propertycontractservices.index'));
        }

        $this->propertycontractserviceRepository->delete($id);

        Flash::success('Propertycontractservice deleted successfully.');

        return redirect(route('propertycontractservices.index'));
    }
}
