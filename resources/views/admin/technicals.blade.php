<body>
    <div class="header-technical">
        <h1>Sección de Técnicos</h1>
    </div>
    <hr>
    <div class="table-container">
        <h3>Lista de técnicos</h3>
        <table id="technicals-table" class="hover stripe row-border" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technicals as $item)
                    <tr>
                        <tb>{{$item->id}}</tb>
                        <tb>{{$item->name}}</tb>
                        <tb>{{$item->email}}</tb>
                        <tb>{{$item->phone}}</tb>
                        <tb>edit | delete</tb>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{asset('js/admin/technicals.function.js')}}"></script>
<script>
    $('#technicals-table').DataTable({
        language: {
            processing:     "Tratamiento en proceso...",
            search:         "Buscar",
            lengthMenu:     "Mostrar _MENU_ registros por pagina",
            info:           "Mostrando del registro _START_ al _END_ de _TOTAL_ registros",
            infoEmpty:      "0 de 0 registros",
            infoFiltered:   "(Filtro de _MAX_ registros en total)",
            infoPostFix:    "",
            loadingRecords: "Cargando registros...",
            zeroRecords:    "No hay registros que cargar",
            emptyTable:     "No hay datos disponibles en la tabla",
            paginate: {
                first:      "Primero",
                previous:   "Previo",
                next:       "Siguiente",
                last:       "Ultimo"
            },
            aria: {
                sortAscending:  ": Activar orden ascendente",
                sortDescending: ": Activar orden descendente"
            }
        }
    });
</script>