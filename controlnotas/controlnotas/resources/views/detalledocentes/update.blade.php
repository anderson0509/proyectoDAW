
    <form action="/detalledocentes/{{$detalle_docente->codigo}}" method="POST" id="fmrupdateData">
        <div class="row">
            <div class="col-6">
                <label>Docente</label>
                <select name="docente" class="form-select">
                    <option value="">--Seleccionar docente--</option>
                    @foreach ($docente as $item)
                        <option value="{{ $item->codigo }}" {{($item->codigo == $detalle_docente->docente)?'selected':''}}>
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="docente" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col-6">
                <label>Grado</label>
                <select name="grado" class="form-select">
                    <option value="">--Seleccionar grado--</option>
                    @foreach ($grado as $item)
                        <option  value="{{ $item->codigo }}" {{($item->codigo == $detalle_docente->grado)?'selected':''}}>
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="grado" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col-6">
                <label>Materia</label>
                <select name="materia" class="form-select">
                    <option value="">--Seleccionar Materia--</option>
                    @foreach ($materia as $item)
                        <option  value="{{ $item->codigo }}" {{($item->codigo == $detalle_docente->materia)?'selected':''}}>
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="materia" role="alert">
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
