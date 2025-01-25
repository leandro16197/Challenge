<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('questionary.list-users', [
            'usuario' => $user->id
        ]);
    }
    public function list(Request $request)
    {

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $search = $request->input('search.value', '');
        $draw = (int) $request->input('draw', 1);


        $query = User::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }


        $recordsFiltered = $query->count();


        $data = $query->skip($start)->take($length)->get();


        return response()->json([
            'draw' => $draw,
            'recordsTotal' => User::count(),
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }
    public function delete_User($id)
    {
        $user = User::find($id);
        $userLog = Auth::user();
        if ($userLog->id == $id) {
            return response()->json(['message' => 'No se puede eliminar al Usuario logueado'], 200);
        } else {
            if ($user) {
                $user->delete();
                return response()->json(['message' => 'Registro eliminado correctamente'], 200);
            }
        }
        return response()->json(['error' => 'Error al eliminar usuario'], 404);
    }

    public function update_rol($id)
    {
        $user = User::find($id);
        $userLog = Auth::user();
        if ($userLog->id == $id) {
            return response()->json(['message' => 'No se puede modificar al Usuario logueado'], 200);
        } else {
            if ($user->rol==1) {
                $user->rol=2;
                $user->save();
                return response()->json(['message' => 'Registro modificado correctamente'], 200);
            }else{
                if ($user->rol==2) {
                    $user->rol=1;
                    $user->save();
                    return response()->json(['message' => 'Registro modificado correctamente'], 200);
                }
            }
        }
        return response()->json(['error' => 'Error al modificar usuario'], 404);
    }
}
