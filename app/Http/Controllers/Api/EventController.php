<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class EventController extends ApiController
{
    // traer todos los eventos por fechas 
    // recibir dos parametros: fechaInicio y fechaFin
    public function index()
    {
        return 'Event index';
    }

    public function create()
    {
        return view('web.event.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        return 'Event show ' . $id;
    }

    public function edit(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        return 'Event destroy ' . $id;
    }
}