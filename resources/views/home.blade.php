@extends('layouts.app')

@section('content')
<div class="max-w-screen-xl mx-auto px-4 py-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
        
        <!-- MINTRAB -->
        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-cyan-400/30 transition duration-300">
            <a href="https://www.mintrabajo.gob.gt/" target="_blank" class="block h-full">
                <img src="images/mintrabajo.png" alt="MINTRAB" class="w-3/4 mx-auto pt-4 rounded-xl">
                <div class="p-4 text-center">
                    <h5 class="text-lg font-bold text-white">MINTRAB</h5>
                    <p class="text-sm text-gray-400">Página del Ministerio de Trabajo</p>
                </div>
            </a>
        </div>

        <!-- RECIT-V2 -->
        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-cyan-400/30 transition duration-300">
            <a href="https://recit.mintrabajo.gob.gt/login" target="_blank" class="block h-full">
                <img src="images/mintrabajo.png" alt="RECIT-V2" class="w-3/4 mx-auto pt-4 rounded-xl">
                <div class="p-4 text-center">
                    <h5 class="text-lg font-bold text-white">RECIT-V2</h5>
                    <p class="text-sm text-gray-400">Registro de contratos de trabajo</p>
                </div>
            </a>
        </div>

        <!-- SOLVENCIAS -->
        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-cyan-400/30 transition duration-300">
            <a href="https://solvencias.mintrabajo.gob.gt/" target="_blank" class="block h-full">
                <img src="images/mintrabajo.png" alt="SOLVENCIAS" class="w-3/4 mx-auto pt-4 rounded-xl">
                <div class="p-4 text-center">
                    <h5 class="text-lg font-bold text-white">SOLVENCIAS</h5>
                    <p class="text-sm text-gray-400">Solicitar solvencias laborales</p>
                </div>
            </a>
        </div>

        <!-- PLANILLAS IGSS -->
        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-cyan-400/30 transition duration-300">
            <a href="https://servicios.igssgt.org/login.aspx?ReturnUrl=%2fSistema%2fdefault.aspx" target="_blank" class="block h-full">
                <img src="images/igss.png" alt="PLANILLAS IGSS" class="w-1/2 mx-auto pt-4 rounded-xl">
                <div class="p-4 text-center">
                    <h5 class="text-lg font-bold text-white">PLANILLAS IGSS</h5>
                    <p class="text-sm text-gray-400">Sube las planillas de los trabajadores</p>
                </div>
            </a>
        </div>

        <!-- RGAE -->
        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-cyan-400/30 transition duration-300">
            <a href="https://sso.minfin.gob.gt/Portal/Default/Credenciales/Login?ReturnUrl=%2fPortal%2fDefault%2fPrincipal%2fIndex" target="_blank" class="block h-full">
                <img src="images/rgae.jpg" alt="RGAE" class="w-3/4 mx-auto pt-4 rounded-xl">
                <div class="p-4 text-center">
                    <h5 class="text-lg font-bold text-white">RGAE</h5>
                    <p class="text-sm text-gray-400">Sistema RGAE</p>
                </div>
            </a>
        </div>

        <!-- GUATECOMPRAS -->
        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-cyan-400/30 transition duration-300">
            <a href="https://www.guatecompras.gt/" target="_blank" class="block h-full">
                <img src="images/guatecompras.png" alt="GUATECOMPRAS" class="w-3/4 mx-auto pt-4 rounded-xl">
                <div class="p-4 text-center">
                    <h5 class="text-lg font-bold text-white">GUATECOMPRAS</h5>
                    <p class="text-sm text-gray-400">Sistema de compras del estado</p>
                </div>
            </a>
        </div>

        <!-- CREAR INFORMES -->
        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-cyan-400/30 transition duration-300">
            <a href="{{ route('ayuda.reporte-form') }}" target="_blank" class="block h-full">
                <img src="images/informe.png" alt="CREAR INFORMES" class="w-1/2 mx-auto pt-4 rounded-xl">
                <div class="p-4 text-center">
                    <h5 class="text-lg font-bold text-white">CREAR INFORMES</h5>
                    <p class="text-sm text-gray-400">Página para informes 2x2</p>
                </div>
            </a>
        </div>

        <!-- DECLARACIONES -->
        <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-cyan-400/30 transition duration-300">
            <a href="{{ route('declaraciones.declaraciones') }}" target="_blank" class="block h-full">
                <img src="images/declaracion.jpg" alt="CREAR DECLARACIONES JURADAS" class="w-1/2 mx-auto pt-4 rounded-xl">
                <div class="p-4 text-center">
                    <h5 class="text-lg font-bold text-white">CREAR DECLARACIONES JURADAS</h5>
                    <p class="text-sm text-gray-400">Genera declaraciones juradas fácilmente</p>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
