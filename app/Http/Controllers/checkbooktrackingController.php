<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecheckbooktrackingRequest;
use App\Http\Requests\UpdatecheckbooktrackingRequest;
use App\Repositories\checkbooktrackingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class checkbooktrackingController extends AppBaseController
{
    /** @var  checkbooktrackingRepository */
    private $checkbooktrackingRepository;

    public function __construct(checkbooktrackingRepository $checkbooktrackingRepo)
    {
        $this->checkbooktrackingRepository = $checkbooktrackingRepo;
    }

    /**
     * Display a listing of the checkbooktracking.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->checkbooktrackingRepository->pushCriteria(new RequestCriteria($request));
        $checkbooktrackings = $this->checkbooktrackingRepository->all();

        return view('checkbooktrackings.index')
            ->with('checkbooktrackings', $checkbooktrackings);
    }

    /**
     * Show the form for creating a new checkbooktracking.
     *
     * @return Response
     */
    public function create()
    {
        return view('checkbooktrackings.create');
    }

    /**
     * Store a newly created checkbooktracking in storage.
     *
     * @param CreatecheckbooktrackingRequest $request
     *
     * @return Response
     */
    public function store(CreatecheckbooktrackingRequest $request)
    {
        $input = $request->all();

        $checkbooktracking = $this->checkbooktrackingRepository->create($input);

        Flash::success('Checkbooktracking saved successfully.');

        return redirect(route('checkbooktrackings.index'));
    }

    /**
     * Display the specified checkbooktracking.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $checkbooktracking = $this->checkbooktrackingRepository->findWithoutFail($id);

        if (empty($checkbooktracking)) {
            Flash::error('Checkbooktracking not found');

            return redirect(route('checkbooktrackings.index'));
        }

        return view('checkbooktrackings.show')->with('checkbooktracking', $checkbooktracking);
    }

    /**
     * Show the form for editing the specified checkbooktracking.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $checkbooktracking = $this->checkbooktrackingRepository->findWithoutFail($id);

        if (empty($checkbooktracking)) {
            Flash::error('Checkbooktracking not found');

            return redirect(route('checkbooktrackings.index'));
        }

        return view('checkbooktrackings.edit')->with('checkbooktracking', $checkbooktracking);
    }

    /**
     * Update the specified checkbooktracking in storage.
     *
     * @param  int              $id
     * @param UpdatecheckbooktrackingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecheckbooktrackingRequest $request)
    {
        $checkbooktracking = $this->checkbooktrackingRepository->findWithoutFail($id);

        if (empty($checkbooktracking)) {
            Flash::error('Checkbooktracking not found');

            return redirect(route('checkbooktrackings.index'));
        }

        $checkbooktracking = $this->checkbooktrackingRepository->update($request->all(), $id);

        Flash::success('Checkbooktracking updated successfully.');

        return redirect(route('checkbooktrackings.index'));
    }

    /**
     * Remove the specified checkbooktracking from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $checkbooktracking = $this->checkbooktrackingRepository->findWithoutFail($id);

        if (empty($checkbooktracking)) {
            Flash::error('Checkbooktracking not found');

            return redirect(route('checkbooktrackings.index'));
        }

        $this->checkbooktrackingRepository->delete($id);

        Flash::success('Checkbooktracking deleted successfully.');

        return redirect(route('checkbooktrackings.index'));
    }
}
