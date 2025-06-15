<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boleta de Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; 
            margin: 0;
            padding: 0;
        }
        .page {
            width: 100%;
            height: 100vh; 
            padding: 15px;
            box-sizing: border-box;
            page-break-after: always; 
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }
        th, td {
            border: 1px solid black;
            padding: 3px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .aprobado {
            color: green;
            font-weight: bold;
        }
        .reprobado {
            color: red;
            font-weight: bold;
        }
        .trimestre-header {
            background-color: #e0e0e0;
            padding: 4px;
            margin: 8px 0 4px 0;
            font-weight: bold;
            font-size: 11px;
        }
        .student-info {
            margin-bottom: 8px;
            padding: 5px;
            background-color: #f5f5f5;
            border-radius: 3px;
        }
        .student-info h3 {
            margin: 0 0 3px 0;
            font-size: 12px;
        }
        .student-info p {
            margin: 0;
        }
        .resumen-table {
            margin-top: 10px;
            width: 60%;
            margin-left: auto;
            margin-right: auto;
        }
        .global-promedio {
            font-size: 11px;
            font-weight: bold;
            margin-top: 8px;
            text-align: center;
            position: absolute;
            bottom: 15px;
            left: 0;
            right: 0;
        }
        .compact-row td {
            padding: 2px;
        }
    </style>
</head>
<body>
    @php
        // Agrupar notas por alumno y trimestre
        $notasAgrupadas = [];
        foreach ($nota as $item) {
            $alumnoKey = $item->nombre_alumno;
            $trimestreKey = $item->trimestre_nombre;
            
            if (!isset($notasAgrupadas[$alumnoKey])) {
                $notasAgrupadas[$alumnoKey] = [
                    'info' => [
                        'año' => $item->año,
                        'promedios_trimestres' => [],
                        'promedio_global' => 0,
                        'estado_global' => ''
                    ],
                    'trimestres' => []
                ];
            }
            
            if (!isset($notasAgrupadas[$alumnoKey]['trimestres'][$trimestreKey])) {
                $notasAgrupadas[$alumnoKey]['trimestres'][$trimestreKey] = [
                    'notas' => [],
                    'promedio_trimestre' => 0,
                    'materias_count' => 0
                ];
            }
            
            $notasAgrupadas[$alumnoKey]['trimestres'][$trimestreKey]['notas'][] = $item;
            $notasAgrupadas[$alumnoKey]['trimestres'][$trimestreKey]['materias_count']++;
        }

        // Calcular promedios (igual que antes)
        foreach ($notasAgrupadas as &$alumnoData) {
            $suma_global = 0;
            $trimestres_count = 0;
            
            foreach ($alumnoData['trimestres'] as $trimestre => &$trimestreData) {
                $suma_trimestre = 0;
                $materias_count = 0;
                
                foreach ($trimestreData['notas'] as $nota) {
                    $suma_trimestre += $nota->promedio;
                    $materias_count++;
                }
                
                $promedio_trimestre = $materias_count > 0 ? $suma_trimestre / $materias_count : 0;
                $trimestreData['promedio_trimestre'] = round($promedio_trimestre, 2);
                $alumnoData['info']['promedios_trimestres'][$trimestre] = $trimestreData['promedio_trimestre'];
                
                $suma_global += $promedio_trimestre;
                $trimestres_count++;
            }
            
            $promedio_global = $trimestres_count > 0 ? $suma_global / $trimestres_count : 0;
            $alumnoData['info']['promedio_global'] = round($promedio_global, 2);
            $alumnoData['info']['estado_global'] = $promedio_global >= 6 ? 'Aprobado' : 'Reprobado';
        }
    @endphp

    @foreach($notasAgrupadas as $alumno => $alumnoData)
        <div class="page">
            <div class="header">
                <h2>Boleta de Notas</h2>
            </div>

            <div class="student-info">
                <h3>Alumno: {{ $alumno }}</h3>
                <p>Año Académico: {{ $alumnoData['info']['año'] ?? '' }}</p>
            </div>

            @foreach($alumnoData['trimestres'] as $trimestre => $trimestreData)
                <div class="trimestre-header">
                    Trimestre: {{ $trimestre }} (Promedio: {{ $trimestreData['promedio_trimestre'] }})
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th width="30%">Materia</th>
                            <th width="15%">Grado</th>
                            <th width="10%">N1</th>
                            <th width="10%">N2</th>
                            <th width="10%">N3</th>
                            <th width="15%">Promedio</th>
                            <th width="10%">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trimestreData['notas'] as $item)
                            <tr class="compact-row">
                                <td>{{ $item->nombre_materia }}</td>
                                <td>{{ $item->grado_nombre }}</td>
                                <td>{{ $item->actividad1_aproximada }}</td>
                                <td>{{ $item->actividad2_aproximada }}</td>
                                <td>{{ $item->actividad3_aproximada }}</td>
                                <td>{{ $item->promedio }}</td>
                                <td class="{{ strtolower($item->estado) }}">{{ $item->estado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            <!-- Resumen final -->
            <table class="resumen-table">
                <thead>
                    <tr>
                        <th colspan="3">Resumen Académico</th>
                    </tr>
                    <tr>
                        <th>Trimestre</th>
                        <th>Promedio</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnoData['info']['promedios_trimestres'] as $trimestre => $promedio)
                        <tr>
                            <td>{{ $trimestre }}</td>
                            <td>{{ $promedio }}</td>
                            <td class="{{ $promedio >= 6 ? 'aprobado' : 'reprobado' }}">
                                {{ $promedio >= 6 ? 'Aprobado' : 'Reprobado' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="global-promedio">
                PROMEDIO FINAL: {{ $alumnoData['info']['promedio_global'] }} - 
                <span class="{{ strtolower($alumnoData['info']['estado_global']) }}">
                    {{ $alumnoData['info']['estado_global'] }}
                </span>
            </div>
        </div>
    @endforeach
</body>
</html>