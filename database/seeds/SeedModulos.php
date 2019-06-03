<?php

use Illuminate\Database\Seeder;
use App\Modulo;
class SeedModulos extends Seeder
{
    public function run()
    {
        $data=array(
            [
                'titulo'=>'ArticulosABM',
                'descripcion'=>'Registro de Articulos ABM',
            ],
            [
                'titulo'=>'EDI852',
                'descripcion'=>'EDI 852 de Articulos',
            ],
            [
                'titulo'=>'EDI867',
                'descripcion'=>'EDI 867 GPOS',
            ]
        );
        Modulo::insert($data);
    }
}
