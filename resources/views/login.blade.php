<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inicio de sesión</title>

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
            max-width: 400px;
            padding: 30px 25px;
        }

        .logo {
            display: block;
            width: 180px;
            height: auto;
            margin: 0 auto 30px;
        }

        .titulo {
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            color: #222;
            margin-bottom: 8px;
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

        .campo input {
            width: 100%;
            border: none;
            border-bottom: 1px solid #bdbdbd;
            padding: 10px 4px;
            font-size: 14px;
            outline: none;
            background: transparent;
        }

        .campo input:focus {
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
            margin-top: 8px;
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

        <h1 class="titulo">Inicio de sesión</h1>

        <p class="subtitulo">
            Acceso para administradores
        </p>

        <div class="campo">
            <label for="usuario">Usuario</label>

            <input
                type="text"
                id="usuario"
                name="usuario"
                placeholder="Ingrese su usuario"
                autocomplete="username"
            >
        </div>

        <div class="campo">
            <label for="contraseña">Contraseña</label>

            <input
                type="password"
                id="contraseña"
                name="contraseña"
                placeholder="Ingrese su contraseña"
                autocomplete="current-password"
            >
        </div>

        <button type="button" class="boton">
            Ingresar
        </button>

    </main>

</body>
</html>
