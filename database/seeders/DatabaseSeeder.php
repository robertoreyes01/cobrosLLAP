<?php

namespace Database\Seeders;

use App\Models\usuario;
use App\Models\padre;
use App\Models\alumno;
use App\Models\registroPagos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        usuario::factory(20)->create();
        alumno::factory(20)->create();
        padre::factory(20)->create();
        registroPagos::factory(20)->create();
    }
}
