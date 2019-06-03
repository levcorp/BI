<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modulo;
class controllerModulo extends Controller
{
    public function index(){
        return response()->json(Modulo::all());
    }
    public function store(Request $request){
        Modulo::create(all());
    }
    public function update(Request $request, $id){
        Modulo::findOrFail($id)->fill(all())->save();
    }
    public function destroy($id){
        Modulo::findOrFail($id)->delete();
    }
}
