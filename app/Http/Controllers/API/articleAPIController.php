<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatearticleAPIRequest;
use App\Http\Requests\API\UpdatearticleAPIRequest;
use App\Models\article;
use App\Repositories\articleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class articleController
 * @package App\Http\Controllers\API
 */

class articleAPIController extends AppBaseController
{
    /** @var  articleRepository */
    private $articleRepository;

    public function __construct(articleRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    /**
     * Display a listing of the article.
     * GET|HEAD /articles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->articleRepository->pushCriteria(new RequestCriteria($request));
        $this->articleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $articles = $this->articleRepository->all();

        return $this->sendResponse($articles->toArray(), 'Articles retrieved successfully');
    }

    /**
     * Store a newly created article in storage.
     * POST /articles
     *
     * @param CreatearticleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatearticleAPIRequest $request)
    {
        $input = $request->all();

        $articles = $this->articleRepository->create($input);

        return $this->sendResponse($articles->toArray(), 'Article saved successfully');
    }

    /**
     * Display the specified article.
     * GET|HEAD /articles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var article $article */
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            return $this->sendError('Article not found');
        }

        return $this->sendResponse($article->toArray(), 'Article retrieved successfully');
    }

    /**
     * Update the specified article in storage.
     * PUT/PATCH /articles/{id}
     *
     * @param  int $id
     * @param UpdatearticleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatearticleAPIRequest $request)
    {
        $input = $request->all();

        /** @var article $article */
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            return $this->sendError('Article not found');
        }

        $article = $this->articleRepository->update($input, $id);

        return $this->sendResponse($article->toArray(), 'article updated successfully');
    }

    /**
     * Remove the specified article from storage.
     * DELETE /articles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var article $article */
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            return $this->sendError('Article not found');
        }

        $article->delete();

        return $this->sendResponse($id, 'Article deleted successfully');
    }
}
