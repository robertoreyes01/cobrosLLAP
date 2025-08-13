<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class seccion
 * 
 * Modelo que representa una sección o grado en el sistema educativo.
 * Gestiona la información de las secciones y sus precios de matrícula y mensualidad.
 *
 * @property int $id_seccion Identificador único de la sección (clave primaria)
 * @property string $nombre Nombre de la sección (ej: "Primer Grado", "Segundo Grado")
 * @property float $matricula Precio de la matrícula para esta sección
 * @property float $mensualidad Precio de la mensualidad para esta sección
 * 
 * @method static \Illuminate\Database\Eloquent\Builder whereNombre(string $nombre)
 * @method static \Illuminate\Database\Eloquent\Builder whereMatricula(float $matricula)
 * @method static \Illuminate\Database\Eloquent\Builder whereMensualidad(float $mensualidad)
 */
class seccion extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'seccion';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_seccion';

    /**
     * Indica si el modelo debe gestionar las marcas de tiempo (created_at, updated_at).
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atributos que se pueden asignar de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'id_seccion',
        'nombre',
        'matricula',
        'mensualidad'
    ];

    /**
     * Obtiene el nombre de la clave de ruta para el modelo.
     * Utilizado para el model binding en las rutas.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id_seccion';
    }
}
