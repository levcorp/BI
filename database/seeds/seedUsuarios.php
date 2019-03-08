<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;
class seedUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=array([
            'nombre'=>'Gabriel', 
            'apellido'=>'Angel',
            'email'=>'gpinto@levcorp.bo',
            'password'=>\Hash::make('12345678'),
            'cargo'=>'Auxiliar de sistemas',
            'estado'=>'Activo',
            'global'=>'Si',
            'especialidad'=>'',
            'sector'=>'',
        ]);
        $faker = Faker::create();
    	for ($i=0;$i<=20;$i++) {
            User::create([
                'nombre'=>$faker->name, 
                'apellido'=>$faker->lastname,
                'email'=>$faker->email,
                'password'=>\Hash::make('12345678'),
                'cargo'=>'Ventas',
                'estado'=>'Activo',
                'global'=>'Si',
                'especialidad'=>'',
                'sector'=>'',
            ]);
        }
        User::insert($datos);
    }
}
