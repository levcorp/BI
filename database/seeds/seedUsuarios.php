<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;
class seedUsuarios extends Seeder
{
 
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
                'cargo'=>$faker->randomElement($array = array ('Ventas','Sistemas','Aplicaciones','Adquisiciones')),
                'estado'=>'Activo',
                'global'=>$faker->randomElement($array = array ('Si','No')),
                'especialidad'=>$faker->randomElement($array = array ('AUTO','MECA','INST','ELEC','')),
                'sector'=>$faker->randomElement($array = array ('MAN','CSS','M&C','F&B','')),
            ]);
        }
        User::insert($datos);
    }
}
