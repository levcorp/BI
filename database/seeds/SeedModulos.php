<?php

use Illuminate\Database\Seeder;
use App\Modulo;
class SeedModulos extends Seeder
{
    public function run()
    {
        $data=array(
            [
                'nombre'=>'ArticulosABM',
                'descripcion'=>'Articulos ABM'
            ],
            [
                'nombre'=>'EDI852',
                'descripcion'=>'Articulos reportados a rockwell'
            ],
            [
                'nombre'=>'EDI867',
                'descripcion'=>'GPOS Faturas reportadas a Rockwell'
            ],
            [
                'nombre'=>'Ventas',
                'descripcion'=>'Panel de Graficas de Ventas'
            ],
            [
                'nombre'=>'Usuarios',
                'descripcion'=>'Usuarios',
            ],
            [
                'nombre'=>'Perfiles',
                'descripcion'=>'Perfiles',
            ],
            [
                'nombre'=>'Sucursales',
                'descripcion'=>'Sucursales',
            ],
        );
        Modulo::insert($data);
    }
}
