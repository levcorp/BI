<?php

use Illuminate\Database\Seeder;
use App\Rol;
use Faker\Factory as Faker;
class seedRol extends Seeder
{
        /*
        * @return void
        */
       public function run()
       {
   
           $faker=Faker::create();
           $datos=array([
               'titulo'=>'Gerencial',
               'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),

           ],
           [
                'titulo'=>'Administracion',
                'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
            ],
           [
               'titulo'=>'Sistemas',
               'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
           ],
           [
               'titulo'=>'Finanzas',
               'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
           ],
           [
               'titulo'=>'Adquisiciones',
               'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
           ],
           [
               'titulo'=>'Aplicaciones',
               'descripcion'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
           ],
           );
        Rol::insert($datos);
    }
}
