<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Adldap\AdldapInterface;
use App\EspecialidadMeses;
use Carbon\Carbon;
use Session;
use Auth;
class controllerPanel extends Controller
{
    public function __construct(){
        $this->middleware('Check',['only'=>['inicio','newInicio','sector','newSector','usuarios','gpos','perfiles','sucursales','stock']]);
        $this->middleware('Usuarios',['only'=>'usuarios']);
        $this->middleware('EDI867',['only'=>'gpos']);
        $this->middleware('Perfiles',['only'=>'perfiles']);
        $this->middleware('Sucursales',['only'=>'sucursales']);
        $this->middleware('Stock',['only'=>'stock']);
        $this->middleware('AdminCuestionarios',['only'=>'cuestionarios']);
        $this->middleware('Cuestionarios',['only'=>'cuestionariosUser']);
        $this->middleware('Resultados',['only'=>'cuestionariosResultado']);
        $this->middleware('Grupos',['only'=>'grupos']);
        $this->middleware('EstadosTarea',['only'=>'estados']);
        $this->middleware('TareasAsignadas',['only'=>'tareasUsuario']);
        $this->middleware('TareasCreadas',['only'=>'tareasCusuario']);
        $this->middleware('TareasEspecialidad',['only'=>'tareasEspecialidad']);
        $this->middleware('TareasVentas',['only'=>'tareas']);
        $this->middleware('Ubicación',['only'=>'ubicaciones']);
        $this->middleware('Seguimiento',['only'=>'seguimiento']);
        $this->middleware('Facturacion',['only'=>'facturacion']);
        $this->middleware('AlmacenUsuario',['only'=>'almacenUsuario']);
        $this->middleware('Almacen',['only'=>'almacen']);
    }
    public function newInicio(){
        return view('panel.dashboard.Asistencia.index');
    }
    public function inicio(){
        $titulo="General";
        $meses = EspecialidadMeses::select('PERIODO', DB::raw('SUM(EJECUTADO) as EJECUTADO'),DB::raw('SUM(META) as META'))
                ->where('SECTOR','like','%')->groupBy('PERIODO')->orderBy('PERIODO','asc')
                ->get();
        $todo=EspecialidadMeses::all()->toJson();
        //consulta oportunidades
        $oportunidades=DB::table('ReporteOportunidad')
                            ->select('PosicionEstado',DB::raw('SUM(TotalUSDcdesc) as Total'))
                            ->groupBy('PosicionEstado')
                            ->get();
           $oportunidadPorcentaje=DB::table('ReporteOportunidadPorcentaje')
                            ->orderBy('PosicionEstado','asc')
                            ->orderBy('PExito','asc')
                            ->get();
        $porcentajeEspecialidad=DB::table('PresupuestoMeses')
                                ->select('ESPECIALIDAD',DB::raw('SUM(META) as META'),DB::raw('SUM(EJECUTADO) as EJECUTADO'))
                                ->where('ESPECIALIDAD','!=','OTROS')
                                ->groupBy('ESPECIALIDAD')
                                ->orderBy('ESPECIALIDAD','asc')
                                ->get();
        $porcentajeEspecialidad->map(function ($item, $key) {
        $nombre=["Automatización",'Electrica','Instrumentación','Mecanica','Media Tensión'];
            return $item->nombre=$nombre[$key];
        });
        $porcentajeEspecialidad->map(function ($item, $key) {
            $circleColor=["#FAB9AC",'#7BBC53','#DE6736','#67C1EC','#E6B90D'];
            $waveColor=["rgba(250,185,172, 0.5)",'rgba(123,188,83, 0.5)','rgba(222,103,54, 0.5)','rgba(103,193,236, 0.5)','rgba(230,185,13, 0.5)'];
            return $item->color=[
                $circleColor[$key],
                $waveColor[$key]
            ];
        });
        Session::flash('mensaje','Datos cargados correctamente');
    return view('panel.dashboard.morris',compact('meses','todo','titulo','oportunidades','oportunidadPorcentaje','porcentajeEspecialidad'));
    }
    public function sector($dato){
        $meses = EspecialidadMeses::select('PERIODO','SECTOR', DB::raw('SUM(EJECUTADO) as EJECUTADO'),DB::raw('SUM(META) as META'))->where('SECTOR','like',$dato)->groupBy('PERIODO','SECTOR')->orderBy('PERIODO','asc')->orderBy('SECTOR','asc')->get();
        if($dato=='MAN'){$titulo='Manufactura';}
        if($dato=='CSS'){$titulo='Construcción y Servicios';}
        if($dato=='O&G'){$titulo='Gas y Petroleo';}
        if($dato=='F&B'){$titulo='Alimentos y Bebidas';}
        if($dato=='M&C'){$titulo='Minería y Cemento';}

        $todo=EspecialidadMeses::all()->toJson();

        $oportunidades=DB::table('ReporteOportunidad')
                        ->select('PosicionEstado','Sector',DB::raw('SUM(TotalUSDcdesc) as Total'))
                        ->groupBy('PosicionEstado','Sector')
                        ->get();
       $oportunidadPorcentaje=DB::table('ReporteOportunidadPorcentaje')
                            ->orderBy('PosicionEstado','asc')
                            ->orderBy('PExito','asc')
                            ->get();
        $porcentajeEspecialidad=DB::table('PresupuestoMeses')
                            ->select('ESPECIALIDAD',DB::raw('SUM(META) as META'),DB::raw('SUM(EJECUTADO) as EJECUTADO'))
                            ->where('ESPECIALIDAD','!=','OTROS')
                            ->where('SECTOR',$dato)
                            ->groupBy('ESPECIALIDAD')
                            ->orderBy('ESPECIALIDAD','asc')
                            ->get();
        $porcentajeEspecialidad->map(function ($item, $key) {
        $nombre=["Automatización",'Electrica','Instrumentación','Mecanica','Media Tensión'];
            return $item->nombre=$nombre[$key];
        });
        $porcentajeEspecialidad->map(function ($item, $key) {
            $circleColor=["#FAB9AC",'#7BBC53','#DE6736','#67C1EC','#E6B90D'];
            $waveColor=["rgba(250,185,172, 0.5)",'rgba(123,188,83, 0.5)','rgba(222,103,54, 0.5)','rgba(103,193,236, 0.5)','rgba(230,185,13, 0.5)'];
            return $item->color=[
                $circleColor[$key],
                $waveColor[$key]
            ];
        });
        Session::flash('mensaje','Datos cargados correctamente');
        return view('panel.dashboard.morris',compact('meses','todo','titulo','oportunidades','oportunidadPorcentaje','porcentajeEspecialidad'));
    }
    public function newSector($dato){
        $titulo="general";
        $meses = EspecialidadMeses::select('PERIODO','SECTOR', DB::raw('SUM(EJECUTADO) as EJECUTADO'),DB::raw('SUM(META) as META'))->where('SECTOR','like',$dato)->groupBy('PERIODO','SECTOR')->orderBy('PERIODO','asc')->orderBy('SECTOR','asc')->get();
        if($dato=='MAN'){$titulo='Manufactura';}
        if($dato=='CSS'){$titulo='Construcción y Servicios';}
        if($dato=='O&G'){$titulo='Gas y Petroleo';}
        if($dato=='F&B'){$titulo='Alimentos y Bebidas';}
        if($dato=='M&C'){$titulo='Minería y Cemento';}

        $todo=EspecialidadMeses::all()->toJson();

        $oportunidades=DB::table('ReporteOportunidad')
                        ->select('PosicionEstado','Sector',DB::raw('SUM(TotalUSDcdesc) as Total'))
                        ->groupBy('PosicionEstado','Sector')
                        ->get();
       $oportunidadPorcentaje=DB::table('ReporteOportunidadPorcentaje')
                            ->orderBy('PosicionEstado','asc')
                            ->orderBy('PExito','asc')
                            ->get();
        $porcentajeEspecialidad=DB::table('PresupuestoMeses')
                            ->select('ESPECIALIDAD',DB::raw('SUM(META) as META'),DB::raw('SUM(EJECUTADO) as EJECUTADO'))
                            ->where('ESPECIALIDAD','!=','OTROS')
                            ->where('SECTOR',$dato)
                            ->groupBy('ESPECIALIDAD')
                            ->orderBy('ESPECIALIDAD','asc')
                            ->get();
        $porcentajeEspecialidad->map(function ($item, $key) {
        $nombre=["Automatización",'Electrica','Instrumentación','Mecanica','Media Tensión'];
            return $item->nombre=$nombre[$key];
        });
        $porcentajeEspecialidad->map(function ($item, $key) {
            $circleColor=["#FAB9AC",'#7BBC53','#DE6736','#67C1EC','#E6B90D'];
            $waveColor=["rgba(250,185,172, 0.5)",'rgba(123,188,83, 0.5)','rgba(222,103,54, 0.5)','rgba(103,193,236, 0.5)','rgba(230,185,13, 0.5)'];
            return $item->color=[
                $circleColor[$key],
                $waveColor[$key]
            ];
        });
        Session::flash('mensaje','Datos cargados correctamente');
        return view('panel.dashboard.panel',compact('meses','todo','titulo','oportunidades','oportunidadPorcentaje','porcentajeEspecialidad'));
    }
    public function usuarios(){
        return view('panel.registros.usuarios.index');
    }
    public function gpos(){
        return view('panel.registros.gpos.index');
    }
    public function perfiles(){
        return view('panel.registros.perfil.index');
    }
    public function sucursales(){
        return view('panel.registros.sucursal.index');
    }
    public function stock(){
        return view('panel.registros.stock.index');
    }
    public function tareas(){
        return view('panel.registros.tareas.index');
    }
    public function estados(){
        return view('panel.registros.estadoAccionTarea.index');
    }
    public function tareasEspecialidad(){
        return view('panel.registros.tareas.tareasEspecialidad');
    }
    public function tareasSector(){
        return view('panel.registros.tareas.tareasSector');
    }
    public function tareasCusuario(){
        return view('panel.registros.tareas.tareasCusuario');
    }
    public function tareasUsuario(){
        return view('panel.registros.tareas.tareasUsuario');
    }
    public function mercados(){
        return view('panel.registros.mercado.index');
    }
    public function cuestionarios(){
        return view ('panel.registros.cuestionario.index');
    }
    public function grupos(){
        return view('panel.registros.grupo.index');
    }
    public function cuestionariosUser(){
        return view ('panel.registros.cuestionario.usuario.index');
    }
    public function cuestionariosResultado(){
        return view ('panel.registros.cuestionario.resultado.index');
    }
    public function ssl(){
        return view('panel.ssl.index');
    }
    public function ubicaciones(){
        return view('panel.registros.ubicaciones.index');
    }
    public function abm(){
        return view('panel.registros.abm.index');
    }
    public function almacen(){
        return view('panel.registros.almacen.index');
    }
    public function almacenUsuario(){
      return view('panel.registros.almacen.usuario.index');
    }
    public function facturas(){
      return view('panel.registros.facturas.index');
    }
    public function rendicionViaticos(){
      return view('panel.registros.rendicion.viaticos.index');
    }
    public function seguimiento(){
      return view('panel.registros.seguimiento.index');
    }
    public function facturacion(){
     return view('panel.registros.facturacion.index');
    }
    public function socios(){
        return view('panel.registros.sociosNegocio.index');
    }
    public function solicitud(){
        return view('panel.registros.rendicion.solicitud.index');
    }
    public function autorizacion(){
        return view('panel.registros.rendicion.solicitud.autorizacion.index');
    }
    public function desembolso(){
        return view('panel.registros.rendicion.solicitud.desembolso.index');
    }
    public function usuarioRegistros(){
        return view('panel.dashboard.Asistencia.usuarios');
    }
    public function finalizada(){
        return view('panel.registros.rendicion.solicitud.autorizacionRendicion.index');
    }
    public function prueba(){
        return Carbon::parse('2020-05-18');
        return view('panel.registros.solicitud_rendicion.index');
    }
}
