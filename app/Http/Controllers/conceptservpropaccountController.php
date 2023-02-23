<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateconceptservpropaccountRequest;
use App\Http\Requests\UpdateconceptservpropaccountRequest;
use App\Repositories\conceptservpropaccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class conceptservpropaccountController extends AppBaseController
{
    /** @var  conceptservpropaccountRepository */
    private $conceptservpropaccountRepository;

    public function __construct(conceptservpropaccountRepository $conceptservpropaccountRepo)
    {
        $this->conceptservpropaccountRepository = $conceptservpropaccountRepo;
    }

    /**
     * Display a listing of the conceptservpropaccount.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->conceptservpropaccountRepository->pushCriteria(new RequestCriteria($request));
        $conceptservpropaccounts = $this->conceptservpropaccountRepository->all();

        return view('conceptservpropaccounts.index')
            ->with('conceptservpropaccounts', $conceptservpropaccounts);
    }

    /**
     * Show the form for creating a new conceptservpropaccount.
     *
     * @return Response
     */
    public function create()
    {
        return view('conceptservpropaccounts.create');
    }

    /**
     * Store a newly created conceptservpropaccount in storage.
     *
     * @param CreateconceptservpropaccountRequest $request
     *
     * @return Response
     */
    public function store(CreateconceptservpropaccountRequest $request)
    {
        $input = $request->all();

        $conceptservpropaccount = $this->conceptservpropaccountRepository->create($input);

        Flash::success('Conceptservpropaccount saved successfully.');

        return redirect(route('conceptservpropaccounts.index'));
    }

    /**
     * Display the specified conceptservpropaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $conceptservpropaccount = $this->conceptservpropaccountRepository->findWithoutFail($id);

        if (empty($conceptservpropaccount)) {
            Flash::error('Conceptservpropaccount not found');

            return redirect(route('conceptservpropaccounts.index'));
        }

        return view('conceptservpropaccounts.show')->with('conceptservpropaccount', $conceptservpropaccount);
    }

    /**
     * Show the form for editing the specified conceptservpropaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $conceptservpropaccount = $this->conceptservpropaccountRepository->findWithoutFail($id);

        if (empty($conceptservpropaccount)) {
            Flash::error('Conceptservpropaccount not found');

            return redirect(route('conceptservpropaccounts.index'));
        }

        return view('conceptservpropaccounts.edit')->with('conceptservpropaccount', $conceptservpropaccount);
    }

    /**
     * Update the specified conceptservpropaccount in storage.
     *
     * @param  int              $id
     * @param UpdateconceptservpropaccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateconceptservpropaccountRequest $request)
    {
        $conceptservpropaccount = $this->conceptservpropaccountRepository->findWithoutFail($id);

        if (empty($conceptservpropaccount)) {
            Flash::error('Conceptservpropaccount not found');

            return redirect(route('conceptservpropaccounts.index'));
        }

        $conceptservpropaccount = $this->conceptservpropaccountRepository->update($request->all(), $id);

        Flash::success('Conceptservpropaccount updated successfully.');

        return redirect(route('conceptservpropaccounts.index'));
    }

    /**
     * Remove the specified conceptservpropaccount from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $conceptservpropaccount = $this->conceptservpropaccountRepository->findWithoutFail($id);

        if (empty($conceptservpropaccount)) {
            Flash::error('Conceptservpropaccount not found');

            return redirect(route('conceptservpropaccounts.index'));
        }

        $this->conceptservpropaccountRepository->delete($id);

        Flash::success('Conceptservpropaccount deleted successfully.');

        return redirect(route('conceptservpropaccounts.index'));
    }
}
