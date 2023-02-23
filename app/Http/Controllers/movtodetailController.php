<?php

namespace App\Http\Controllers;

use App\DataTables\movtodetailDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemovtodetailRequest;
use App\Http\Requests\UpdatemovtodetailRequest;
use App\Repositories\movtodetailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class movtodetailController extends AppBaseController
{
    /** @var  movtodetailRepository */
    private $movtodetailRepository;

    public function __construct(movtodetailRepository $movtodetailRepo)
    {
        $this->movtodetailRepository = $movtodetailRepo;
    }

    /**
     * Display a listing of the movtodetail.
     *
     * @param movtodetailDataTable $movtodetailDataTable
     * @return Response
     */
    public function index(movtodetailDataTable $movtodetailDataTable)
    {
        return $movtodetailDataTable->render('movtodetails.index');
    }

    /**
     * Show the form for creating a new movtodetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('movtodetails.create');
    }

    /**
     * Store a newly created movtodetail in storage.
     *
     * @param CreatemovtodetailRequest $request
     *
     * @return Response
     */
    public function store(CreatemovtodetailRequest $request)
    {
        $input = $request->all();

        $movtodetail = $this->movtodetailRepository->create($input);

        Flash::success('Movtodetail saved successfully.');

        return redirect(route('movtodetails.index'));
    }

    /**
     * Display the specified movtodetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $movtodetail = $this->movtodetailRepository->findWithoutFail($id);

        if (empty($movtodetail)) {
            Flash::error('Movtodetail not found');

            return redirect(route('movtodetails.index'));
        }

        return view('movtodetails.show')->with('movtodetail', $movtodetail);
    }

    /**
     * Show the form for editing the specified movtodetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $movtodetail = $this->movtodetailRepository->findWithoutFail($id);

        if (empty($movtodetail)) {
            Flash::error('Movtodetail not found');

            return redirect(route('movtodetails.index'));
        }

        return view('movtodetails.edit')->with('movtodetail', $movtodetail);
    }

    /**
     * Update the specified movtodetail in storage.
     *
     * @param  int              $id
     * @param UpdatemovtodetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovtodetailRequest $request)
    {
        $movtodetail = $this->movtodetailRepository->findWithoutFail($id);

        if (empty($movtodetail)) {
            Flash::error('Movtodetail not found');

            return redirect(route('movtodetails.index'));
        }

        $movtodetail = $this->movtodetailRepository->update($request->all(), $id);

        Flash::success('Movtodetail updated successfully.');

        return redirect(route('movtodetails.index'));
    }

    /**
     * Remove the specified movtodetail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $movtodetail = $this->movtodetailRepository->findWithoutFail($id);

        if (empty($movtodetail)) {
            Flash::error('Movtodetail not found');

            return redirect(route('movtodetails.index'));
        }

        $this->movtodetailRepository->delete($id);

        Flash::success('Movtodetail deleted successfully.');

        return redirect(route('movtodetails.index'));
    }
}
