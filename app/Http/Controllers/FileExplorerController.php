<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileExplorerController extends Controller
{
    public function index($path = '')
{
    $basePath = storage_path('app/documentos');
    $fullPath = $basePath . ($path ? '/' . $path : '');

    if (!File::exists($fullPath)) {
        abort(404);
    }

    $files = collect(File::files($fullPath))->map(function ($file) {
        return [
            'name' => $file->getFilename(),
            'type' => 'file',
        ];
    });

    $folders = collect(File::directories($fullPath))->map(function ($folder) {
        return [
            'name' => basename($folder),
            'type' => 'folder',
        ];
    });

    $items = $folders->merge($files);
    $breadcrumb = $path ? explode('/', $path) : [];

    // 👇 Esta línea debe coincidir con la ruta de tu Blade
    return view('documentos.index', compact('items', 'breadcrumb', 'path'));
}


}
