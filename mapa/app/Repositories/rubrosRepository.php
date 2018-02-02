<?php

namespace App\Repositories;

use App\Models\rubros;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class rubrosRepository
 * @package App\Repositories
 * @version February 1, 2018, 9:28 am UTC
 *
 * @method rubros findWithoutFail($id, $columns = ['*'])
 * @method rubros find($id, $columns = ['*'])
 * @method rubros first($columns = ['*'])
*/
class rubrosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'porcentaje',
        'estado',
        'icon'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return rubros::class;
    }
}
