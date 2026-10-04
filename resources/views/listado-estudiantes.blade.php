<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estudiantes registrados</title>

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
        }

        .encabezado {
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            padding: 18px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            width: 130px;
            height: auto;
        }
        .contenedor {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 35px 25px;
        }

        .titulo {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitulo {
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .tarjeta {
            background: #ffffff;
            border-radius: 4px;
            border: 1px solid #e5e5e5;
            overflow: hidden;
        }

        .barra {
            padding: 18px 20px;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .cantidad {
            font-size: 14px;
            color: #666;
        }

        .buscador {
            width: 260px;
            border: 1px solid #d5d5d5;
            padding: 9px 12px;
            font-size: 13px;
            outline: none;
        }

        .buscador:focus {
            border-color: #00a878;
        }

        .tabla-contenedor {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        thead {
            background: #f8f8f8;
        }

        th {
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            padding: 14px 18px;
            border-bottom: 1px solid #e5e5e5;
        }

        td {
            font-size: 13px;
            color: #555;
            padding: 14px 18px;
            border-bottom: 1px solid #eeeeee;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        @media (max-width: 700px) {
            .encabezado {
                padding: 15px 20px;
            }

            .contenedor {
                padding: 25px 15px;
            }

            .titulo {
                font-size: 22px;
            }

            .barra {
                align-items: stretch;
                flex-direction: column;
            }

            .buscador {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <header class="encabezado">

        <img
            src="{{ asset('images/logo-examen-beca.png') }}"
            alt="Examen de Beca Bachiller"
            class="logo"
        >

    </header>

    <main class="contenedor">

        <h1 class="titulo">
            Estudiantes registrados
        </h1>

        <p class="subtitulo">
            Listado de estudiantes que registraron su carrera de interés.
        </p>

        <section class="tarjeta">

            <div class="barra">

                <span class="cantidad">
                    Estudiantes registrados
                </span>

                <input
                    type="text"
                    class="buscador"
                    placeholder="Buscar estudiante..."
                >

            </div>

            <div class="tabla-contenedor">

                <table>

                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Carrera</th>
                            <th>Fecha de registro</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Ejemplo Estudiante</td>
                            <td>Ingeniería de Sistemas</td>
                            <td>03/10/2026</td>
                        </tr>

                        <tr>
                            <td>Ejemplo Estudiante 2</td>
                            <td>Ingeniería Comercial</td>
                            <td>03/10/2026</td>
                        </tr>

                        <tr>
                            <td>Ejemplo Estudiante 3</td>
                            <td>Psicología</td>
                            <td>03/10/2026</td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</body>
</html>
