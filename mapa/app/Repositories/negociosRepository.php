<?php

namespace App\Repositories;

use App\Models\negocios;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class negociosRepository
 * @package App\Repositories
 * @version February 1, 2018, 9:51 am UTC
 *
 * @method negocios findWithoutFail($id, $columns = ['*'])
 * @method negocios find($id, $columns = ['*'])
 * @method negocios first($columns = ['*'])
*/
class negociosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'direccion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return negocios::class;
    }
}
