<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpetas;

class CarpetasController extends Controller
{
    public function index(Request $request)
    {
        // Obtener las carpetas de acuerdo al path (parent_id)
        $parent_id = $request->get('parent_id', null); // Si es null, estamos en la raíz
        $carpetas = Carpetas::where('parent_id', $parent_id)->get();

        return view('documentos.index', [
            'carpetas' => $carpetas,
            'parent_id' => $parent_id,
        ]);
    }

    public function crearCarpeta(Request $request)
    {
        // Crear una nueva carpeta en la base de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:carpetas,id', // ID de carpeta padre si aplica
        ]);

        Carpetas::create([
            'nombre' => $request->nombre,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('documentos.index', ['parent_id' => $request->parent_id]);
    }

}
