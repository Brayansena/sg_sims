<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vpn
 *
 * @property $id
 * @property $usuario
 * @property $contrasena
 * @property $servicio
 * @property $id_puntoVenta
 * @property $created_at
 * @property $updated_at
 *
 * @property PuntoVenta $puntoVenta
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vpn extends Model
{
    
    static $rules = [
		'usuario' => 'required',
		'contrasena' => 'required',
		'servicio' => 'required',
		'id_puntoVenta' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['usuario','contrasena','servicio','id_puntoVenta'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function puntoVenta()
    {
        return $this->hasOne('App\Models\PuntoVenta', 'id', 'id_puntoVenta');
    }
    

}
