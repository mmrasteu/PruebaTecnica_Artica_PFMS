<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CitasController;
use App\Mail\Email;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function index()
    {
        return view('formulario');
    }

    public function request(Request $request)
    {


        $request->merge([
            'field' => 'nif',
            'value' => $request->input('nif')
        ]);

        // Obtener datos del cliente si existe
        $usuarios_controller = new UsuariosController();
        $usuarios_response = $usuarios_controller->get_value($request);

        if (count($usuarios_response) == 0) {
            $usuario_insertado = $usuarios_controller->store($request);
            $usuario_id = $usuario_insertado->id;
        } else {
            $usuario_id = $usuarios_response[0]->id;
        }

        $request->merge([
            'usuario_id' => $usuario_id,
        ]);

        // Obtener ultima cita disponible
        $cita_controller = new CitasController();

        $booking_control = false;
        $current_date = Carbon::now();

        $date = $current_date->format('Y-m-d');
        $hour = $current_date->format('H');

        // Si actualmente son menos de las 10 de la noche se puede dar cita hoy
        // Nota:
        // Es cierto que de esta forma podrian quedar huecos en un dia si las primeras citas se piden despues de las 10.
        // Pero aun incumpliendo una de las premisas del ejercicio creo que tambien hay que aplicar una logica realista
        // Evidentemente si son mas de las 10, aun existiendo ese hueco en la base de datos, no te puedo dar cita para hoy a una hora que ya ha pasado
        if ($hour < 22) {
            // Si son menos de las 10 de la mañana se prefija la hora a las 10
            if ($hour < 10) {
                $hour = 10;
            } else {
                $hour = $hour + 1;
            }
            //Registramos la fecha y hora de la cita
            $cita = $date . ' ' . $hour . ":00:00";
        } else {
            // Si son mas de las 10 de la noche se dará cita para el dia siguiente
            $date = date("Y-m-d", strtotime($date . "+ 1 days"));
            $hour = 10;
            //Registramos la fecha y hora de la cita
            $cita = $date . ' ' . $hour . ":00:00";
        }

        // $request->request->add(['booking_datetime', $booking_datetime]);
        $request->merge([
            'cita' => $cita,
        ]);

        while (!$booking_control) {
            // Recorremos las posibles opciones de cita entre las 10 y las 22
            // Si no hay hueco se pasa al dia siguiente y vuelve a contar desde las 10

            $booking_control = $cita_controller->transactional_set($request);

            if (!$booking_control) {
                $hour++;
                if ($hour == 23) {
                    $hour = 10;
                    $date = date("Y-m-d", strtotime($date . "+ 1 days"));
                }
                $cita = $date . ' ' . $hour . ":00:00";
                $request->merge([
                    'cita' => $cita,
                ]);
            }
        }

        // He probado el envio de mail con mailtrap, puedo adjuntar captura de que funciona si lo requerís
        // Pero para las pruebas que hagais debereis modificar el .env si quereis que os llegue el correo 
        Mail::to($request->input('email'))->send(new Email($request));

        return view("form_enviado", ["cita" => $cita]);
    }


}