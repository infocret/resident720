<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateconceptserviceRequest;
use App\Http\Requests\UpdateconceptserviceRequest;
use App\Repositories\conceptserviceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class conceptserviceController extends AppBaseController
{
    /** @var  conceptserviceRepository */
    private $conceptserviceRepository;

    public function __construct(conceptserviceRepository $conceptserviceRepo)
    {
        $this->conceptserviceRepository = $conceptserviceRepo;
    }

    /**
     * Display a listing of the conceptservice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->conceptserviceRepository->pushCriteria(new RequestCriteria($request));
        $conceptservices = $this->conceptserviceRepository->paginate(10);

        return view('conceptservices.index')
            ->with('conceptservices', $conceptservices);
    }

    /**
     * Show the form for creating a new conceptservice.
     *
     * @return Response
     */
    public function create()
    {
        return view('conceptservices.create');
    }

    /**
     * Store a newly created conceptservice in storage.
     *
     * @param CreateconceptserviceRequest $request
     *
     * @return Response
     */
    public function store(CreateconceptserviceRequest $request)
    {
        $input = $request->all();

        $conceptservice = $this->conceptserviceRepository->create($input);

        Flash::success('Conceptservice saved successfully.');

        return redirect(route('conceptservices.index'));
    }

    /**
     * Display the specified conceptservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $conceptservice = $this->conceptserviceRepository->findWithoutFail($id);

        if (empty($conceptservice)) {
            Flash::error('Conceptservice not found');

            return redirect(route('conceptservices.index'));
        }

        return view('conceptservices.show')->with('conceptservice', $conceptservice);
    }

    /**
     * Show the form for editing the specified conceptservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $conceptservice = $this->conceptserviceRepository->findWithoutFail($id);

        if (empty($conceptservice)) {
            Flash::error('Conceptservice not found');

            return redirect(route('conceptservices.index'));
        }

        return view('conceptservices.edit')->with('conceptservice', $conceptservice);
    }

    /**
     * Update the specified conceptservice in storage.
     *
     * @param  int              $id
     * @param UpdateconceptserviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateconceptserviceRequest $request)
    {
        $conceptservice = $this->conceptserviceRepository->findWithoutFail($id);

        if (empty($conceptservice)) {
            Flash::error('Conceptservice not found');

            return redirect(route('conceptservices.index'));
        }

        $conceptservice = $this->conceptserviceRepository->update($request->all(), $id);

        Flash::success('Conceptservice updated successfully.');

        return redirect(route('conceptservices.index'));
    }

    /**
     * Remove the specified conceptservice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $conceptservice = $this->conceptserviceRepository->findWithoutFail($id);

        if (empty($conceptservice)) {
            Flash::error('Conceptservice not found');

            return redirect(route('conceptservices.index'));
        }

        $this->conceptserviceRepository->delete($id);

        Flash::success('Conceptservice deleted successfully.');

        return redirect(route('conceptservices.index'));
    }
}
