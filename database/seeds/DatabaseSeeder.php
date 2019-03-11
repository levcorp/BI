<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call(seedUsuarios::class);
         $this->call(seedRol::class);
         $this->call(seedModulo::class);
         $this->call(seedSucursal::class);
         $this->call(seedDashboard::class);
         $this->call(seedAsignacionRol::class);
         $this->call(seedAsignacionSucursal::class);
         $this->call(seedAsignacionDashboard::class);
         $this->call(seedReporte::class);
    }
}
