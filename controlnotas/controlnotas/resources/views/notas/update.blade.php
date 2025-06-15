
    <form action="/notas/{{$nota->codigo}}" method="POST" id="fmrupdateData">
        <div class="row">
            <div class="col-6">
                <label>Trimestre</label>
                <select name="trimestre" class="form-select">
                    <option value="">--Seleccionar Trimestre--</option>
                    @foreach ($trimestre as $item)
                        <option value="{{ $item->codigo }}" {{($item->codigo == $nota->trimestre)?'selected':''}}>
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="trimestre" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Matricula</label>
                <input type="text" name="alumno" value="{{ $nota->matricula }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="alumno" role="alert">
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
                        <option value="{{ $item->codigo }}" {{($item->codigo == $nota->matricula)?'selected':''}}>
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="materia" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col-6">
                <label>Grado</label>
                <select name="grado" class="form-select">
                    <option value="">--Seleccionar Grado--</option>
                    @foreach ($grado as $item)
                        <option value="{{ $item->codigo }}" {{($item->codigo == $nota->matricula)?'selected':''}}>
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
            <div class="col">
                <label>Nota 1</label>
                <input type="text" name="nota1" value="{{ $nota->actividad1 }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="nota1" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Nota 2</label>
                <input type="text" name="nota2" value="{{ $nota->actividad2 }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="nota2" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Nota 3</label>
                <input type="text" name="nota3" value="{{ $nota->actividad3 }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="nota3" role="alert">
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
