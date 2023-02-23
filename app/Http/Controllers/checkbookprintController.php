<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecheckbookprintRequest;
use App\Http\Requests\UpdatecheckbookprintRequest;
use App\Repositories\checkbookprintRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class checkbookprintController extends AppBaseController
{
    /** @var  checkbookprintRepository */
    private $checkbookprintRepository;

    public function __construct(checkbookprintRepository $checkbookprintRepo)
    {
        $this->checkbookprintRepository = $checkbookprintRepo;
    }

    /**
     * Display a listing of the checkbookprint.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->checkbookprintRepository->pushCriteria(new RequestCriteria($request));
        $checkbookprints = $this->checkbookprintRepository->all();

        return view('checkbookprints.index')
            ->with('checkbookprints', $checkbookprints);
    }

    /**
     * Show the form for creating a new checkbookprint.
     *
     * @return Response
     */
    public function create()
    {
        return view('checkbookprints.create');
    }

    /**
     * Store a newly created checkbookprint in storage.
     *
     * @param CreatecheckbookprintRequest $request
     *
     * @return Response
     */
    public function store(CreatecheckbookprintRequest $request)
    {
        $input = $request->all();

        $checkbookprint = $this->checkbookprintRepository->create($input);

        Flash::success('Checkbookprint saved successfully.');

        return redirect(route('checkbookprints.index'));
    }

    /**
     * Display the specified checkbookprint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $checkbookprint = $this->checkbookprintRepository->findWithoutFail($id);

        if (empty($checkbookprint)) {
            Flash::error('Checkbookprint not found');

            return redirect(route('checkbookprints.index'));
        }

        return view('checkbookprints.show')->with('checkbookprint', $checkbookprint);
    }

    /**
     * Show the form for editing the specified checkbookprint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $checkbookprint = $this->checkbookprintRepository->findWithoutFail($id);

        if (empty($checkbookprint)) {
            Flash::error('Checkbookprint not found');

            return redirect(route('checkbookprints.index'));
        }

        return view('checkbookprints.edit')->with('checkbookprint', $checkbookprint);
    }

    /**
     * Update the specified checkbookprint in storage.
     *
     * @param  int              $id
     * @param UpdatecheckbookprintRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecheckbookprintRequest $request)
    {
        $checkbookprint = $this->checkbookprintRepository->findWithoutFail($id);

        if (empty($checkbookprint)) {
            Flash::error('Checkbookprint not found');

            return redirect(route('checkbookprints.index'));
        }

        $checkbookprint = $this->checkbookprintRepository->update($request->all(), $id);

        Flash::success('Checkbookprint updated successfully.');

        return redirect(route('checkbookprints.index'));
    }

    /**
     * Remove the specified checkbookprint from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $checkbookprint = $this->checkbookprintRepository->findWithoutFail($id);

        if (empty($checkbookprint)) {
            Flash::error('Checkbookprint not found');

            return redirect(route('checkbookprints.index'));
        }

        $this->checkbookprintRepository->delete($id);

        Flash::success('Checkbookprint deleted successfully.');

        return redirect(route('checkbookprints.index'));
    }
}
