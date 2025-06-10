@extends('layouts.app')

@section('content')
<style>
    .card-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.5rem;
    }

    .card-grid .card-item {
        flex: 1 1 calc(25% - 1.5rem);
        max-width: calc(25% - 1.5rem);
        display: flex;
    }

    @media (max-width: 1200px) {
        .card-grid .card-item {
            flex: 1 1 calc(33.33% - 1.5rem);
            max-width: calc(33.33% - 1.5rem);
        }
    }

    @media (max-width: 992px) {
        .card-grid .card-item {
            flex: 1 1 calc(50% - 1.5rem);
            max-width: calc(50% - 1.5rem);
        }
    }

    @media (max-width: 576px) {
        .card-grid .card-item {
            flex: 1 1 100%;
            max-width: 100%;
        }
    }

    .card {
        width: 100%;
        height: 100%;
    }


</style>

<div class="container mt-4">
    <div class="card-grid">

        <div class="card-item">
            <a href="https://www.mintrabajo.gob.gt/" class="text-decoration-none w-100" target="_blank">
                <div class="card shadow-lg border-light">
                    <img src="images/mintrabajo.png" class="card-img-top p-3 rounded-4 img-fluid w-75 mx-auto d-block" alt="MINTRAB">

                    <div class="card-body">
                        <h5 class="card-title">MINTRAB</h5>
                        <p class="card-text">Página del ministerio de trabajo</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-item">
            <a href="https://recit.mintrabajo.gob.gt/login" class="text-decoration-none w-100" target="_blank">
                <div class="card shadow-lg border-light">
                    <img src="images/mintrabajo.png" class="card-img-top p-3 rounded-4 img-fluid w-75 mx-auto d-block" alt="RECIT-V2">
                    <div class="card-body">
                        <h5 class="card-title">RECIT-V2</h5>
                        <p class="card-text">Página para registrar contratos de trabajo</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-item">
            <a href="https://solvencias.mintrabajo.gob.gt/" class="text-decoration-none w-100" target="_blank">
                <div class="card shadow-lg border-light">
                    <img src="images/mintrabajo.png" class="card-img-top p-3 rounded-4 img-fluid w-75 mx-auto d-block" alt="SOLVENCIAS">
                    <div class="card-body">
                        <h5 class="card-title">SOLVENCIAS</h5>
                        <p class="card-text">Página para las solvencias de trabajo del mintrab</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-item">
            <a href="https://servicios.igssgt.org/login.aspx?ReturnUrl=%2fSistema%2fdefault.aspx" class="text-decoration-none w-100" target="_blank">
                <div class="card shadow-lg border-light">
                    <img src="images/igss.png" class="card-img-top p-3 rounded-4 img-fluid w-50 mx-auto d-block" alt="PLANILLAS IGSS">
                    <div class="card-body">
                        <h5 class="card-title">PLANILLAS IGSS</h5>
                        <p class="card-text">Página para subir las planillas de los trabajadores</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-item">
            <a href="https://sso.minfin.gob.gt/Portal/Default/Credenciales/Login?ReturnUrl=%2fPortal%2fDefault%2fPrincipal%2fIndex" class="text-decoration-none w-100" target="_blank">
                <div class="card shadow-lg border-light">
                    <img src="images/rgae.jpg" class="card-img-top p-3 rounded-4 img-fluid w-75 mx-auto d-block" alt="RGAE">
                    <div class="card-body">
                        <h5 class="card-title">RGAE</h5>
                        <p class="card-text">Página del RGAE</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-item">
            <a href="https://www.guatecompras.gt/" class="text-decoration-none w-100" target="_blank">
                <div class="card shadow-lg border-light">
                    <img src="images/guatecompras.png" class="card-img-top p-3 rounded-4 img-fluid w-75 mx-auto d-block" alt="GUATECOMPRAS">
                    <div class="card-body">
                        <h5 class="card-title">GUATECOMPRAS</h5>
                        <p class="card-text">Página de Guatecompras</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="card-item">
            <a href="https://reportcreator.netlify.app/" class="text-decoration-none w-100" target="_blank">
                <div class="card shadow-lg border-light">
                    <img src="images/informe.png" class="card-img-top p-3 rounded-4 img-fluid w-50 mx-auto d-block" alt="CREAR INFORMES">
                    <div class="card-body">
                        <h5 class="card-title">CREAR INFORMES</h5>
                        <p class="card-text">Página para crear informes 2x2</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection