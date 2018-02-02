<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreaterubrosRequest;
use App\Http\Requests\UpdaterubrosRequest;
use App\Repositories\rubrosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class rubrosController extends AppBaseController
{
    /** @var  rubrosRepository */
    private $rubrosRepository;

    public function __construct(rubrosRepository $rubrosRepo)
    {
        $this->rubrosRepository = $rubrosRepo;
    }

    /**
     * Display a listing of the rubros.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rubrosRepository->pushCriteria(new RequestCriteria($request));
        $rubros = $this->rubrosRepository->all();

        return view('rubros.index')
            ->with('rubros', $rubros);
    }

    /**
     * Show the form for creating a new rubros.
     *
     * @return Response
     */
    public function create()
    {
        return view('rubros.create');
    }

    /**
     * Store a newly created rubros in storage.
     *
     * @param CreaterubrosRequest $request
     *
     * @return Response
     */
    public function store(CreaterubrosRequest $request)
    {
        $input = $request->all();

        $rubros = $this->rubrosRepository->create($input);

        Flash::success('Rubros saved successfully.');

        return redirect(route('rubros.index'));
    }

    /**
     * Display the specified rubros.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rubros = $this->rubrosRepository->findWithoutFail($id);

        if (empty($rubros)) {
            Flash::error('Rubros not found');

            return redirect(route('rubros.index'));
        }

        return view('rubros.show')->with('rubros', $rubros);
    }

    /**
     * Show the form for editing the specified rubros.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rubros = $this->rubrosRepository->findWithoutFail($id);

        if (empty($rubros)) {
            Flash::error('Rubros not found');

            return redirect(route('rubros.index'));
        }

        return view('rubros.edit')->with('rubros', $rubros);
    }

    /**
     * Update the specified rubros in storage.
     *
     * @param  int              $id
     * @param UpdaterubrosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterubrosRequest $request)
    {
        $rubros = $this->rubrosRepository->findWithoutFail($id);

        if (empty($rubros)) {
            Flash::error('Rubros not found');

            return redirect(route('rubros.index'));
        }

        $rubros = $this->rubrosRepository->update($request->all(), $id);

        Flash::success('Rubros updated successfully.');

        return redirect(route('rubros.index'));
    }

    /**
     * Remove the specified rubros from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rubros = $this->rubrosRepository->findWithoutFail($id);

        if (empty($rubros)) {
            Flash::error('Rubros not found');

            return redirect(route('rubros.index'));
        }

        $this->rubrosRepository->delete($id);

        Flash::success('Rubros deleted successfully.');

        return redirect(route('rubros.index'));
    }
}
