<?php

use Illuminate\Database\Seeder;
use App\Reporte;
class seedReporte extends Seeder
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
                'nombre'=>'Reporte Ventas',
                'url'=>'reporte.ventas',
                'dashboard_id'=>'1'
            ],
            [
                'nombre'=>'Reporte Presupuesto',
                'url'=>'reporte.ventas',
                'dashboard_id'=>'2'
            ],
            [
                'nombre'=>'Reporte Oportunidad',
                'url'=>'reporte.ventas',
                'dashboard_id'=>'3'
            ],
            [
                'nombre'=>'Reporte OV',
                'url'=>'reporte.ventas',
                'dashboard_id'=>'4'
            ],
            [
                'nombre'=>'Reporte Adquisiones',
                'url'=>'reporte.ventas',
                'dashboard_id'=>'5'
            ]
        );
        Reporte::insert($datos);
    }
}
