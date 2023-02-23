<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateanticiposapliRequest;
use App\Http\Requests\UpdateanticiposapliRequest;
use App\Repositories\anticiposapliRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class anticiposapliController extends AppBaseController
{
    /** @var  anticiposapliRepository */
    private $anticiposapliRepository;

    public function __construct(anticiposapliRepository $anticiposapliRepo)
    {
        $this->anticiposapliRepository = $anticiposapliRepo;
    }

    /**
     * Display a listing of the anticiposapli.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->anticiposapliRepository->pushCriteria(new RequestCriteria($request));
        $anticiposaplis = $this->anticiposapliRepository->paginate(10);

        return view('anticiposaplis.index')
            ->with('anticiposaplis', $anticiposaplis);
    }

    /**
     * Show the form for creating a new anticiposapli.
     *
     * @return Response
     */
    public function create()
    {
        return view('anticiposaplis.create');
    }

    /**
     * Store a newly created anticiposapli in storage.
     *
     * @param CreateanticiposapliRequest $request
     *
     * @return Response
     */
    public function store(CreateanticiposapliRequest $request)
    {
        $input = $request->all();

        $anticiposapli = $this->anticiposapliRepository->create($input);

        Flash::success('Anticiposapli saved successfully.');

        return redirect(route('anticiposaplis.index'));
    }

    /**
     * Display the specified anticiposapli.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $anticiposapli = $this->anticiposapliRepository->findWithoutFail($id);

        if (empty($anticiposapli)) {
            Flash::error('Anticiposapli not found');

            return redirect(route('anticiposaplis.index'));
        }

        return view('anticiposaplis.show')->with('anticiposapli', $anticiposapli);
    }

    /**
     * Show the form for editing the specified anticiposapli.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $anticiposapli = $this->anticiposapliRepository->findWithoutFail($id);

        if (empty($anticiposapli)) {
            Flash::error('Anticiposapli not found');

            return redirect(route('anticiposaplis.index'));
        }

        return view('anticiposaplis.edit')->with('anticiposapli', $anticiposapli);
    }

    /**
     * Update the specified anticiposapli in storage.
     *
     * @param  int              $id
     * @param UpdateanticiposapliRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateanticiposapliRequest $request)
    {
        $anticiposapli = $this->anticiposapliRepository->findWithoutFail($id);

        if (empty($anticiposapli)) {
            Flash::error('Anticiposapli not found');

            return redirect(route('anticiposaplis.index'));
        }

        $anticiposapli = $this->anticiposapliRepository->update($request->all(), $id);

        Flash::success('Anticiposapli updated successfully.');

        return redirect(route('anticiposaplis.index'));
    }

    /**
     * Remove the specified anticiposapli from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $anticiposapli = $this->anticiposapliRepository->findWithoutFail($id);

        if (empty($anticiposapli)) {
            Flash::error('Anticiposapli not found');

            return redirect(route('anticiposaplis.index'));
        }

        $this->anticiposapliRepository->delete($id);

        Flash::success('Anticiposapli deleted successfully.');

        return redirect(route('anticiposaplis.index'));
    }
}
