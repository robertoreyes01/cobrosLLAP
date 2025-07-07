<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Modelo de usuario para la autenticación y gestión de usuarios en la aplicación.
 *
 * Representa la tabla 'usuario' en la base de datos.
 * Extiende de Authenticatable para integrarse con el sistema de autenticación de Laravel.
 */
class usuario extends Authenticatable
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'usuario';

    /**
     * Indica si el modelo debe ser timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'primer_nombre',      // Primer nombre del usuario
        'segundo_nombre',     // Segundo nombre del usuario
        'primer_apellido',    // Primer apellido del usuario
        'segundo_apellido',   // Segundo apellido del usuario
        'correo',             // Correo electrónico del usuario
        'password',           // Contraseña del usuario (hasheada)
        'estado',             // Estado del usuario (activo/inactivo)
        'id_rol',             // ID de rol asociado al usuario
    ];

    /**
     * Los atributos que deben estar ocultos para los arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Oculta la contraseña al serializar el modelo
    ];

    /**
     * Obtiene la contraseña del usuario para la autenticación.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Obtiene el nombre de la columna que se usa para la autenticación.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id_usuario';
    }

    /**
     * Obtiene el valor del identificador de autenticación.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    protected $primaryKey = 'id_usuario';
}
