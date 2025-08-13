<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo Padre
 *
 * Representa a un padre o apoderado en el sistema.
 *
 * @property int $id_padre    Identificador único del padre (PK)
 * @property int $id_usuario  Identificador del usuario asociado
 * @property int $id_alumno   Identificador del alumno asociado
 */
class padre extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'padre';
    /**
     * Clave primaria de la tabla.
     * @var string
     */
    protected $primaryKey = 'id_padre';
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
        'id_padre',
        'id_usuario',
        'id_alumno'
    ];

    
}
