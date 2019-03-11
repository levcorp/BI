<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\AsignacionDashboard;
class seedAsignacionDashboard extends Seeder
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
            AsignacionDashboard::create([
                'usuario_id'=>$i,
                'dashboard_id'=>$faker->numberBetween($min = 1, $max = 5),
            ]);
        }
    }
}
