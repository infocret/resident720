<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepropertyvalueRequest;
use App\Http\Requests\UpdatepropertyvalueRequest;
use App\Repositories\propertyvalueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class propertyvalueController extends AppBaseController
{
    /** @var  propertyvalueRepository */
    private $propertyvalueRepository;

    public function __construct(propertyvalueRepository $propertyvalueRepo)
    {
        $this->propertyvalueRepository = $propertyvalueRepo;
    }

    /**
     * Display a listing of the propertyvalue.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propertyvalueRepository->pushCriteria(new RequestCriteria($request));
        $propertyvalues = $this->propertyvalueRepository->all();

        return view('propertyvalues.index')
            ->with('propertyvalues', $propertyvalues);
    }

    /**
     * Show the form for creating a new propertyvalue.
     *
     * @return Response
     */
    public function create()
    {
        return view('propertyvalues.create');
    }

    /**
     * Store a newly created propertyvalue in storage.
     *
     * @param CreatepropertyvalueRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyvalueRequest $request)
    {
        $input = $request->all();

        $propertyvalue = $this->propertyvalueRepository->create($input);

        Flash::success('Propertyvalue saved successfully.');

        return redirect(route('propertyvalues.index'));
    }

    /**
     * Display the specified propertyvalue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('propertyvalues.index'));
        }

        return view('propertyvalues.show')->with('propertyvalue', $propertyvalue);
    }

    /**
     * Show the form for editing the specified propertyvalue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('propertyvalues.index'));
        }

        return view('propertyvalues.edit')->with('propertyvalue', $propertyvalue);
    }

    /**
     * Update the specified propertyvalue in storage.
     *
     * @param  int              $id
     * @param UpdatepropertyvalueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyvalueRequest $request)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('propertyvalues.index'));
        }

        $propertyvalue = $this->propertyvalueRepository->update($request->all(), $id);

        Flash::success('Propertyvalue updated successfully.');

        return redirect(route('propertyvalues.index'));
    }

    /**
     * Remove the specified propertyvalue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('propertyvalues.index'));
        }

        $this->propertyvalueRepository->delete($id);

        Flash::success('Propertyvalue deleted successfully.');

        return redirect(route('propertyvalues.index'));
    }
}
