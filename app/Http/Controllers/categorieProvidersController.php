<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecategorieProvidersRequest;
use App\Http\Requests\UpdatecategorieProvidersRequest;
use App\Repositories\categorieProvidersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class categorieProvidersController extends AppBaseController
{
    /** @var  categorieProvidersRepository */
    private $categorieProvidersRepository;

    public function __construct(categorieProvidersRepository $categorieProvidersRepo)
    {
        $this->categorieProvidersRepository = $categorieProvidersRepo;
    }

    /**
     * Display a listing of the categorieProviders.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categorieProvidersRepository->pushCriteria(new RequestCriteria($request));
        $categorieProviders = $this->categorieProvidersRepository->all();

        return view('categorie_providers.index')
            ->with('categorieProviders', $categorieProviders);
    }

    /**
     * Show the form for creating a new categorieProviders.
     *
     * @return Response
     */
    public function create()
    {
        return view('categorie_providers.create');
    }

    /**
     * Store a newly created categorieProviders in storage.
     *
     * @param CreatecategorieProvidersRequest $request
     *
     * @return Response
     */
    public function store(CreatecategorieProvidersRequest $request)
    {
        $input = $request->all();

        $categorieProviders = $this->categorieProvidersRepository->create($input);

        Flash::success('Categorie Providers saved successfully.');

        return redirect(route('categorieProviders.index'));
    }

    /**
     * Display the specified categorieProviders.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categorieProviders = $this->categorieProvidersRepository->findWithoutFail($id);

        if (empty($categorieProviders)) {
            Flash::error('Categorie Providers not found');

            return redirect(route('categorieProviders.index'));
        }

        return view('categorie_providers.show')->with('categorieProviders', $categorieProviders);
    }

    /**
     * Show the form for editing the specified categorieProviders.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categorieProviders = $this->categorieProvidersRepository->findWithoutFail($id);

        if (empty($categorieProviders)) {
            Flash::error('Categorie Providers not found');

            return redirect(route('categorieProviders.index'));
        }

        return view('categorie_providers.edit')->with('categorieProviders', $categorieProviders);
    }

    /**
     * Update the specified categorieProviders in storage.
     *
     * @param  int              $id
     * @param UpdatecategorieProvidersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecategorieProvidersRequest $request)
    {
        $categorieProviders = $this->categorieProvidersRepository->findWithoutFail($id);

        if (empty($categorieProviders)) {
            Flash::error('Categorie Providers not found');

            return redirect(route('categorieProviders.index'));
        }

        $categorieProviders = $this->categorieProvidersRepository->update($request->all(), $id);

        Flash::success('Categorie Providers updated successfully.');

        return redirect(route('categorieProviders.index'));
    }

    /**
     * Remove the specified categorieProviders from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categorieProviders = $this->categorieProvidersRepository->findWithoutFail($id);

        if (empty($categorieProviders)) {
            Flash::error('Categorie Providers not found');

            return redirect(route('categorieProviders.index'));
        }

        $this->categorieProvidersRepository->delete($id);

        Flash::success('Categorie Providers deleted successfully.');

        return redirect(route('categorieProviders.index'));
    }
}
