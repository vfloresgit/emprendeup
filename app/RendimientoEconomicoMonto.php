<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RendimientoEconomicoMonto extends Model
{
    //
    protected $table = 'rendimientos_economico_montos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_rendimiento','punto_equilibrio','monto_compras_soles','monto_compras_importacion','monto_impuesto_renta_3era_categoria','monto_impuesto_renta_3era_categoria','monto_impuesto_renta_5ta_categoria','fondos_propios','fondos_inversionistas','fondos_no_reembolsables','fondos_creditos','inversion_privada','inversion_fondos_concursables','inversiones_otros','fase','estado_activo','created_at','updated_at','meses_id'
    ];
}
