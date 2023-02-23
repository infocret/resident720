<?php

namespace App\Http\Controllers;

use App\DataTables\statusticketDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatestatusticketRequest;
use App\Http\Requests\UpdatestatusticketRequest;
use App\Repositories\statusticketRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class statusticketController extends AppBaseController
{
    /** @var  statusticketRepository */
    private $statusticketRepository;

    public function __construct(statusticketRepository $statusticketRepo)
    {
        $this->statusticketRepository = $statusticketRepo;
    }

    /**
     * Display a listing of the statusticket.
     *
     * @param statusticketDataTable $statusticketDataTable
     * @return Response
     */
    public function index(statusticketDataTable $statusticketDataTable)
    {
        return $statusticketDataTable->render('statustickets.index');
    }

    /**
     * Show the form for creating a new statusticket.
     *
     * @return Response
     */
    public function create()
    {
        return view('statustickets.create');
    }

    /**
     * Store a newly created statusticket in storage.
     *
     * @param CreatestatusticketRequest $request
     *
     * @return Response
     */
    public function store(CreatestatusticketRequest $request)
    {
        $input = $request->all();

        $statusticket = $this->statusticketRepository->create($input);

        Flash::success('Statusticket saved successfully.');

        return redirect(route('statustickets.index'));
    }

    /**
     * Display the specified statusticket.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $statusticket = $this->statusticketRepository->findWithoutFail($id);

        if (empty($statusticket)) {
            Flash::error('Statusticket not found');

            return redirect(route('statustickets.index'));
        }

        return view('statustickets.show')->with('statusticket', $statusticket);
    }

    /**
     * Show the form for editing the specified statusticket.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $statusticket = $this->statusticketRepository->findWithoutFail($id);

        if (empty($statusticket)) {
            Flash::error('Statusticket not found');

            return redirect(route('statustickets.index'));
        }

        return view('statustickets.edit')->with('statusticket', $statusticket);
    }

    /**
     * Update the specified statusticket in storage.
     *
     * @param  int              $id
     * @param UpdatestatusticketRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatusticketRequest $request)
    {
        $statusticket = $this->statusticketRepository->findWithoutFail($id);

        if (empty($statusticket)) {
            Flash::error('Statusticket not found');

            return redirect(route('statustickets.index'));
        }

        $statusticket = $this->statusticketRepository->update($request->all(), $id);

        Flash::success('Statusticket updated successfully.');

        return redirect(route('statustickets.index'));
    }

    /**
     * Remove the specified statusticket from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $statusticket = $this->statusticketRepository->findWithoutFail($id);

        if (empty($statusticket)) {
            Flash::error('Statusticket not found');

            return redirect(route('statustickets.index'));
        }

        $this->statusticketRepository->delete($id);

        Flash::success('Statusticket deleted successfully.');

        return redirect(route('statustickets.index'));
    }
}
