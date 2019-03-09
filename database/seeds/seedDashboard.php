<?php

use Illuminate\Database\Seeder;
use App\Dashboard;
use Faker\Factory as Faker;
class seedDashboard extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        $datos=array(
            [
                'nombre'=>'Jefe de Ventas',
                'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            ],
            [
                'nombre'=>'Asesor de Ventas',
                'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            ],
            [
                'nombre'=>'Jefe Financiero',
                'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            ],
            [
                'nombre'=>'Auxiliar Financiero',
                'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            ],
            [
                'nombre'=>'Jefe de Adquisiciones',
                'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            ]
        );
        Dashboard::insert($datos);
    }
}
