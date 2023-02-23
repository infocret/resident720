<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateinmuchargeRequest;
use App\Http\Requests\UpdateinmuchargeRequest;
use App\Repositories\inmuchargeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class inmuchargeController extends AppBaseController
{
    /** @var  inmuchargeRepository */
    private $inmuchargeRepository;

    public function __construct(inmuchargeRepository $inmuchargeRepo)
    {
        $this->inmuchargeRepository = $inmuchargeRepo;
    }

    /**
     * Display a listing of the inmucharge.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmuchargeRepository->pushCriteria(new RequestCriteria($request));
        $inmucharges = $this->inmuchargeRepository->paginate(10);

        return view('inmucharges.index')
            ->with('inmucharges', $inmucharges);
    }

    /**
     * Show the form for creating a new inmucharge.
     *
     * @return Response
     */
    public function create()
    {
        return view('inmucharges.create');
    }

    /**
     * Store a newly created inmucharge in storage.
     *
     * @param CreateinmuchargeRequest $request
     *
     * @return Response
     */
    public function store(CreateinmuchargeRequest $request)
    {
        $input = $request->all();       

        $inmucharge = $this->inmuchargeRepository->create($input);

        Flash::success('Inmucharge saved successfully.');

        return redirect(route('inmucharges.index'));
    }

    /**
     * Display the specified inmucharge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inmucharge = $this->inmuchargeRepository->findWithoutFail($id);

        if (empty($inmucharge)) {
            Flash::error('Inmucharge not found');

            return redirect(route('inmucharges.index'));
        }

        return view('inmucharges.show')->with('inmucharge', $inmucharge);
    }

    /**
     * Show the form for editing the specified inmucharge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inmucharge = $this->inmuchargeRepository->findWithoutFail($id);

        if (empty($inmucharge)) {
            Flash::error('Inmucharge not found');

            return redirect(route('inmucharges.index'));
        }

        return view('inmucharges.edit')->with('inmucharge', $inmucharge);
    }

    /**
     * Update the specified inmucharge in storage.
     *
     * @param  int              $id
     * @param UpdateinmuchargeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinmuchargeRequest $request)
    {
        $inmucharge = $this->inmuchargeRepository->findWithoutFail($id);

        if (empty($inmucharge)) {
            Flash::error('Inmucharge not found');

            return redirect(route('inmucharges.index'));
        }

        $inmucharge = $this->inmuchargeRepository->update($request->all(), $id);

        Flash::success('Inmucharge updated successfully.');

        return redirect(route('inmucharges.index'));
    }

    /**
     * Remove the specified inmucharge from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inmucharge = $this->inmuchargeRepository->findWithoutFail($id);

        if (empty($inmucharge)) {
            Flash::error('Inmucharge not found');

            return redirect(route('inmucharges.index'));
        }

        $this->inmuchargeRepository->delete($id);

        Flash::success('Inmucharge deleted successfully.');

        return redirect(route('inmucharges.index'));
    }
}
