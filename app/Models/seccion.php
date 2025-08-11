<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class seccion extends Model
{
    protected $table = 'seccion';
    protected $primaryKey = 'id_seccion';
    public $timestamps = false;

    protected $fillable = [
        'id_seccion',
        'nombre',
        'matricula',
        'mensualidad'
    ];

    public function getRouteKeyName()
    {
        return 'id_seccion';
    }
}
