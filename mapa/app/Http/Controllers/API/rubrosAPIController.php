<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreaterubrosAPIRequest;
use App\Http\Requests\API\UpdaterubrosAPIRequest;
use App\Models\rubros;
use App\Repositories\rubrosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class rubrosController
 * @package App\Http\Controllers\API
 */

class rubrosAPIController extends AppBaseController
{
    /** @var  rubrosRepository */
    private $rubrosRepository;

    public function __construct(rubrosRepository $rubrosRepo)
    {
        $this->rubrosRepository = $rubrosRepo;
    }

    /**
     * Display a listing of the rubros.
     * GET|HEAD /rubros
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rubrosRepository->pushCriteria(new RequestCriteria($request));
        $this->rubrosRepository->pushCriteria(new LimitOffsetCriteria($request));
        $rubros = $this->rubrosRepository->all();

        return $this->sendResponse($rubros->toArray(), 'Rubros retrieved successfully');
    }

    /**
     * Store a newly created rubros in storage.
     * POST /rubros
     *
     * @param CreaterubrosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreaterubrosAPIRequest $request)
    {
        $input = $request->all();

        $rubros = $this->rubrosRepository->create($input);

        return $this->sendResponse($rubros->toArray(), 'Rubros saved successfully');
    }

    /**
     * Display the specified rubros.
     * GET|HEAD /rubros/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var rubros $rubros */
        $rubros = $this->rubrosRepository->findWithoutFail($id);

        if (empty($rubros)) {
            return $this->sendError('Rubros not found');
        }

        return $this->sendResponse($rubros->toArray(), 'Rubros retrieved successfully');
    }

    /**
     * Update the specified rubros in storage.
     * PUT/PATCH /rubros/{id}
     *
     * @param  int $id
     * @param UpdaterubrosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterubrosAPIRequest $request)
    {
        $input = $request->all();

        /** @var rubros $rubros */
        $rubros = $this->rubrosRepository->findWithoutFail($id);

        if (empty($rubros)) {
            return $this->sendError('Rubros not found');
        }

        $rubros = $this->rubrosRepository->update($input, $id);

        return $this->sendResponse($rubros->toArray(), 'rubros updated successfully');
    }

    /**
     * Remove the specified rubros from storage.
     * DELETE /rubros/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var rubros $rubros */
        $rubros = $this->rubrosRepository->findWithoutFail($id);

        if (empty($rubros)) {
            return $this->sendError('Rubros not found');
        }

        $rubros->delete();

        return $this->sendResponse($id, 'Rubros deleted successfully');
    }
}
