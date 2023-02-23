<?php

namespace App\Http\Controllers;

use App\DataTables\articlescategorieDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatearticlescategorieRequest;
use App\Http\Requests\UpdatearticlescategorieRequest;
use App\Repositories\articlescategorieRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class articlescategorieController extends AppBaseController
{
    /** @var  articlescategorieRepository */
    private $articlescategorieRepository;

    public function __construct(articlescategorieRepository $articlescategorieRepo)
    {
        $this->articlescategorieRepository = $articlescategorieRepo;
    }

    /**
     * Display a listing of the articlescategorie.
     *
     * @param articlescategorieDataTable $articlescategorieDataTable
     * @return Response
     */
    public function index(articlescategorieDataTable $articlescategorieDataTable)
    {
        return $articlescategorieDataTable->render('articlescategories.index');
    }

    /**
     * Show the form for creating a new articlescategorie.
     *
     * @return Response
     */
    public function create()
    {
        return view('articlescategories.create');
    }

    /**
     * Store a newly created articlescategorie in storage.
     *
     * @param CreatearticlescategorieRequest $request
     *
     * @return Response
     */
    public function store(CreatearticlescategorieRequest $request)
    {
        $input = $request->all();

        $articlescategorie = $this->articlescategorieRepository->create($input);

        Flash::success('Articlescategorie saved successfully.');

        return redirect(route('articlescategories.index'));
    }

    /**
     * Display the specified articlescategorie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $articlescategorie = $this->articlescategorieRepository->findWithoutFail($id);

        if (empty($articlescategorie)) {
            Flash::error('Articlescategorie not found');

            return redirect(route('articlescategories.index'));
        }

        return view('articlescategories.show')->with('articlescategorie', $articlescategorie);
    }

    /**
     * Show the form for editing the specified articlescategorie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $articlescategorie = $this->articlescategorieRepository->findWithoutFail($id);

        if (empty($articlescategorie)) {
            Flash::error('Articlescategorie not found');

            return redirect(route('articlescategories.index'));
        }

        return view('articlescategories.edit')->with('articlescategorie', $articlescategorie);
    }

    /**
     * Update the specified articlescategorie in storage.
     *
     * @param  int              $id
     * @param UpdatearticlescategorieRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatearticlescategorieRequest $request)
    {
        $articlescategorie = $this->articlescategorieRepository->findWithoutFail($id);

        if (empty($articlescategorie)) {
            Flash::error('Articlescategorie not found');

            return redirect(route('articlescategories.index'));
        }

        $articlescategorie = $this->articlescategorieRepository->update($request->all(), $id);

        Flash::success('Articlescategorie updated successfully.');

        return redirect(route('articlescategories.index'));
    }

    /**
     * Remove the specified articlescategorie from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $articlescategorie = $this->articlescategorieRepository->findWithoutFail($id);

        if (empty($articlescategorie)) {
            Flash::error('Articlescategorie not found');

            return redirect(route('articlescategories.index'));
        }

        $this->articlescategorieRepository->delete($id);

        Flash::success('Articlescategorie deleted successfully.');

        return redirect(route('articlescategories.index'));
    }
}
