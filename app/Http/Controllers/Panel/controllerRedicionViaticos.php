<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RendicionViaticos;
use Response;
class controllerRedicionViaticos extends Controller
{
    public function handleGetRendiciones(Request $request){
        return Response::json(RendicionViaticos::where('RESPONSABLE_ID',$request->usuario_id)->orderBy('id','asc')->get());
    }
}
