<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>Información del examen</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f5f7f6;
            color: #222;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .contenedor {
            width: 100%;
            max-width: 520px;
        }

        .tarjeta {
            width: 100%;
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            overflow: hidden;
        }

        /* CABECERA */

        .cabecera {
            text-align: center;
            padding: 18px 20px 15px;
            border-bottom: 1px solid #eeeeee;
        }

        .logo {
            width: 125px;
            height: auto;
            margin-bottom: 12px;
        }

        .titulo {
            font-size: 21px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .subtitulo {
            font-size: 12px;
            color: #777;
        }

        /* INFORMACIÓN */

        .contenido {
            padding: 18px 20px 20px;
        }

        .seccion {
            margin-bottom: 18px;
        }

        .titulo-seccion {
            font-size: 13px;
            font-weight: 700;
            color: #00a878;
            margin-bottom: 10px;
        }

        .dato {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 8px 0;
            border-bottom: 1px solid #eeeeee;
        }

        .dato:last-child {
            border-bottom: none;
        }

        .etiqueta {
            font-size: 13px;
            color: #777;
        }

        .valor {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            text-align: right;
        }

        /* BLOQUE Y PISO */

        .dato-destacado {
            padding: 9px 0;
        }

        .dato-destacado .etiqueta {
            font-size: 14px;
            font-weight: 600;
            color: #555;
        }

        .dato-destacado .valor {
            font-size: 19px;
            font-weight: 700;
            color: #007d5a;
        }

        /* AULA */

        .aula {
            margin-top: 10px;
            padding: 13px;
            background: #e7f8f1;
            text-align: center;
            border-radius: 10px;
        }

        .aula-label {
            display: block;
            font-size: 11px;
            color: #00845f;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .aula-numero {
            display: block;
            font-size: 29px;
            font-weight: 700;
            color: #007d5a;
        }

        /* CROQUIS */

        .croquis-seccion {
            margin-top: 5px;
        }

        .croquis-titulo {
            font-size: 13px;
            font-weight: 700;
            color: #00a878;
            margin-bottom: 9px;
        }

        .croquis-contenedor {
            width: 100%;
            background: #f8f8f8;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }

        .croquis {
            display: block;
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
        }

        .croquis-ayuda {
            text-align: center;
            font-size: 11px;
            color: #777;
            padding: 7px;
            background: #ffffff;
            border-top: 1px solid #eeeeee;
        }

        /* MODAL DEL CROQUIS */

        .modal-croquis {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.88);
            align-items: center;
            justify-content: center;
            padding: 55px 15px 20px;
            overflow: hidden;
        }

        .modal-croquis.activo {
            display: flex;
        }

        .modal-contenido {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: auto;
        }

        .croquis-ampliado {
            width: auto;
            height: auto;
            max-width: 95vw;
            max-height: 85vh;
            object-fit: contain;
            transform-origin: center center;
            transition: transform 0.2s ease;
            user-select: none;
        }

        .cerrar {
            position: fixed;
            top: 15px;
            right: 18px;
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 50%;
            background: #ffffff;
            color: #333;
            font-size: 22px;
            cursor: pointer;
            z-index: 1002;
        }

        .controles-zoom {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 1002;
        }

        .boton-zoom {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 5px;
            background: #ffffff;
            color: #333;
            font-size: 22px;
            cursor: pointer;
        }

        .boton-zoom.reiniciar {
            width: auto;
            padding: 0 14px;
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 480px) {

            body {
                padding: 10px;
                align-items: flex-start;
            }

            .contenedor {
                margin-top: 5px;
            }

            .cabecera {
                padding: 15px 15px 12px;
            }

            .logo {
                width: 110px;
                margin-bottom: 9px;
            }

            .titulo {
                font-size: 19px;
            }

            .subtitulo {
                font-size: 11px;
            }

            .contenido {
                padding: 15px;
            }

            .seccion {
                margin-bottom: 14px;
            }

            .croquis {
                max-height: 250px;
            }

            .aula-numero {
                font-size: 27px;
            }
        }

        .cerrar-registro {
    margin-top: 10px;
    padding-top: 0;
    border-top: none;
    text-align: center;
}

.boton-cerrar-registro {
    display: inline-block;
    padding: 12px 25px;
    background: #dc2626;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    width: 100%;
}

.boton-cerrar-registro:hover {
    background: #b91c1c;
}
    </style>
</head>

<body>

    <main class="contenedor">

        <section class="tarjeta">

            <!-- CABECERA -->

            <header class="cabecera">

                <img
                    src="{{ asset('images/logoCre.webp') }}"
                    alt="Examen de Beca Bachiller"
                    class="logo"
                >

                <h1 class="titulo">
                    Información de tu examen
                </h1>

                <p class="subtitulo">
                    Consulta los datos de tu aula asignada
                </p>

            </header>

            <!-- INFORMACIÓN -->

            <div class="contenido">

                <section class="seccion">

                    <h2 class="titulo-seccion">
                        Datos del estudiante
                    </h2>

                    <div class="dato">
    <span class="etiqueta">
        Nombre
    </span>

    <span class="valor">
        {{ $estudiante->nombre }}
    </span>
</div>

<div class="dato">
    <span class="etiqueta">
        Carrera de interés
    </span>

    <span class="valor">
        {{ $estudiante->carrera->nombre_carrera }}
    </span>
</div>

                </section>

                <!-- AULA -->

                <section class="seccion">

                    <h2 class="titulo-seccion">
                        Aula asignada
                    </h2>

                    <div class="dato dato-destacado">

                        <span class="etiqueta">
                            Bloque
                        </span>

                        <span class="valor">
    {{ $estudiante->asignacionAula->bloque }}
</span>

                    </div>

                    <div class="dato dato-destacado">

                        <span class="etiqueta">
                            Piso
                        </span>

                        <span class="valor">
    {{ $estudiante->asignacionAula->piso }}
</span>

                    </div>

                    <div class="aula">

                        <span class="aula-label">
                            TU AULA
                        </span>

                        <span class="aula-numero">
    {{ $estudiante->asignacionAula->aula }}
</span>

                    </div>

                </section>

                <!-- CROQUIS -->

                <section class="croquis-seccion">

                    <h2 class="croquis-titulo">
                        Croquis
                    </h2>

                    <div
                        class="croquis-contenedor"
                        onclick="abrirCroquis()"
                    >

                        <img
                            src="{{ asset($estudiante->asignacionAula->piso == '5'
                            ? 'images/croquis_quinto_piso.webp'
                            : 'images/croquis_sexto_piso.webp') }}"
                        alt="Croquis del piso {{ $estudiante->asignacionAula->piso }}"
                        class="croquis"
                        >

                        <div class="croquis-ayuda">
                            Toque el croquis para ampliarlo
                        </div>

                    </div>

                </section>

            </div>


        </section>

