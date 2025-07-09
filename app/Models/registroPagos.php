<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo RegistroPagos
 *
 * Representa un registro de pago realizado por un alumno.
 *
 * @property int $id_registro   Identificador único del registro de pago (PK)
 * @property string $descripcion Descripción del pago
 * @property float $total       Monto total del pago
 * @property string $fecha      Fecha del pago
 * @property string $lugar      Lugar donde se realizó el pago
 * @property int $id_alumno     Identificador del alumno que realizó el pago
 */
class registroPagos extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'registro_pagos';
    /**
     * Clave primaria de la tabla.
     * @var string
     */
    protected $primaryKey = 'id_registro';
    /**
     * Indica si el modelo debe gestionar las marcas de tiempo.
     * @var bool
     */
    public $timestamps = false;
    /**
     * Atributos que se pueden asignar de manera masiva.
     * @var array
     */
    protected $fillable = [
        'id_registro',
        'descripcion',
        'total',
        'fecha',
        'lugar',
        'id_alumno'
    ];

    use HasFactory;
}
