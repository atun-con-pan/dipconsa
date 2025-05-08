<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentos;

class DocumentosController extends Controller
{
    public function index(Request $request)
    {
        // Obtener las carpetas de acuerdo al parent_id (o raíz si es null)
        $parent_id = $request->get('parent_id');
        $carpetas = Documentos::where('parent_id', $parent_id)->get();

        return view('documentos.index', [
            'carpetas' => $carpetas,
            'parent_id' => $parent_id,
        ]);
    }

    public function crearCarpeta(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:documentos,id', // <- corregido aquí
        ]);

        Documentos::create([
            'nombre' => $request->nombre,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('documentos.index', ['parent_id' => $request->parent_id]);
    }
}