<div class="cerrar-registro">
                <a href="{{ url('/') }}" class="boton-cerrar-registro">
                Cerrar sesión
                </a>
            </div>

    </main>


    <!-- MODAL -->

    <div
        id="modalCroquis"
        class="modal-croquis"
    >

        <button
            class="cerrar"
            onclick="cerrarCroquis()"
            aria-label="Cerrar"
        >
            ×
        </button>

            <div class="modal-contenido">

                <img
    id="croquisAmpliado"
    src="{{ asset(
        $estudiante->asignacionAula->piso == '5'
            ? 'images/croquis_quinto_piso.webp'
            : 'images/croquis_sexto_piso.webp'
    ) }}"
    alt="Croquis ampliado del piso {{ $estudiante->asignacionAula->piso }}"
    class="croquis-ampliado"
>

            </div>

        <div class="controles-zoom">

            <button
                class="boton-zoom"
                onclick="zoom(-0.2)"
            >
            </button>

            <button
                class="boton-zoom reiniciar"
                onclick="reiniciarZoom()"
            >
                Restablecer
            </button>

            <button
                class="boton-zoom"
                onclick="zoom(0.2)"
            >
                +
            </button>

        </div>

    </div>


    <script>

        let escala = 1;

        function abrirCroquis() {

            const modal = document.getElementById('modalCroquis');

            modal.classList.add('activo');

            escala = 1;

            actualizarZoom();

            document.body.style.overflow = 'hidden';
        }

        function cerrarCroquis() {

            const modal = document.getElementById('modalCroquis');

            modal.classList.remove('activo');

            document.body.style.overflow = '';
        }

        function zoom(valor) {

            escala += valor;

            if (escala < 1) {
                escala = 1;
            }

            if (escala > 3) {
                escala = 3;
            }

            actualizarZoom();
        }

        function reiniciarZoom() {

            escala = 1;

            actualizarZoom();
        }


            function actualizarZoom() {

            const imagenes = document.querySelectorAll('.croquis-ampliado');

            imagenes.forEach(imagen => {
            imagen.style.transform = `scale(${escala})`;
        });

    }

        document.getElementById('modalCroquis').addEventListener(
            'click',
            function(event) {

                if (event.target === this) {
                    cerrarCroquis();
                }

            }
        );

        document.addEventListener(
            'keydown',
            function(event) {

                if (event.key === 'Escape') {
                    cerrarCroquis();
                }

            }
        );

    </script>

</body>
</html>
