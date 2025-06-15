
    <form action="/matriculas" method="POST" id="fmrSaveData">
        <div class="row">
            <div class="col-6">
                <label>Alumno</label>
                <select name="alumno" class="form-select">
                    <option value="">--Seleccionar Alumno--</option>
                    @foreach ($alumno as $item)
                        <option value="{{ $item->codigo }}">
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="alumno" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col-6">
                <label>Grado</label>
                <select name="grado" class="form-select">
                    <option value="">--Seleccionar grado--</option>
                    @foreach ($grado as $item)
                        <option value="{{ $item->codigo }}">
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="grado" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label>Materia</label>
                <select name="materia" class="form-select">
                    <option value="">--Seleccionar Materia--</option>
                    @foreach ($materia as $item)
                        <option value="{{ $item->codigo }}">
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="materia" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Año de Matricula</label>
                <input type="text" name="año_matricula" class="form-control">
                <span class="invalid-feedbanck d-block" key="año_matricula" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
        </div>
        <br>
        <div class="row text-center">
        <div class="col">
            <button type="submit" class="btn btn-lg btn-success">
                Guardar
            </button>
        </div>
        <div class="col">
            <button  type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal"> 
            Cancelar
            </button> 
        </div>
    </div>
    </form>
