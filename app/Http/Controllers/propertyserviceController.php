<?php

namespace App\Http\Controllers;

use App\DataTables\propertyserviceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepropertyserviceRequest;
use App\Http\Requests\UpdatepropertyserviceRequest;
use App\Repositories\propertyserviceRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class propertyserviceController extends AppBaseController
{
    /** @var  propertyserviceRepository */
    private $propertyserviceRepository;

    public function __construct(propertyserviceRepository $propertyserviceRepo)
    {
        $this->propertyserviceRepository = $propertyserviceRepo;
    }

    /**
     * Display a listing of the propertyservice.
     *
     * @param propertyserviceDataTable $propertyserviceDataTable
     * @return Response
     */
    public function index(propertyserviceDataTable $propertyserviceDataTable)
    {
        return $propertyserviceDataTable->render('propertyservices.index');
    }

    /**
     * Show the form for creating a new propertyservice.
     *
     * @return Response
     */
    public function create()
    {
        return view('propertyservices.create');
    }

    /**
     * Store a newly created propertyservice in storage.
     *
     * @param CreatepropertyserviceRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyserviceRequest $request)
    {
        $input = $request->all();

        $propertyservice = $this->propertyserviceRepository->create($input);

        Flash::success('Propertyservice saved successfully.');

        return redirect(route('propertyservices.index'));
    }

    /**
     * Display the specified propertyservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $propertyservice = $this->propertyserviceRepository->findWithoutFail($id);

        if (empty($propertyservice)) {
            Flash::error('Propertyservice not found');

            return redirect(route('propertyservices.index'));
        }

        return view('propertyservices.show')->with('propertyservice', $propertyservice);
    }

    /**
     * Show the form for editing the specified propertyservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $propertyservice = $this->propertyserviceRepository->findWithoutFail($id);

        if (empty($propertyservice)) {
            Flash::error('Propertyservice not found');

            return redirect(route('propertyservices.index'));
        }

        return view('propertyservices.edit')->with('propertyservice', $propertyservice);
    }

    /**
     * Update the specified propertyservice in storage.
     *
     * @param  int              $id
     * @param UpdatepropertyserviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyserviceRequest $request)
    {
        $propertyservice = $this->propertyserviceRepository->findWithoutFail($id);

        if (empty($propertyservice)) {
            Flash::error('Propertyservice not found');

            return redirect(route('propertyservices.index'));
        }

        $propertyservice = $this->propertyserviceRepository->update($request->all(), $id);

        Flash::success('Propertyservice updated successfully.');

        return redirect(route('propertyservices.index'));
    }

    /**
     * Remove the specified propertyservice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $propertyservice = $this->propertyserviceRepository->findWithoutFail($id);

        if (empty($propertyservice)) {
            Flash::error('Propertyservice not found');

            return redirect(route('propertyservices.index'));
        }

        $this->propertyserviceRepository->delete($id);

        Flash::success('Propertyservice deleted successfully.');

        return redirect(route('propertyservices.index'));
    }
}
