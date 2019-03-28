<?php

use Illuminate\Database\Seeder;
use App\Solicitud;
use Faker\Factory;
class SeedSolicitud extends Seeder
{

    public function run()
    {
        $faker= Factory::create();
        for($i=0;$i<=100;$i++)
        {
            Solicitud::create([
                'numero'=>$i,
                'usuario_id'=>22,
                //fecha de solicitud
                'fecha'=>now(),
                //Estado de la solicitud
                'estado'=>$faker->randomElement($array = array ('Pendiente','Realizado')),
            ]);
        }
    }
}
