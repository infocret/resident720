<?php

namespace App\Http\Controllers;

use App\DataTables\currencytypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecurrencytypeRequest;
use App\Http\Requests\UpdatecurrencytypeRequest;
use App\Repositories\currencytypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class currencytypeController extends AppBaseController
{
    /** @var  currencytypeRepository */
    private $currencytypeRepository;

    public function __construct(currencytypeRepository $currencytypeRepo)
    {
        $this->currencytypeRepository = $currencytypeRepo;
    }

    /**
     * Display a listing of the currencytype.
     *
     * @param currencytypeDataTable $currencytypeDataTable
     * @return Response
     */
    public function index(currencytypeDataTable $currencytypeDataTable)
    {
        return $currencytypeDataTable->render('currencytypes.index');
    }

    /**
     * Show the form for creating a new currencytype.
     *
     * @return Response
     */
    public function create()
    {
        return view('currencytypes.create');
    }

    /**
     * Store a newly created currencytype in storage.
     *
     * @param CreatecurrencytypeRequest $request
     *
     * @return Response
     */
    public function store(CreatecurrencytypeRequest $request)
    {
        $input = $request->all();

        $currencytype = $this->currencytypeRepository->create($input);

        Flash::success('Currencytype saved successfully.');

        return redirect(route('currencytypes.index'));
    }

    /**
     * Display the specified currencytype.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $currencytype = $this->currencytypeRepository->findWithoutFail($id);

        if (empty($currencytype)) {
            Flash::error('Currencytype not found');

            return redirect(route('currencytypes.index'));
        }

        return view('currencytypes.show')->with('currencytype', $currencytype);
    }

    /**
     * Show the form for editing the specified currencytype.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $currencytype = $this->currencytypeRepository->findWithoutFail($id);

        if (empty($currencytype)) {
            Flash::error('Currencytype not found');

            return redirect(route('currencytypes.index'));
        }

        return view('currencytypes.edit')->with('currencytype', $currencytype);
    }

    /**
     * Update the specified currencytype in storage.
     *
     * @param  int              $id
     * @param UpdatecurrencytypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecurrencytypeRequest $request)
    {
        $currencytype = $this->currencytypeRepository->findWithoutFail($id);

        if (empty($currencytype)) {
            Flash::error('Currencytype not found');

            return redirect(route('currencytypes.index'));
        }

        $currencytype = $this->currencytypeRepository->update($request->all(), $id);

        Flash::success('Currencytype updated successfully.');

        return redirect(route('currencytypes.index'));
    }

    /**
     * Remove the specified currencytype from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $currencytype = $this->currencytypeRepository->findWithoutFail($id);

        if (empty($currencytype)) {
            Flash::error('Currencytype not found');

            return redirect(route('currencytypes.index'));
        }

        $this->currencytypeRepository->delete($id);

        Flash::success('Currencytype deleted successfully.');

        return redirect(route('currencytypes.index'));
    }
}
