<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpetas;
use App\Models\Archivo;

class CarpetasController extends Controller
{
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', null);

        $carpetas = Carpetas::where('parent_id', $parent_id)->get();
        $archivos = Archivo::where('parent_id', $parent_id)->get();

        return view('documentos.index', [
            'carpetas' => $carpetas,
            'archivos' => $archivos,
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

    // public function destroy($id)
    // {
    //     $carpeta = Carpetas::findOrFail($id);
    //     $carpeta->delete();

    //     return response()->json(['success' => true, 'message' => 'Carpeta eliminada']);
    // }

    public function destroy($id)
{
    $carpeta = Carpetas::findOrFail($id);

    // Eliminar archivos directamente contenidos en esta carpeta
    $archivos = Archivo::where('parent_id', $id)->get();
    foreach ($archivos as $archivo) {
        if (\Storage::disk('public')->exists($archivo->archivo)) {
            \Storage::disk('public')->delete($archivo->archivo);
        }
        $archivo->delete();
    }

    // Buscar subcarpetas y eliminarlas recursivamente
    $subcarpetas = Carpetas::where('parent_id', $id)->get();
    foreach ($subcarpetas as $subcarpeta) {
        $this->destroy($subcarpeta->id); // llamada recursiva
    }

    // Finalmente eliminar la carpeta
    $carpeta->delete();

    return response()->json(['success' => true, 'message' => 'Carpeta y su contenido eliminados correctamente.']);
}


    public function rename(Request $request, $id)
    {
        $request->validate([
            'nuevo_nombre' => 'required|string|max:255',
        ]);

        $carpeta = Carpetas::findOrFail($id);
        $carpeta->nombre = $request->input('nuevo_nombre');
        $carpeta->save();

        return response()->json(['success' => true, 'message' => 'Carpeta renombrada correctamente', 'nuevo_nombre' => $carpeta->nombre]);
    }



}