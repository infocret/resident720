<?php

namespace App\Http\Controllers;

use App\DataTables\statusticketimgDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatestatusticketimgRequest;
use App\Http\Requests\UpdatestatusticketimgRequest;
use App\Repositories\statusticketimgRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class statusticketimgController extends AppBaseController
{
    /** @var  statusticketimgRepository */
    private $statusticketimgRepository;

    public function __construct(statusticketimgRepository $statusticketimgRepo)
    {
        $this->statusticketimgRepository = $statusticketimgRepo;
    }

    /**
     * Display a listing of the statusticketimg.
     *
     * @param statusticketimgDataTable $statusticketimgDataTable
     * @return Response
     */
    public function index(statusticketimgDataTable $statusticketimgDataTable)
    {
        return $statusticketimgDataTable->render('statusticketimgs.index');
    }

    /**
     * Show the form for creating a new statusticketimg.
     *
     * @return Response
     */
    public function create()
    {
        return view('statusticketimgs.create');
    }

    /**
     * Store a newly created statusticketimg in storage.
     *
     * @param CreatestatusticketimgRequest $request
     *
     * @return Response
     */
    public function store(CreatestatusticketimgRequest $request)
    {
        $input = $request->all();

        $statusticketimg = $this->statusticketimgRepository->create($input);

        Flash::success('Statusticketimg saved successfully.');

        return redirect(route('statusticketimgs.index'));
    }

    /**
     * Display the specified statusticketimg.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $statusticketimg = $this->statusticketimgRepository->findWithoutFail($id);

        if (empty($statusticketimg)) {
            Flash::error('Statusticketimg not found');

            return redirect(route('statusticketimgs.index'));
        }

        return view('statusticketimgs.show')->with('statusticketimg', $statusticketimg);
    }

    /**
     * Show the form for editing the specified statusticketimg.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $statusticketimg = $this->statusticketimgRepository->findWithoutFail($id);

        if (empty($statusticketimg)) {
            Flash::error('Statusticketimg not found');

            return redirect(route('statusticketimgs.index'));
        }

        return view('statusticketimgs.edit')->with('statusticketimg', $statusticketimg);
    }

    /**
     * Update the specified statusticketimg in storage.
     *
     * @param  int              $id
     * @param UpdatestatusticketimgRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatusticketimgRequest $request)
    {
        $statusticketimg = $this->statusticketimgRepository->findWithoutFail($id);

        if (empty($statusticketimg)) {
            Flash::error('Statusticketimg not found');

            return redirect(route('statusticketimgs.index'));
        }

        $statusticketimg = $this->statusticketimgRepository->update($request->all(), $id);

        Flash::success('Statusticketimg updated successfully.');

        return redirect(route('statusticketimgs.index'));
    }

    /**
     * Remove the specified statusticketimg from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $statusticketimg = $this->statusticketimgRepository->findWithoutFail($id);

        if (empty($statusticketimg)) {
            Flash::error('Statusticketimg not found');

            return redirect(route('statusticketimgs.index'));
        }

        $this->statusticketimgRepository->delete($id);

        Flash::success('Statusticketimg deleted successfully.');

        return redirect(route('statusticketimgs.index'));
    }
}
