<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\AsignacionSucursal;
class seedAsignacionSucursal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();
        for($i=1;$i<=21;$i++)
        {
            AsignacionSucursal::create([
                'usuario_id'=>$faker->numberBetween($min = 1, $max = 21),
                'sucursal_id'=>$faker->numberBetween($min = 1, $max = 3),
            ]);
        }
    }
}
