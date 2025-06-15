
    <form action="/docentes/{{$docente->codigo}}" method="POST" id="fmrupdateData">
        <div class="row">
            <div class="col">
                <label>Nombre</label>
                <input type="text" name="nombre" value="{{ $docente->nombre }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="nombre" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Apellido</label>
                <input type="text" name="apellido" value="{{ $docente->apellido }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="apellido" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>DUI</label>
                <input type="text" name="dui"value="{{ $docente->dui }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="dui" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Correo</label>
                <input type="text" name="correo" value="{{ $docente->correo }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="correo" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>telefono</label>
                <input type="text" name="telefono"value="{{ $docente->telefono }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="telefono" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Especialidad</label>
                <input type="text" name="especialidad" value="{{ $docente->especialidad }}" class="form-control">
                <span class="invalid-feedbanck d-block" key="especialidad" role="alert">
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
