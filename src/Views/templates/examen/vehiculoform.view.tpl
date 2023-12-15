<h2>{{modedsc}}</h2>

{{with vehiculo}}
<form action="index.php?page=Examen_VehiculoForm&mode={{~mode}}&id={{id_vehiculo}}" method="POST">
    <label for="id_vehiculo">ID</label>
    <input type="text" name="id_vehiculo" id="id_vehiculo" value="{{id_vehiculo}}" readonly>
    <br>

    <label for="marca">Marca del vehiculo</label>
    <input type="text" id="marca" name="marca" placeholder="marca del vehiculo"
           value="{{marca}}" {{~readonly}}/>
    {{if marca_error}}<div class="error">{{marca_error}}</div>{{endif marca_error}}
    <br>

    <label for="modelo">Modelo  del vehiculo</label>
    <input type="text" id="modelo" name="modelo" placeholder="Modelo del vehiculo"
           value="{{modelo}}" {{~readonly}}/>
    {{if modelo_error}}<div class="error">{{modelo_error}}</div>{{endif modelo_error}}
    <br>

    <label for="anio">Año del vehiculo</label>
    <input type="text" id="anio" name="anio" placeholder="Año del vehiculo"
           value="{{anio}}" {{~readonly}}/>
    {{if anio_error}}<div class="error">{{anio_error}}</div>{{endif anio_error}}
    <br>

       <label  for="id_estado">Estado</label>
      <select name="id_estado" id="id_estado" >
        <option value="1" {{id_estado_buenestado}}>Buen Estado</option>
        <option value="2" {{id_estado_necesitareparaciones}}>Necesita reparaciones</option>
      </select>
    {{if id_estado_error}}<div class="error">{{id_estado_error}}</div>{{endif id_estado_error}}

<br>
    <br>
    <label for="kilometraje">Kilometraje del vehiculo</label>
    <input type="text" id="kilometraje" name="kilometraje" placeholder="kilometraje del Vehiculo"
           value="{{kilometraje}}" {{~readonly}}/>
    {{if kilometraje_error}}<div class="error">{{kilometraje_error}}</div>{{endif kilometraje_error}}
    <br>

    <label for="asignado">Asignado del vehiculo</label>
    <input type="text" id="asignado" name="asignado" placeholder="asignado del Vehiculo"
           value="{{asignado}}" {{~readonly}}/>
    {{if asignado_error}}<div class="error">{{asignado_error}}</div>{{endif asignado_error}}
    <br>

    {{if ~showConfirm}}
    <button type="submit" name="btnConfirm">Procesar</button>
    {{endif ~showConfirm}}
    <button id="btnCancel">Cancelar</button>
</form>
{{endwith vehiculo}}
<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCancel").addEventListener("click", (e)=>{
            e.preventDefault();
            e.stopPropagation();
            document.location.assign("index.php?page=Examen_VehiculoList");
        });
    });
</script>