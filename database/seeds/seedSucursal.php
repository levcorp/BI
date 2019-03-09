<?php

use Illuminate\Database\Seeder;
use App\Sucursal;
class seedSucursal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=array(
            [
                'nombre'=>'Cochabamba'
            ],
            [
                'nombre'=>'La Paz'
            ],
            [
                'nombre'=>'Santa Cruz'
            ],
        );
        Sucursal::insert($datos);
    }
}
