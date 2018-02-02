<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenegociosRequest;
use App\Http\Requests\UpdatenegociosRequest;
use App\Repositories\negociosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\contribuyentes;
use App\Models\rubros;
use App\Models\negocios;

class negociosController extends AppBaseController
{
    /** @var  negociosRepository */
    private $negociosRepository;

    public function __construct(negociosRepository $negociosRepo)
    {
        $this->negociosRepository = $negociosRepo;
    }

    /**
     * Display a listing of the negocios.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->negociosRepository->pushCriteria(new RequestCriteria($request));
        $negocios = $this->negociosRepository->all();

        return view('negocios.index')
            ->with('negocios', $negocios);
    }

    /**
     * Show the form for creating a new negocios.
     *
     * @return Response
     */
    public function create()
    {
        $contribuyetes = contribuyentes::pluck('nombre', 'id');
        $rubros = rubros::pluck('nombre', 'id');

        return view('negocios.create', compact('contribuyetes', 'rubros'));
    }

    /**
     * Store a newly created negocios in storage.
     *
     * @param CreatenegociosRequest $request
     *
     * @return Response
     */
    public function store(CreatenegociosRequest $request)
    {
        $input = $request->all();

        $negocios = $this->negociosRepository->create($input);

        Flash::success('Negocios saved successfully.');

        return redirect(route('negocios.index'));
    }

    /**
     * Display the specified negocios.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $negocios = $this->negociosRepository->findWithoutFail($id);

        if (empty($negocios)) {
            Flash::error('Negocios not found');

            return redirect(route('negocios.index'));
        }

        return view('negocios.show')->with('negocios', $negocios);
    }

    /**
     * Show the form for editing the specified negocios.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $negocios = $this->negociosRepository->findWithoutFail($id);
        $contribuyetes = contribuyentes::pluck('nombre', 'id');
        $rubros = rubros::pluck('nombre', 'id');

        if (empty($negocios)) {
            Flash::error('Negocios not found');

            return redirect(route('negocios.index'));
        }

        return view('negocios.edit', compact('negocios', 'contribuyetes', 'rubros'));
    }

    /**
     * Update the specified negocios in storage.
     *
     * @param  int              $id
     * @param UpdatenegociosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatenegociosRequest $request)
    {
        $negocios = $this->negociosRepository->findWithoutFail($id);

        if (empty($negocios)) {
            Flash::error('Negocios not found');

            return redirect(route('negocios.index'));
        }

        $negocios = $this->negociosRepository->update($request->all(), $id);

        Flash::success('Negocios updated successfully.');

        return redirect(route('negocios.index'));
    }

    /**
     * Remove the specified negocios from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $negocios = $this->negociosRepository->findWithoutFail($id);

        if (empty($negocios)) {
            Flash::error('Negocios not found');

            return redirect(route('negocios.index'));
        }

        $this->negociosRepository->delete($id);

        Flash::success('Negocios deleted successfully.');

        return redirect(route('negocios.index'));
    }

    public function mapa($id) {
        return view('negocios.mapa', compact('id'));
    }

    public function mapas(Request $request){
        $all = $request->all();
        $negocio = negocios::findOrFail($request->all()['id']);
        $negocio->lat = $all['lat'];
        $negocio->lng = $all['lng'];
        $negocio->save();
        return $negocio;
    }
}
