<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Archivo;
use Symfony\Component\HttpFoundation\Response;

class ArchivoController extends Controller
{

    // FUNCIÓN PARA VER LA VISTA Y LOS REGISTROS
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

    // FUNCIÓN PARA CREAR UN REGISTRO
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


    // FUNCIÓN PARA ACTUALIZAR UN REGISTRO
    public function update(Request $request, Archivo $archivo)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'archivo' => 'nullable|file|max:10240',
        ]);

        $archivo->descripcion = $request->descripcion;

        if ($request->hasFile('archivo')) {
            // Borrar el archivo anterior
            \Storage::disk('public')->delete($archivo->archivo);

            // Guardar el nuevo
            $nuevoArchivo = $request->file('archivo');
            $ruta = $nuevoArchivo->store('archivos', 'public');
            $nombreOriginal = $nuevoArchivo->getClientOriginalName();

            $archivo->archivo = $ruta;
            $archivo->nombre_archivo = $nombreOriginal;
        }

        $archivo->save();

        return redirect()->back()->with('success', 'Archivo actualizado correctamente.');
    }


    // FUNCIÓN PARA ELIMINAR UN REGISTRO
    public function destroy(Archivo $archivo)
    {
        if (Storage::disk('public')->exists($archivo->archivo)) {
            Storage::disk('public')->delete($archivo->archivo);
        }

        $archivo->delete();

        return redirect()->back()->with('success', 'Archivo eliminado correctamente.');
    }


    // ArchivoController.php
    public function ver($nombreArchivo)
    {
        // Buscamos en la BD el archivo con ese nombre real
        $archivo = Archivo::where('nombre_archivo', $nombreArchivo)->firstOrFail();

        $filePath = storage_path('app/public/' . $archivo->archivo);

        return response()->file($filePath, [
            'Content-Disposition' => 'inline; filename="' . $archivo->nombre_archivo . '"'
        ]);
    }




}
