<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivo;

class ArchivoController extends Controller
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

    public function subirArchivo(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'archivo' => 'required|file|max:102400',
            'parent_id' => 'nullable|exists:carpetas,id',
        ]);

        $file = $request->file('archivo');
        $ruta = $file->store('archivos', 'public');
        $nombre_archivo = $file->getClientOriginalName();

        Archivo::create([
            'descripcion' => $request->descripcion, // ahora se usa lo que escribe el usuario
            'archivo' => $ruta,
            'nombre_archivo' => $nombre_archivo,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('documentos.index', ['parent_id' => $request->parent_id]);
    }

    public function destroy(Archivo $archivo)
    {
        Storage::delete($archivo->archivo);
        $archivo->delete();

        return back();
    }
}
