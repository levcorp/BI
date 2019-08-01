<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mercado;
use Response;
class controllerMercado extends Controller
{
    public function index()
    {
        return Response::json(Mercado::all());
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        Mercado::create($request->all());
    }
    public function show($id)
    {
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        Mercado::findOrFail($id)->fill($request->all())->save();
    }
    public function destroy($id)
    {
        Mercado::findOrFail($id)->delete();
    }
}
