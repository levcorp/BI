<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sucursal;
class controllerSucursal extends Controller
{
    public function index()
    {
        $sucursal=Sucursal::orderBy('id','asc')
                ->get();
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        Sucursal::create([
            'sucursal'=>$request->sucursal            
        ]);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $sucursal=Sucursal::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        Sucursal::findOrFail($id)
                ->fill([
                    'sucursal'=>$request->sucursal            
                ])
                ->save();
    }
    public function destroy($id)
    {
        Sucursal::findOrFail($id)->delete();
    }
}
