<?php

namespace App\Http\Controllers;

use App\DataTables\movdetailapplieDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemovdetailapplieRequest;
use App\Http\Requests\UpdatemovdetailapplieRequest;
use App\Repositories\movdetailapplieRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class movdetailapplieController extends AppBaseController
{
    /** @var  movdetailapplieRepository */
    private $movdetailapplieRepository;

    public function __construct(movdetailapplieRepository $movdetailapplieRepo)
    {
        $this->movdetailapplieRepository = $movdetailapplieRepo;
    }

    /**
     * Display a listing of the movdetailapplie.
     *
     * @param movdetailapplieDataTable $movdetailapplieDataTable
     * @return Response
     */
    public function index(movdetailapplieDataTable $movdetailapplieDataTable)
    {
        return $movdetailapplieDataTable->render('movdetailapplies.index');
    }

    /**
     * Show the form for creating a new movdetailapplie.
     *
     * @return Response
     */
    public function create()
    {
        return view('movdetailapplies.create');
    }

    /**
     * Store a newly created movdetailapplie in storage.
     *
     * @param CreatemovdetailapplieRequest $request
     *
     * @return Response
     */
    public function store(CreatemovdetailapplieRequest $request)
    {
        $input = $request->all();

        $movdetailapplie = $this->movdetailapplieRepository->create($input);

        Flash::success('Movdetailapplie saved successfully.');

        return redirect(route('movdetailapplies.index'));
    }

    /**
     * Display the specified movdetailapplie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $movdetailapplie = $this->movdetailapplieRepository->findWithoutFail($id);

        if (empty($movdetailapplie)) {
            Flash::error('Movdetailapplie not found');

            return redirect(route('movdetailapplies.index'));
        }

        return view('movdetailapplies.show')->with('movdetailapplie', $movdetailapplie);
    }

    /**
     * Show the form for editing the specified movdetailapplie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $movdetailapplie = $this->movdetailapplieRepository->findWithoutFail($id);

        if (empty($movdetailapplie)) {
            Flash::error('Movdetailapplie not found');

            return redirect(route('movdetailapplies.index'));
        }

        return view('movdetailapplies.edit')->with('movdetailapplie', $movdetailapplie);
    }

    /**
     * Update the specified movdetailapplie in storage.
     *
     * @param  int              $id
     * @param UpdatemovdetailapplieRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovdetailapplieRequest $request)
    {
        $movdetailapplie = $this->movdetailapplieRepository->findWithoutFail($id);

        if (empty($movdetailapplie)) {
            Flash::error('Movdetailapplie not found');

            return redirect(route('movdetailapplies.index'));
        }

        $movdetailapplie = $this->movdetailapplieRepository->update($request->all(), $id);

        Flash::success('Movdetailapplie updated successfully.');

        return redirect(route('movdetailapplies.index'));
    }

    /**
     * Remove the specified movdetailapplie from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $movdetailapplie = $this->movdetailapplieRepository->findWithoutFail($id);

        if (empty($movdetailapplie)) {
            Flash::error('Movdetailapplie not found');

            return redirect(route('movdetailapplies.index'));
        }

        $this->movdetailapplieRepository->delete($id);

        Flash::success('Movdetailapplie deleted successfully.');

        return redirect(route('movdetailapplies.index'));
    }
}
