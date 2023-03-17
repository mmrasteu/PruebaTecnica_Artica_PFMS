<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = DB::table('usuarios')->get();
        return $usuarios;
    }

    public function get_value(Request $request)
    {
        $field_name = $request->post('field');
        $value = $request->post('value');
        $response = DB::table('usuarios')
            ->where($field_name, '=', $value)
            ->get();

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('usuarios')->insert(
            array(
                'name' => $request->input('nombre'),
                'nif' => $request->input('nif'),
                'phone' => $request->input('telefono'),
                'email' => $request->input('email'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        $insert = Usuarios::latest('id')->first();
        return $insert;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}