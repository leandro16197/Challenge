<?php

namespace App\Http\Controllers;

use App\Models\eventoModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function index()
   {
      $evento = eventoModel::all();
      foreach ($evento as $eventoItem) {
          $eventoItem->fecha_evento = \Carbon\Carbon::parse($eventoItem->fecha_evento)->format('d/m/y');
      }

      return view('admin.admin', [
          'eventos' => $evento
      ]);
      
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'nombre' => 'required|string|max:255',
         'description' => 'required|string',
         'fecha_evento' => 'required|date',
         'localidad' => 'required|string|max:255',
         'direccion' => 'required|string|max:255',
         'capacidad_maxima' => 'required|integer',
      ]);

      $evento = eventoModel::find($id);
      if ($evento) {
         $evento->nombre = $request->nombre;
         $evento->description = $request->description;
         $evento->fecha_evento = $request->fecha_evento;
         $evento->localidad = $request->localidad;
         $evento->direccion = $request->direccion;
         $evento->capacidad_maxima = $request->capacidad_maxima;
         $evento->save();
         return redirect()->back()->with('success', 'Evento actualizado correctamente.');
      } else {
         return redirect()->back()->with('error', 'No se encontro el evento.');
      }
   }

   public function destroy($id)
   {
      $evento = eventoModel::find($id);
      if ($evento) {
         $evento->delete();
         return redirect()->back()->with('success', 'Evento Eliminado correctamente.');
      } else {
         return redirect()->back()->with('error', 'No se encontro el evento.');
      }
   }

   public function addEvent(Request $request)
   {
      return view('admin.form-add-event');
   }

   public function store(Request $request)
   {
      $request->validate([
         'nombre' => 'required|string|max:255',
         'description' => 'required|string',
         'fecha_evento' => 'required|date',
         'localidad' => 'required|string|max:255',
         'direccion' => 'required|string|max:255',
         'capacidad_maxima' => 'required|integer',
      ]);

      $evento = eventoModel::create([
         'nombre' => $request->nombre,
         'description' => $request->description,
         'fecha_evento' => $request->fecha_evento,
         'localidad' => $request->localidad,
         'direccion' => $request->direccion,
         'capacidad_maxima' => $request->capacidad_maxima,
      ]);

      return redirect()->back()->with('success', 'Evento Eliminado correctamente.');

   }
}
