<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function get_available_date($value)
    {
        $response = DB::table('citas')
            ->where('cita', 'like', $value . '%')
            ->get();

        return $response;
    }

    public function transactional_set(Request $request)
    {
        DB::beginTransaction();
        try {
            $booking = Citas::create([

                'usuario_id' => $request->input('usuario_id'),
                'tipo_cita' => $request->input('tipo_cita'),
                'cita' => $request->input('cita'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $booking->save();


        } catch (\Exception $e) {
            DB::rollback();
            if ($e->getCode() == 23000) {
                return false;
            } else {
                return $e;
            }
        }
        DB::commit();
        return true;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Citas $citas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citas $citas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citas $citas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citas $citas)
    {
        //
    }
}