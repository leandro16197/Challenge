<?php

namespace App\Http\Controllers;

use App\Models\eventoModel;
use App\Models\reservas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    function index()
    {
        $evento = eventoModel::all();
        foreach ($evento as $eventoItem) {
            $eventoItem->fecha_evento = \Carbon\Carbon::parse($eventoItem->fecha_evento)->format('d/m/y');
        }

        return view('evento.tabla-evento', [
            'evento' => $evento
        ]);
    }

    function reservar(Request $request)
    {
        $request->merge([
            'cantidad' => filter_var($request->input('cantidad'), FILTER_SANITIZE_NUMBER_INT),
        ]);

        $request->validate([
            'evento_id' => 'required|integer|exists:evento,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $eventoId = $request->input('evento_id');
        $cantidad = $request->input('cantidad');


        $evento = eventoModel::find($eventoId);
        $cantidadParticipantes = Reservas::where('evento_id', $eventoId)->count();
        $user = Auth::user();

        if ($evento) {
            $existe = reservas::where('evento_id', $eventoId)
                ->where('user_id', $user->id)
                ->first();

            if ($existe) {
                $total = $cantidadParticipantes + $cantidad;
                if ($total <= $evento->capacidad_maxima) {
                    $actual=$existe->cantidad;
                    $existe->cantidad=$actual+$cantidad;
                    $existe->save();
                    return redirect()->route('evento.myevents')->with('success', 'Reserva realizada correctamente.');
                } else {
                    return redirect()->back()->with('error', 'supera la capacidad del evento.');
                }
            } else {
                if ($cantidad <= $evento->capacidad_maxima) {

                    $reserva = reservas::create([
                        'user_id' => $user->id,
                        'evento_id' => $eventoId,
                        'cantidad' => $cantidad,
                    ]);
                    return redirect()->route('evento.myevents')->with('success', 'Reserva realizada correctamente.');
                } else {
                    return redirect()->back()->with('error', 'supera la capacidad del evento.');
                }
            }
        }
        return redirect()->back()->with('error', 'Evento no encontrado.');
    }

    public function getEventoByUser() {
        $user = Auth::user();
        $dato = User::with(['eventos' => function ($query) {
            $query->withPivot('cantidad', 'id');
        }])->find($user->id);
        
        return view('evento.mis-Eventos', [
            'eventos' => $dato
        ]);
    }

    public function deleteReserva($id){
        $reserva = Reservas::find($id);
        if($reserva){
            $reserva->delete();
            return redirect()->back()->with('success', 'Reserva eliminada correctamente.');
        }else{
            return redirect()->back()->with('error', 'La reserva no existe.');
        }
    }
}
