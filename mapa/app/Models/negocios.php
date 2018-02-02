<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class negocios
 * @package App\Models
 * @version February 1, 2018, 9:51 am UTC
 *
 * @property integer contribuyente_id
 * @property integer rubro_id
 * @property string nombre
 * @property string direccion
 */
class negocios extends Model
{
    use SoftDeletes;

    public $table = 'negocios';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'contribuyente_id',
        'rubro_id',
        'nombre',
        'direccion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'contribuyente_id' => 'integer',
        'rubro_id' => 'integer',
        'nombre' => 'string',
        'direccion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contribuyente_id' => 'required',
        'rubro_id' => 'required',
        'nombre' => 'required',
        'direccion' => 'required'
    ];

    public function contribuyente() {
        return $this->hasOne('App\Models\contribuyentes', 'id');
    }

    public function rubro() {
        return $this->hasOne('App\Models\rubros', 'id');
    }
}
