<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatearticlescategorieAPIRequest;
use App\Http\Requests\API\UpdatearticlescategorieAPIRequest;
use App\Models\articlescategorie;
use App\Repositories\articlescategorieRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class articlescategorieController
 * @package App\Http\Controllers\API
 */

class articlescategorieAPIController extends AppBaseController
{
    /** @var  articlescategorieRepository */
    private $articlescategorieRepository;

    public function __construct(articlescategorieRepository $articlescategorieRepo)
    {
        $this->articlescategorieRepository = $articlescategorieRepo;
    }

    /**
     * Display a listing of the articlescategorie.
     * GET|HEAD /articlescategories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->articlescategorieRepository->pushCriteria(new RequestCriteria($request));
        $this->articlescategorieRepository->pushCriteria(new LimitOffsetCriteria($request));
        $articlescategories = $this->articlescategorieRepository->all();

        return $this->sendResponse($articlescategories->toArray(), 'Articlescategories retrieved successfully');
    }

    /**
     * Store a newly created articlescategorie in storage.
     * POST /articlescategories
     *
     * @param CreatearticlescategorieAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatearticlescategorieAPIRequest $request)
    {
        $input = $request->all();

        $articlescategories = $this->articlescategorieRepository->create($input);

        return $this->sendResponse($articlescategories->toArray(), 'Articlescategorie saved successfully');
    }

    /**
     * Display the specified articlescategorie.
     * GET|HEAD /articlescategories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var articlescategorie $articlescategorie */
        $articlescategorie = $this->articlescategorieRepository->findWithoutFail($id);

        if (empty($articlescategorie)) {
            return $this->sendError('Articlescategorie not found');
        }

        return $this->sendResponse($articlescategorie->toArray(), 'Articlescategorie retrieved successfully');
    }

    /**
     * Update the specified articlescategorie in storage.
     * PUT/PATCH /articlescategories/{id}
     *
     * @param  int $id
     * @param UpdatearticlescategorieAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatearticlescategorieAPIRequest $request)
    {
        $input = $request->all();

        /** @var articlescategorie $articlescategorie */
        $articlescategorie = $this->articlescategorieRepository->findWithoutFail($id);

        if (empty($articlescategorie)) {
            return $this->sendError('Articlescategorie not found');
        }

        $articlescategorie = $this->articlescategorieRepository->update($input, $id);

        return $this->sendResponse($articlescategorie->toArray(), 'articlescategorie updated successfully');
    }

    /**
     * Remove the specified articlescategorie from storage.
     * DELETE /articlescategories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var articlescategorie $articlescategorie */
        $articlescategorie = $this->articlescategorieRepository->findWithoutFail($id);

        if (empty($articlescategorie)) {
            return $this->sendError('Articlescategorie not found');
        }

        $articlescategorie->delete();

        return $this->sendResponse($id, 'Articlescategorie deleted successfully');
    }
}
