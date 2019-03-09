<?php

use Illuminate\Database\Seeder;
use App\Modulos;
use Faker\Factory as Faker;
class seedModulo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker=Faker::create();
        $datos=array([
            'titulo'=>'Usuarios',
            'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            'rol_id'=>2,  
        ],
        [
            'titulo'=>'Roles',
            'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            'rol_id'=>2,
        ],
        [
            'titulo'=>'Reportes',
            'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            'rol_id'=>2,
        ],
        [
            'titulo'=>'Dashboard',
            'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            'rol_id'=>2,
        ],
        [
            'titulo'=>'Regionales',
            'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            'rol_id'=>2,
        ],
        );
       Modulos::insert($datos);
    }
}
