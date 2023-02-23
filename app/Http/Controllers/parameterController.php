<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateparameterRequest;
use App\Http\Requests\UpdateparameterRequest;
use App\Repositories\parameterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class parameterController extends AppBaseController
{
    /** @var  parameterRepository */
    private $parameterRepository;

    public function __construct(parameterRepository $parameterRepo)
    {
        $this->parameterRepository = $parameterRepo;
    }

    /**
     * Display a listing of the parameter.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->parameterRepository->pushCriteria(new RequestCriteria($request));
        $parameters = $this->parameterRepository->all(); //paginate(10);

        return view('parameters.index')
            ->with('parameters', $parameters);
    }

    /**
     * Show the form for creating a new parameter.
     *
     * @return Response
     */
    public function create()
    {
        return view('parameters.create');
    }

    /**
     * Store a newly created parameter in storage.
     *
     * @param CreateparameterRequest $request
     *
     * @return Response
     */
    public function store(CreateparameterRequest $request)
    {
        $input = $request->all();

        $parameter = $this->parameterRepository->create($input);

        Flash::success('Parameter saved successfully.');

        return redirect(route('parameters.index'));
    }

    /**
     * Display the specified parameter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $parameter = $this->parameterRepository->findWithoutFail($id);

        if (empty($parameter)) {
            Flash::error('Parameter not found');

            return redirect(route('parameters.index'));
        }

        return view('parameters.show')->with('parameter', $parameter);
    }

    /**
     * Show the form for editing the specified parameter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $parameter = $this->parameterRepository->findWithoutFail($id);

        if (empty($parameter)) {
            Flash::error('Parameter not found');

            return redirect(route('parameters.index'));
        }

        return view('parameters.edit')->with('parameter', $parameter);
    }

    /**
     * Update the specified parameter in storage.
     *
     * @param  int              $id
     * @param UpdateparameterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateparameterRequest $request)
    {
        $parameter = $this->parameterRepository->findWithoutFail($id);

        if (empty($parameter)) {
            Flash::error('Parameter not found');

            return redirect(route('parameters.index'));
        }

        $parameter = $this->parameterRepository->update($request->all(), $id);

        Flash::success('Parameter updated successfully.');

        return redirect(route('parameters.index'));
    }

    /**
     * Remove the specified parameter from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $parameter = $this->parameterRepository->findWithoutFail($id);

        if (empty($parameter)) {
            Flash::error('Parameter not found');

            return redirect(route('parameters.index'));
        }

        $this->parameterRepository->delete($id);

        Flash::success('Parameter deleted successfully.');

        return redirect(route('parameters.index'));
    }
}
