
    <form action="/alumnos" method="POST" id="fmrSaveData">
        <div class="row">
            <div class="col">
                <label>NIE</label>
                <input type="text" name="nie" class="form-control">
                <span class="invalid-feedbanck d-block" key="nie" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control">
                <span class="invalid-feedbanck d-block" key="nombre" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Apellido</label>
                <input type="text" name="apellido" class="form-control">
                <span class="invalid-feedbanck d-block" key="apellido" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Correo</label>
                <input type="text" name="correo" class="form-control">
                <span class="invalid-feedbanck d-block" key="correo" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>imagen</label>
                <input type="text" name="imagen" class="form-control">
                <span class="invalid-feedbanck d-block" key="imagen" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
            <div class="col">
                <label>Fecha de naciemiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control">
                <span class="invalid-feedbanck d-block" key="fecha_nacimiento" role="alert">
                    <strong class="mensaje"></strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label>Encargado</label>
                <select name="encargado" class="form-select">
                    <option value="">--Seleccionar Encargado--</option>
                    @foreach ($encargado as $item)
                        <option value="{{ $item->codigo }}">
                            {{ $item->nombre }} {{ $item->apellido }} {{ $item->dui }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid-feedbanck d-block" key="encargado" role="alert">
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
