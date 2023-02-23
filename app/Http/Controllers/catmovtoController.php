<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecatmovtoRequest;
use App\Http\Requests\UpdatecatmovtoRequest;
use App\Repositories\catmovtoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class catmovtoController extends AppBaseController
{
    /** @var  catmovtoRepository */
    private $catmovtoRepository;

    public function __construct(catmovtoRepository $catmovtoRepo)
    {
        $this->catmovtoRepository = $catmovtoRepo;
    }

    /**
     * Display a listing of the catmovto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->catmovtoRepository->pushCriteria(new RequestCriteria($request));
        $catmovtos = $this->catmovtoRepository->paginate(10);

        return view('catmovtos.index')
            ->with('catmovtos', $catmovtos);
    }

    /**
     * Show the form for creating a new catmovto.
     *
     * @return Response
     */
    public function create()
    {
        return view('catmovtos.create');
    }

    /**
     * Store a newly created catmovto in storage.
     *
     * @param CreatecatmovtoRequest $request
     *
     * @return Response
     */
    public function store(CreatecatmovtoRequest $request)
    {
        $input = $request->all();

        $catmovto = $this->catmovtoRepository->create($input);

        Flash::success('Catmovto saved successfully.');

        return redirect(route('catmovtos.index'));
    }

    /**
     * Display the specified catmovto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $catmovto = $this->catmovtoRepository->findWithoutFail($id);

        if (empty($catmovto)) {
            Flash::error('Catmovto not found');

            return redirect(route('catmovtos.index'));
        }

        return view('catmovtos.show')->with('catmovto', $catmovto);
    }

    /**
     * Show the form for editing the specified catmovto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $catmovto = $this->catmovtoRepository->findWithoutFail($id);

        if (empty($catmovto)) {
            Flash::error('Catmovto not found');

            return redirect(route('catmovtos.index'));
        }

        return view('catmovtos.edit')->with('catmovto', $catmovto);
    }

    /**
     * Update the specified catmovto in storage.
     *
     * @param  int              $id
     * @param UpdatecatmovtoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecatmovtoRequest $request)
    {
        $catmovto = $this->catmovtoRepository->findWithoutFail($id);

        if (empty($catmovto)) {
            Flash::error('Catmovto not found');

            return redirect(route('catmovtos.index'));
        }

        $catmovto = $this->catmovtoRepository->update($request->all(), $id);

        Flash::success('Catmovto updated successfully.');

        return redirect(route('catmovtos.index'));
    }

    /**
     * Remove the specified catmovto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $catmovto = $this->catmovtoRepository->findWithoutFail($id);

        if (empty($catmovto)) {
            Flash::error('Catmovto not found');

            return redirect(route('catmovtos.index'));
        }

        $this->catmovtoRepository->delete($id);

        Flash::success('Catmovto deleted successfully.');

        return redirect(route('catmovtos.index'));
    }
}
