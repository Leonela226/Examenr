<section>
    <h2>
        Listado de Vehiculos de Flota
    </h2>
</section>
<section>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Kilometraje</th>
            <th>Estado</th>
            <th>Asignado</th>
            <th>Procesos</th>
        </tr>
        </thead>
        <tbody>
        {{foreach vehiculo}}
        <tr>
            <td>{{id_vehiculo}}</td>
            <td><a href="index.php?page=Examen_VehiculoForm&mode=DSP&id={{id_vehiculo}}">{{marca}}</a></td>
            <td>{{modelo}}</td>
            <td>{{anio}}</td>
            <td>{{kilometraje}}</td>
            <td>{{id_estado}}</td>
            <td>{{asignado}}</td>

            <td>
                {{if ~canActions}}
                <a href="index.php?page=Examen_VehiculoForm&mode=INS">Nuevo</a> --
                <a href="index.php?page=Examen_VehiculoForm&mode=UPD&id={{id_vehiculo}}">Editar</a> --
                <a href="index.php?page=Examen_VehiculoForm&mode=DEL&id={{id_vehiculo}}">Eliminar</a>
                {{endif ~canActions}}
                {{ifnot ~canActions}}
                    No necesita realizar acciones.
                {{endifnot ~canActions}}
            </td>
        </tr>
        {{endfor vehiculo}}
        </tbody>
    </table>
</section>