@extends('layouts.app')

@section('title', 'Asistencias por Grado')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Registro de Asistencias por Grado</h1>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>

        @foreach($datosGrados as $datos)
            <div class="card mb-4 shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Grado: {{ $datos['grado']->nombre }}</h3>
                        <div>
                            <input type="date" class="form-control d-inline-block w-auto" 
                                    id="fecha-seleccionada-{{ $datos['grado']->codigo }}" 
                                    value="{{ $datos['fecha_actual'] }}"
                                    onchange="cambiarFecha('{{ $datos['grado']->codigo }}')">
                            <small class="text-white-50 ms-2">Fecha seleccionada</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form-asistencia-{{ $datos['grado']->codigo }}" method="POST" 
                            action="{{ route('asistencias.guardar') }}">
                        @csrf
                        <input type="hidden" name="grado_id" value="{{ $datos['grado']->codigo }}">
                        <input type="hidden" name="fecha" id="fecha-{{ $datos['grado']->codigo }}" 
                                value="{{ $datos['fecha_actual'] }}">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Código</th>
                                        <th rowspan="2">Nombre del Alumno</th>
                                        <th colspan="{{ count($datos['dias_semana']) }}" class="text-center">Días de la Semana</th>
                                    </tr>
                                    <tr>
                                        @foreach($datos['dias_semana'] as $dia)
                                            <th class="text-center">{{ $dia }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($datos['alumnos'] as $alumno)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $alumno['info']->codigo }}</td>
                                        <td>{{ $alumno['info']->nombre }}</td>
                                        @foreach($datos['dias_semana'] as $dia)
                                            <td class="text-center">
                                                <input type="hidden" name="alumnos[{{ $alumno['info']->codigo }}][matriculas]" 
                                                        value="{{ json_encode($alumno['matriculas_ids']) }}">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input asistencia-check" 
                                                            type="checkbox" 
                                                            name="alumnos[{{ $alumno['info']->codigo }}][dias][]" 
                                                            id="asistencia-{{ $alumno['info']->codigo }}-{{ $dia }}"
                                                            value="1"
                                                            {{ $alumno['asistencias'][$dia] ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="asistencia-{{ $alumno['info']->codigo }}-{{ $dia }}">
                                                        @if($alumno['asistencias'][$dia])
                                                            <i class="fas fa-check text-success"></i>
                                                        @else
                                                            <i class="fas fa-times text-danger"></i>
                                                        @endif
                                                    </label>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Asistencias
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    @section('scripts')
    <script>
        function cambiarFecha(gradoId) {
            const fechaInput = document.getElementById(`fecha-seleccionada-${gradoId}`);
            const nuevaFecha = fechaInput.value;
            
            // Redirigir con la nueva fecha como parámetro
            window.location.href = `${window.location.pathname}?fecha=${nuevaFecha}`;
        }

        // Cambiar iconos al marcar/desmarcar checkboxes
        document.querySelectorAll('.asistencia-check').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const icon = this.nextElementSibling.querySelector('i');
                if (this.checked) {
                    icon.classList.remove('fa-times', 'text-danger');
                    icon.classList.add('fa-check', 'text-success');
                } else {
                    icon.classList.remove('fa-check', 'text-success');
                    icon.classList.add('fa-times', 'text-danger');
                }
            });
        });
    </script>
    @endsection
@endsection