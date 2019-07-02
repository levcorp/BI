<?php

use Illuminate\Database\Seeder;
use App\Perfil;
class seedPerfil extends Seeder
{
    public function run()
    {
        /*$datos=array([
            'nombre'=>'Usuarios',
            'descripcion'=>'Listado de Usuarios de Active directory, Edicion, Bloqueo, Cambio de Contraseña',
        ],
        [
            'nombre'=>'Solicitudes',
            'descripcion'=>'Creacion de Solicitudes de Articulos ABM',
        ],
        [
            'nombre'=>'EDI852',
            'descripcion'=>'Listado de Archivos generado, visualizacion, descarga y genracion de listados por fecha',
        ],
        [
            'nombre'=>'EDI867',
            'descripcion'=>'Listado de Archivos generado, descarga y genracion de listados por fechas',
        ]
        );*/
        $datos=array(
            [
                'nombre'=>'Sistemas',
                'descripcion'=>'Sistemas',
            ],
            [
                'nombre'=>'Finanzas',
                'descripcion'=>'Finanzas',
            ],
            [
                'nombre'=>'Adquisiciones',
                'descripcion'=>'Adquisiciones',
            ],
            [
                'nombre'=>'Gestion Operativa',
                'descripcion'=>'Gestion Operativa',
            ],
            [
                'nombre'=>'Gerencia Administrativa',
                'descripcion'=>'Gerencia Administrativa',
            ],
            [
                'nombre'=>'Recursos Humanos',
                'descripcion'=>'Recursos Humanos',
            ],
            [
                'nombre'=>'Servicios',
                'descripcion'=>'Servicios',
            ],
            [
                'nombre'=>'Especialistas',
                'descripcion'=>'Especialistas',
            ],
            [
                'nombre'=>'Ingenieros de Aplicacion',
                'descripcion'=>'Ingenieros de Aplicacion',
            ],
            [
                'nombre'=>'Almacenes',
                'descripcion'=>'Almacenes',
            ],
        );
        Perfil::insert($datos);
    }
}
