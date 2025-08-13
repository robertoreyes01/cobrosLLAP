<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo Alumno
 *
 * Representa a un alumno en el sistema.
 *
 * @property int $id_alumno   Identificador único del alumno (PK)
 * @property string $nombres  Nombres del alumno
 * @property string $apellidos Apellidos del alumno
 * @property int $id_seccion  Identificador de la sección a la que pertenece el alumno
 */
class alumno extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'alumno';
    /**
     * Clave primaria de la tabla.
     * @var string
     */
    protected $primaryKey = 'id_alumno';
    /**
     * Indica si el modelo debe gestionar las marcas de tiempo (created_at, updated_at).
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * Atributos que se pueden asignar de manera masiva.
     * @var array
     */
    protected $fillable = [
        'id_alumno',
        'nombres',
        'apellidos',
        'id_seccion'
    ];

    /**
     * Obtiene el nombre de la clave de ruta para el modelo.
     * Utilizado para el model binding en las rutas.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id_alumno';
    }

}
