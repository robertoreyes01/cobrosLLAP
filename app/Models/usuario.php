<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo de usuario para la autenticación y gestión de usuarios en la aplicación.
 *
 * Representa la tabla 'usuario' en la base de datos.
 * Extiende de Authenticatable para integrarse con el sistema de autenticación de Laravel.
 *
 * @property int $id_usuario         Identificador único del usuario (PK)
 * @property string $primer_nombre   Primer nombre del usuario
 * @property string $segundo_nombre  Segundo nombre del usuario
 * @property string $primer_apellido Primer apellido del usuario
 * @property string $segundo_apellido Segundo apellido del usuario
 * @property string $correo          Correo electrónico del usuario
 * @property string $password        Contraseña hasheada del usuario
 * @property string $estado          Estado del usuario (activo/inactivo)
 * @property int $id_rol             ID de rol asociado al usuario
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
        'primer_nombre',      
        'segundo_nombre',     
        'primer_apellido',    
        'segundo_apellido',   
        'correo',             
        'password',           
        'estado',             
        'id_rol',             
    ];

    /**
     * Los atributos que deben estar ocultos para los arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 
    ];

    /**
     * Obtiene la contraseña del usuario para la autenticación.
     *
     * @return string Contraseña hasheada
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Obtiene el nombre de la columna que se usa para la autenticación.
     *
     * @return string Nombre de la columna identificadora
     */
    public function getAuthIdentifierName()
    {
        return 'id_usuario';
    }

    /**
     * Obtiene el valor del identificador de autenticación.
     *
     * @return mixed Valor del identificador
     */
    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_usuario';

    use HasFactory;
}
