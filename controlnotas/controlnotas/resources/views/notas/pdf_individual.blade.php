<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boleta de Notas Individual</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .aprobado {
            color: green;
            font-weight: bold;
        }
        .reprobado {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Boleta de Notas Individual</h1>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Trimestre</th>
                <th>Año</th>
                <th>Alumno</th>
                <th>Materia</th>
                <th>Grado</th>
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota 3</th>
                <th>Promedio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $nota->codigo }}</td>
                <td>{{ $nota->trimestre_nombre }}</td>
                <td>{{ $nota->año }}</td>
                <td>{{ $nota->nombre_alumno }}</td>
                <td>{{ $nota->nombre_materia }}</td>
                <td>{{ $nota->grado_nombre }}</td>
                <td>{{ $nota->actividad1_aproximada }}</td>
                <td>{{ $nota->actividad2_aproximada }}</td>
                <td>{{ $nota->actividad3_aproximada }}</td>
                <td>{{ $nota->promedio }}</td>
                <td class="{{ strtolower($nota->estado) }}">{{ $nota->estado }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>