<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class rubros
 * @package App\Models
 * @version February 1, 2018, 9:28 am UTC
 *
 * @property string nombre
 * @property float porcentaje
 * @property integer estado
 * @property string icon
 */
class rubros extends Model
{
    use SoftDeletes;

    public $table = 'rubros';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'porcentaje',
        'estado',
        'icon'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'porcentaje' => 'float',
        'estado' => 'integer',
        'icon' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'porcentaje' => 'required',
        'icon' => 'required'
    ];

    
}
