@extends('layouts.app')

@section('title', 'Expediente Académico')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Expediente Académico</h3>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
            <h4 class="mt-2">{{ $alumno->nombre }} {{ $alumno->apellido }} - NIE: {{ $alumno->nie }}</h4>
        </div>
        <div class="card-body">
            @foreach($matriculas as $año => $matriculasAño)
            <div class="mb-4 border-bottom pb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-primary mb-0">Año: {{ $año }}</h5>
                    @if($matriculasAño->first()->estado_general == 'Aprobado')
                        <span class="badge bg-success">APROBADO</span>
                    @elseif($matriculasAño->first()->estado_general == 'Reprobado')
                        <span class="badge bg-danger">REPROBADO</span>
                    @elseif($matriculasAño->first()->estado_general == 'Parcial')
                        <span class="badge bg-warning text-dark">PARCIAL</span>
                    @else
                        <span class="badge bg-secondary">SIN NOTAS</span>
                    @endif
                </div>
                
                <div class="row">
                    @foreach($matriculasAño->groupBy('grado') as $gradoId => $materias)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-header bg-light py-2 d-flex justify-content-between">
                                <div>
                                    <strong>Grado:</strong> {{ $materias->first()->gradoRelacion->nombre }}
                                </div>
                            </div>
                            <div class="card-body p-3">
                                @foreach($materias as $matricula)
                                <div class="mb-3">
                                    <h6 class="d-flex justify-content-between">
                                        <span>{{ $matricula->materiaRelacion->nombre }}</span>
                                        @if($matricula->notas->isNotEmpty())
                                            @php
                                                $ultimaNota = $matricula->notas->last();
                                                $estado = $ultimaNota->estado;
                                            @endphp
                                            <span class="badge {{ $estado == 'Aprobado' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $estado }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">SIN NOTAS</span>
                                        @endif
                                    </h6>
                                    
                                    @if($matricula->notas->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Trimestre</th>
                                                    <th>Nota 1</th>
                                                    <th>Nota 2</th>
                                                    <th>Nota 3</th>
                                                    <th>Promedio</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($matricula->notas as $nota)
                                                <tr>
                                                    <td>{{ $nota->trimestre }}</td>
                                                    <td>{{ $nota->actividad1 }}</td>
                                                    <td>{{ $nota->actividad2 }}</td>
                                                    <td>{{ $nota->actividad3 }}</td>
                                                    <td>{{ $nota->promedio }}</td>
                                                    <td>
                                                        <span class="badge {{ $nota->estado == 'Aprobado' ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $nota->estado }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection