<?php

namespace App\Repositories;

use App\Models\contribuyentes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class contribuyentesRepository
 * @package App\Repositories
 * @version January 28, 2018, 4:15 am UTC
 *
 * @method contribuyentes findWithoutFail($id, $columns = ['*'])
 * @method contribuyentes find($id, $columns = ['*'])
 * @method contribuyentes first($columns = ['*'])
*/
class contribuyentesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'dui',
        'nit',
        'nacimiento',
        'telefono',
        'genero',
        'direccion',
        'estado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return contribuyentes::class;
    }
}
