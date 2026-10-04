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
            border: none;
            border-bottom: 1px solid #bdbdbd;
            padding: 10px 4px;
            font-size: 14px;
            outline: none;
            background: transparent;
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

            <input
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Ingrese su nombre"
                autocomplete="off"
            >
        </div>

        <div class="campo">
            <label for="carrera">Seleccione una carrera</label>

            <select id="carrera" name="carrera">
                <option value="">Seleccione una carrera</option>
                <option>Administración General</option>
                <option>Administración de Turismo</option>
                <option>Ingeniería Comercial</option>
                <option>Comercio Internacional</option>
                <option>Ingeniería en Marketing y Publicidad</option>
                <option>Contaduría Pública</option>
                <option>Ingeniería Financiera</option>
                <option>Comunicación Estratégica y Digital</option>
                <option>Ingeniería Industrial y Comercial</option>
                <option>Ingeniería Electrónica y Sistemas</option>
                <option>Ingeniería Mecánica Automotriz y Agroindustrial</option>
                <option>Ingeniería de Sistemas</option>
                <option>Ingeniería Eléctrica</option>
                <option>Ingeniería de Alimentos y Negocios</option>
                <option>Derecho</option>
                <option>Relaciones Internacionales</option>
                <option>Psicología</option>
                <option>Otros</option>
            </select>
        </div>

        <button type="button" class="boton">
            Ingresar
        </button>

    </main>

</body>
</html>
