<?php

namespace App\Http\Controllers;

use App\Models\eventoModel;
use App\Models\FondoIm;
use App\Models\imgModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventoActualizadoMail;
use App\Mail\EventoCanceladoMail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
   public function index(Request $request)
   {

       $validated = Validator::make($request->all(), [
           'search' => 'nullable|string|max:255'
       ])->validate();
   
       $search = strip_tags($validated['search'] ?? '');

   
   
       $evento = eventoModel::where('nombre', 'like', '%' . $search . '%')
           ->orderBy('id', 'desc')
           ->paginate(5);
   
       return view('admin.admin', [
           'eventos' => $evento,
           'search' => $search, 
       ]);
   }

  
public function update(Request $request, $id)
{
    // 1️⃣ Validar entrada con reglas estrictas
    $validated = Validator::make($request->all(), [
        'nombre' => 'required|string|max:255',
        'description' => 'required|string',
        'fecha_evento' => 'required|date',
        'localidad' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'capacidad_maxima' => 'required|integer|min:1',
    ])->validate();

    $validated['nombre'] = htmlspecialchars($validated['nombre'], ENT_QUOTES, 'UTF-8');
    $validated['description'] = htmlspecialchars($validated['description'], ENT_QUOTES, 'UTF-8');
    $validated['localidad'] = htmlspecialchars($validated['localidad'], ENT_QUOTES, 'UTF-8');
    $validated['direccion'] = htmlspecialchars($validated['direccion'], ENT_QUOTES, 'UTF-8');

    $evento = eventoModel::find($id);
    if (!$evento) {
        return redirect()->back()->with('error', 'No se encontró el evento.');
    }


    $datosModificados = array_diff_assoc($validated, $evento->toArray());
    
    if (!empty($datosModificados)) {
        $evento->fill($validated)->save();

        foreach ($evento->usuarios as $usuario) {
            Mail::to($usuario->email)->send(new EventoActualizadoMail($evento));
        }

        return redirect()->back()->with('success', 'Evento actualizado y notificación enviada.');
    }

    return redirect()->back()->with('info', 'No hubo cambios en el evento.');
}

   public function destroy($id)
   {
       $evento = EventoModel::find($id);
   
       if ($evento) {
           $usuarios = User::whereHas('reservas', function ($query) use ($id) {
               $query->where('evento_id', $id);
           })->get();
   
     
           foreach ($usuarios as $usuario) {
               Mail::to($usuario->email)->send(new EventoCanceladoMail($evento));
           }
           $evento->delete();
   
           return redirect()->back()->with('success', 'Evento eliminado correctamente y se notificó a los usuarios.');
       } else {
           return redirect()->back()->with('error', 'No se encontró el evento.');
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

   public function config(Request $request)
   {
      return view('admin.admin-config');
   }
   public function addImgBackground(Request $request)
   {
      $request->validate([
         'backgroundImage' => 'required|image|mimes:jpg,jpeg,png,gif',
      ]);

      if ($request->hasFile('backgroundImage')) {
         $file = $request->file('backgroundImage');
         $path = $file->store('backgrounds', 'public');
         $img = imgModel::create([
            'imagen_path' => $path,
         ]);

         return redirect()->back()->with('success', 'Fondo Actualizado.');
      }

      return redirect()->back()->with('error', 'No se actualizó.');
   }

   public function getBackground()
   {
      $background = imgModel::latest()->first();
      return $background ? $background->imagen_path : 'img/fondo.jpg';
   }


   public function getUsers(Request $request){
        $validated = Validator::make($request->all(), [
            'search' => 'nullable|string|max:255'
        ])->validate();

        $search = strip_tags($validated['search'] ?? '');



        $usuarios = User::where('name', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('admin.admin-usuarios', [
            'usuarios' => $usuarios,
            'search' => $search, 
        ]);
   }

   public function updateRol($id)
{
    $usuario = User::find($id);
    if ($usuario) {
       
        if($usuario->rol==2){
            $usuario->rol =1 ; 
            $usuario->save();
            return redirect()->route('admin.users')->with('success', 'Rol de usuario actualizado correctamente.');
        }

        if($usuario->rol==1){
            $usuario->rol = 2; 
            $usuario->save();
            return redirect()->route('admin.users')->with('success', 'Rol de usuario actualizado correctamente.');
        }

        return redirect()->back()->with('error', 'No se pudo cambiar el ro');
    } else {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }
}
    public function deleteUser($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->delete();
            return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente.');
        } else {
            return redirect()->route('admin.users')->with('error', 'Usuario no encontrado.');
        }
    }

}
