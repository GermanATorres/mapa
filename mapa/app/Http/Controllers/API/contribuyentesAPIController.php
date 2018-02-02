<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecontribuyentesAPIRequest;
use App\Http\Requests\API\UpdatecontribuyentesAPIRequest;
use App\Models\contribuyentes;
use App\Repositories\contribuyentesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class contribuyentesController
 * @package App\Http\Controllers\API
 */

class contribuyentesAPIController extends AppBaseController
{
    /** @var  contribuyentesRepository */
    private $contribuyentesRepository;

    public function __construct(contribuyentesRepository $contribuyentesRepo)
    {
        $this->contribuyentesRepository = $contribuyentesRepo;
    }

    /**
     * Display a listing of the contribuyentes.
     * GET|HEAD /contribuyentes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contribuyentesRepository->pushCriteria(new RequestCriteria($request));
        $this->contribuyentesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $contribuyentes = $this->contribuyentesRepository->all();

        return $this->sendResponse($contribuyentes->toArray(), 'Contribuyentes retrieved successfully');
    }

    /**
     * Store a newly created contribuyentes in storage.
     * POST /contribuyentes
     *
     * @param CreatecontribuyentesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecontribuyentesAPIRequest $request)
    {
        $input = $request->all();

        $contribuyentes = $this->contribuyentesRepository->create($input);

        return $this->sendResponse($contribuyentes->toArray(), 'Contribuyentes saved successfully');
    }

    /**
     * Display the specified contribuyentes.
     * GET|HEAD /contribuyentes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var contribuyentes $contribuyentes */
        $contribuyentes = $this->contribuyentesRepository->findWithoutFail($id);

        if (empty($contribuyentes)) {
            return $this->sendError('Contribuyentes not found');
        }

        return $this->sendResponse($contribuyentes->toArray(), 'Contribuyentes retrieved successfully');
    }

    /**
     * Update the specified contribuyentes in storage.
     * PUT/PATCH /contribuyentes/{id}
     *
     * @param  int $id
     * @param UpdatecontribuyentesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecontribuyentesAPIRequest $request)
    {
        $input = $request->all();

        /** @var contribuyentes $contribuyentes */
        $contribuyentes = $this->contribuyentesRepository->findWithoutFail($id);

        if (empty($contribuyentes)) {
            return $this->sendError('Contribuyentes not found');
        }

        $contribuyentes = $this->contribuyentesRepository->update($input, $id);

        return $this->sendResponse($contribuyentes->toArray(), 'contribuyentes updated successfully');
    }

    /**
     * Remove the specified contribuyentes from storage.
     * DELETE /contribuyentes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var contribuyentes $contribuyentes */
        $contribuyentes = $this->contribuyentesRepository->findWithoutFail($id);

        if (empty($contribuyentes)) {
            return $this->sendError('Contribuyentes not found');
        }

        $contribuyentes->delete();

        return $this->sendResponse($id, 'Contribuyentes deleted successfully');
    }
}
