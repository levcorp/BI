<?php

use Illuminate\Database\Seeder;
use App\Sucursal;
use Carbon\Carbon;
class seedSucursal extends Seeder
{
    public function run()
    {
        $datos=array(
            [
                'nombre'=>'Cochabamba',
                'direccion'=>'Calle 15 de Agosto Nº 1789 Esq. Villa de Oropeza',
                'ciudad'=>'Cochabamba',
                'telefono'=>'+591-4 4140140',
                'fax'=>'+591-4 4140146',
                'correo'=>'ventasscz@levcorp.bo',
                'create'=>Carbon::now()->format('d-m-Y H:i:s'),
                'update'=>Carbon::now()->format('d-m-Y H:i:s')
            ],
            [
                'nombre'=>'La Paz',
                'direccion'=>'Av. Roma Nro 7447 Zona Obrajes',
                'ciudad'=>'La Paz',
                'telefono'=>'+591-2 2782126',
                'fax'=>'+591-2 2916465',
                'correo'=>'ventaslpz@levcorp.bo',
                'create'=>Carbon::now()->format('d-m-Y H:i:s'),
                'update'=>Carbon::now()->format('d-m-Y H:i:s')
            ],
            [
                'nombre'=>'Santa Cruz',
                'direccion'=>'Av. Cristo Redentor calle 8 Nº96 entre 4to y 3er Anillo',
                'ciudad'=>'Santa Cruz',
                'telefono'=>'+591-3 3449393',
                'fax'=>'+591-3 3430666',
                'correo'=>'ventasscz@levcorp.bo',
                'create'=>Carbon::now()->format('d-m-Y H:i:s'),
                'update'=>Carbon::now()->format('d-m-Y H:i:s')
            ],
        );
        Sucursal::insert($datos);
    }
}
