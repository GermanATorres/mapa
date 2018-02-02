<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatenegociosAPIRequest;
use App\Http\Requests\API\UpdatenegociosAPIRequest;
use App\Models\negocios;
use App\Repositories\negociosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class negociosController
 * @package App\Http\Controllers\API
 */

class negociosAPIController extends AppBaseController
{
    /** @var  negociosRepository */
    private $negociosRepository;

    public function __construct(negociosRepository $negociosRepo)
    {
        $this->negociosRepository = $negociosRepo;
    }

    /**
     * Display a listing of the negocios.
     * GET|HEAD /negocios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->negociosRepository->pushCriteria(new RequestCriteria($request));
        $this->negociosRepository->pushCriteria(new LimitOffsetCriteria($request));
        $negocios = $this->negociosRepository->all();

        return $this->sendResponse($negocios->toArray(), 'Negocios retrieved successfully');
    }

    /**
     * Store a newly created negocios in storage.
     * POST /negocios
     *
     * @param CreatenegociosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatenegociosAPIRequest $request)
    {
        $input = $request->all();

        $negocios = $this->negociosRepository->create($input);

        return $this->sendResponse($negocios->toArray(), 'Negocios saved successfully');
    }

    /**
     * Display the specified negocios.
     * GET|HEAD /negocios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var negocios $negocios */
        $negocios = $this->negociosRepository->findWithoutFail($id);

        if (empty($negocios)) {
            return $this->sendError('Negocios not found');
        }

        return $this->sendResponse($negocios->toArray(), 'Negocios retrieved successfully');
    }

    /**
     * Update the specified negocios in storage.
     * PUT/PATCH /negocios/{id}
     *
     * @param  int $id
     * @param UpdatenegociosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatenegociosAPIRequest $request)
    {
        $input = $request->all();

        /** @var negocios $negocios */
        $negocios = $this->negociosRepository->findWithoutFail($id);

        if (empty($negocios)) {
            return $this->sendError('Negocios not found');
        }

        $negocios = $this->negociosRepository->update($input, $id);

        return $this->sendResponse($negocios->toArray(), 'negocios updated successfully');
    }

    /**
     * Remove the specified negocios from storage.
     * DELETE /negocios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var negocios $negocios */
        $negocios = $this->negociosRepository->findWithoutFail($id);

        if (empty($negocios)) {
            return $this->sendError('Negocios not found');
        }

        $negocios->delete();

        return $this->sendResponse($id, 'Negocios deleted successfully');
    }
}
