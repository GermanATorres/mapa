<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecontribuyentesRequest;
use App\Http\Requests\UpdatecontribuyentesRequest;
use App\Repositories\contribuyentesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class contribuyentesController extends AppBaseController
{
    /** @var  contribuyentesRepository */
    private $contribuyentesRepository;

    public function __construct(contribuyentesRepository $contribuyentesRepo)
    {
        $this->contribuyentesRepository = $contribuyentesRepo;
    }

    /**
     * Display a listing of the contribuyentes.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contribuyentesRepository->pushCriteria(new RequestCriteria($request));
        $contribuyentes = $this->contribuyentesRepository->all();

        return view('contribuyentes.index')
            ->with('contribuyentes', $contribuyentes);
    }

    /**
     * Show the form for creating a new contribuyentes.
     *
     * @return Response
     */
    public function create()
    {
        return view('contribuyentes.create');
    }

    /**
     * Store a newly created contribuyentes in storage.
     *
     * @param CreatecontribuyentesRequest $request
     *
     * @return Response
     */
    public function store(CreatecontribuyentesRequest $request)
    {
        $input = $request->all();

        $contribuyentes = $this->contribuyentesRepository->create($input);

        Flash::success('Contribuyentes saved successfully.');

        return redirect(route('contribuyentes.index'));
    }

    /**
     * Display the specified contribuyentes.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contribuyentes = $this->contribuyentesRepository->findWithoutFail($id);

        if (empty($contribuyentes)) {
            Flash::error('Contribuyentes not found');

            return redirect(route('contribuyentes.index'));
        }

        return view('contribuyentes.show')->with('contribuyentes', $contribuyentes);
    }

    /**
     * Show the form for editing the specified contribuyentes.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contribuyentes = $this->contribuyentesRepository->findWithoutFail($id);

        if (empty($contribuyentes)) {
            Flash::error('Contribuyentes not found');

            return redirect(route('contribuyentes.index'));
        }

        return view('contribuyentes.edit')->with('contribuyentes', $contribuyentes);
    }

    /**
     * Update the specified contribuyentes in storage.
     *
     * @param  int              $id
     * @param UpdatecontribuyentesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecontribuyentesRequest $request)
    {
        $contribuyentes = $this->contribuyentesRepository->findWithoutFail($id);

        if (empty($contribuyentes)) {
            Flash::error('Contribuyentes not found');

            return redirect(route('contribuyentes.index'));
        }

        $contribuyentes = $this->contribuyentesRepository->update($request->all(), $id);

        Flash::success('Contribuyentes updated successfully.');

        return redirect(route('contribuyentes.index'));
    }

    /**
     * Remove the specified contribuyentes from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contribuyentes = $this->contribuyentesRepository->findWithoutFail($id);

        if (empty($contribuyentes)) {
            Flash::error('Contribuyentes not found');

            return redirect(route('contribuyentes.index'));
        }

        $this->contribuyentesRepository->delete($id);

        Flash::success('Contribuyentes deleted successfully.');

        return redirect(route('contribuyentes.index'));
    }
}
