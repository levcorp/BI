<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(seedPerfil::class);
        $this->call(SeedModulos::class);
        $this->call(seedSucursal::class);

    }
}
