<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Examen de Beca Bachiller</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contenedor {
            width: 100%;
            max-width: 420px;
            padding: 30px 25px;
        }

        .logo {
            display: block;
            width: 180px;
            height: auto;
            margin: 0 auto 25px;
        }

        .titulo {
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #222;
        }

        .subtitulo {
            text-align: center;
            font-size: 13px;
            color: #00a878;
            margin-bottom: 35px;
        }

        .campo {
            margin-bottom: 22px;
        }

        .campo label {
            display: block;
            font-size: 13px;
            color: #333;
            margin-bottom: 8px;
        }

        .campo input,
        .campo select {
            width: 100%;
            max-width: 100%;
            border: none;
            border-bottom: 1px solid #bdbdbd;
            padding: 10px 4px;
            font-size: 14px;
            outline: none;
            background: transparent;
            box-sizing: border-box;
        }

        .campo input:focus,
        .campo select:focus {
            border-bottom-color: #00a878;
        }

        .boton {
            width: 100%;
            border: none;
            background: #00c875;
            color: white;
            padding: 12px;
            font-size: 14px;
            cursor: pointer;
        }

        .boton:hover {
            background: #00b36a;
        }

        @media (max-width: 480px) {
            .contenedor {
                padding: 25px 22px;
            }

            .logo {
                width: 160px;
            }

            .titulo {
                font-size: 24px;
            }
            .campo select {
                font-size: 14px;
            }
        }

.buscador-estudiante {
    position: relative;
}

.sugerencias {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #ffffff;
    border: 1px solid #dddddd;
    border-top: none;
    z-index: 100;
    display: none;
    max-height: 220px;
    overflow-y: auto;
}

.sugerencia {
    padding: 11px 8px;
    font-size: 13px;
    color: #333;
    cursor: pointer;
    border-bottom: 1px solid #eeeeee;
    background: #ffffff;
}

.sugerencia:hover {
    background: #f5f5f5;
}

.sugerencia:last-child {
    border-bottom: none;
}

.mensaje-sugerencia {
    padding: 11px 8px;
    font-size: 13px;
    color: #777;
}

.mensaje-registrado {
    margin-top: 20px;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
}

.mensaje-registrado p {
    margin-bottom: 15px;
    font-weight: 600;
}

    </style>
</head>




<body>

    <main class="contenedor">

        <img
            src="{{ asset('images/logo-examen-beca.png') }}"
            alt="Examen de Beca Bachiller"
            class="logo"
        >

        <h1 class="titulo">Hello Crack</h1>

        <p class="subtitulo">
            Regístrate para conocer tu aula
        </p>

        <div class="campo">

    <label for="nombre">Nombre completo</label>

    <div class="buscador-estudiante">

        <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Ingrese su nombre"
            autocomplete="off"
        >

        <input
            type="hidden"
            id="estudiante_id"
            name="estudiante_id"
        >

        <div
            id="sugerencias"
            class="sugerencias"
        ></div>

    </div>

</div>

        <div class="campo">
            <label for="carrera">Seleccione una carrera</label>

            <select id="carrera" name="carrera">
    <option value="">Seleccione una carrera</option>

    @foreach ($carreras as $carrera)
        <option value="{{ $carrera->id }}">
            {{ $carrera->nombre_carrera }}
        </option>
    @endforeach
</select>
        </div>

        <button type="button" class="boton" id="botonIngresar">
            Ingresar
        </button>

        <div id="mensajeRegistrado" class="mensaje-registrado" style="display: none;">
    <p>Este estudiante ya realizó su registro.</p>

    <a id="botonVerAula" href="#" class="boton">
        Ver mi aula
    </a>
</div>

    </main>




    <script>

    const campoNombre = document.getElementById('nombre');
    const estudianteId = document.getElementById('estudiante_id');
    const sugerencias = document.getElementById('sugerencias');

    let temporizador;

    campoNombre.addEventListener('input', function () {

        const nombre = this.value.trim();

        estudianteId.value = '';

        clearTimeout(temporizador);

        if (nombre.length < 2) {
            sugerencias.innerHTML = '';
            sugerencias.style.display = 'none';
            return;
        }

        temporizador = setTimeout(() => {

            fetch(`/buscar-estudiantes?nombre=${encodeURIComponent(nombre)}`)
                .then(response => response.json())
                .then(estudiantes => {

                    sugerencias.innerHTML = '';

                    if (estudiantes.length === 0) {

                        sugerencias.innerHTML = `
                            <div class="mensaje-sugerencia">
                                No se encontraron estudiantes.
                            </div>
                        `;

                        sugerencias.style.display = 'block';

                        return;
                    }

                    estudiantes.forEach(estudiante => {

                        const elemento = document.createElement('div');

                        elemento.classList.add('sugerencia');

                        elemento.textContent = estudiante.nombre;

                        elemento.addEventListener('click', function () {

                            campoNombre.value = estudiante.nombre;

                            estudianteId.value = estudiante.id;

                            sugerencias.innerHTML = '';

                            sugerencias.style.display = 'none';

                            console.log(
                                'Estudiante seleccionado:',
                                estudiante.id,
                                estudiante.nombre
                            );

                        });

                        sugerencias.appendChild(elemento);

                    });

                    sugerencias.style.display = 'block';

                })
                .catch(error => {

                    console.error(
                        'Error al buscar estudiantes:',
                        error
                    );

                    sugerencias.innerHTML = `
                        <div class="mensaje-sugerencia">
                            Ocurrió un error al realizar la búsqueda.
                        </div>
                    `;

                    sugerencias.style.display = 'block';

                });

        }, 250);

    });


    document.addEventListener('click', function (event) {

        if (!event.target.closest('.buscador-estudiante')) {

            sugerencias.innerHTML = '';

            sugerencias.style.display = 'none';

        }

    });

    const botonIngresar = document.getElementById('botonIngresar');
const carrera = document.getElementById('carrera');

botonIngresar.addEventListener('click', function () {

    const idEstudiante = estudianteId.value;
    const idCarrera = carrera.value;

    if (!idEstudiante) {
        alert('Seleccione un estudiante de la lista.');
        return;
    }

    if (!idCarrera) {
        alert('Seleccione una carrera.');
        return;
    }

    fetch('{{ route('estudiantes.registrar') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            estudiante_id: idEstudiante,
            carrera_id: idCarrera
        })
    })
    .then(response => response.json())
    .then(data => {
    if (data.success) {
        window.location.href =
            `/registro-completo?estudiante_id=${data.estudiante_id}`;
        return;
    }

    if (data.ya_registrado) {
        const mensajeRegistrado =
            document.getElementById('mensajeRegistrado');

        const botonVerAula =
            document.getElementById('botonVerAula');

        botonVerAula.href =
            `/tarjeta-presentacion?estudiante_id=${data.estudiante_id}`;

        mensajeRegistrado.style.display = 'block';

        return;
    }

    alert(data.message);
})
    .catch(error => {

        console.error('Error al registrar:', error);

        alert('Ocurrió un error al realizar el registro.');

    });

});

</script>
</body>
</html>
