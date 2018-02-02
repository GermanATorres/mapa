<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class contribuyentes
 * @package App\Models
 * @version January 28, 2018, 4:15 am UTC
 *
 * @property string nombre
 * @property string dui
 * @property string nit
 * @property date nacimiento
 * @property string telefono
 * @property integer genero
 * @property string direccion
 * @property tinyInteger estado
 */
class contribuyentes extends Model
{
    use SoftDeletes;

    public $table = 'contribuyentes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'dui' => 'string',
        'nit' => 'string',
        'nacimiento' => 'date',
        'telefono' => 'string',
        'genero' => 'integer',
        'direccion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'dui' => 'required',
        'nit' => 'required',
        'nacimiento' => 'required',
        'telefono' => 'required',
        'genero' => 'required',
        'direccion' => 'required'
    ];

    
}
