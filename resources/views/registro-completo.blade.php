<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro completado</title>

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
            text-align: center;
        }

        .logo {
            display: block;
            width: 180px;
            height: auto;
            margin: 0 auto 35px;
        }

        .icono {
            width: 70px;
            height: 70px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: #e7f8f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00a878;
            font-size: 36px;
            font-weight: bold;
        }

        .titulo {
            font-size: 25px;
            font-weight: 700;
            color: #222;
            margin-bottom: 12px;
        }

        .mensaje {
            font-size: 14px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 30px;
        }

        .boton {
            display: block;
            width: 100%;
            border: none;
            background: #00c875;
            color: white;
            padding: 12px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
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
                font-size: 23px;
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

        <div class="icono">
            ✓
        </div>

        <h1 class="titulo">
            ¡Registro completado!
        </h1>

        <p class="mensaje">
            Tu información ha sido registrada correctamente.
            Ahora puedes consultar el aula asignada para tu examen.
        </p>

        <a href="#" class="boton">
            Ver mi aula
        </a>

    </main>

</body>
</html>
