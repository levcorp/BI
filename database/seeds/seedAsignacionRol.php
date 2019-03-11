<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\AsignacionRol;
class seedAsignacionRol extends Seeder
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
            AsignacionRol::create([
                'usuario_id'=>$i,
                'rol_id'=>$faker->numberBetween($min = 1, $max = 6),
                'escritura'=>$faker->randomElement($array = array ('si','no')),
                'lectura'=>$faker->randomElement($array = array ('si','no')),
                'eliminacion'=>$faker->randomElement($array = array ('si','no')),
                'edicion'=>$faker->randomElement($array = array ('si','no')),
            ]);
        }
    }
}
