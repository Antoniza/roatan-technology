<body>
    <div class="header-repairs">
        <h1>Reparaciones</h1>
        <a id="newRepairButton"><button> <span><i class="fa-solid fa-screwdriver-wrench"></i></span> Nueva
                Reparación</button></a>
    </div>
    <hr>
    <div class="table-container">
        <h3>Lista de Reparaciones</h3>
        <table id="repairs-table" class="hover stripe row-border" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Cliente</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repairs as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="/get-repair/{{ $item->id }}" class="get-repair">{{ $item->repair_code }} <i class="fa-solid fa-eye"></i></a></td>
                        <td>{{ $item->client_name }}</td>
                        <td>{{ $item->client_email }}</td>
                        <td>{{ $item->client_phone }} <a title="Click para chatear" class="whatsapp_button" href="https://api.whatsapp.com/send?phone={{$item->client_phone}}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i></a></td>
                        <td
                            style=" background-color: rgba(0,0,0,0.7); @if ($item->status == 'Pendiente') color: yellow @elseif($item->status == 'Finalizado') color: blue @elseif($item->status == 'Terminado') color: green @else color: red @endif">
                            {{ $item->status }}</td>
                        @if ($item->status == 'Pendiente')
                            <td>---</td>
                        @else
                            <td>{{ $item->total }} Lps</td>
                        @endif
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @if ($item->status == 'Pendiente')
                                <button class="submit-button complete_repair" data-id="{{ $item->id }}"
                                    title="Finalizar">
                                    <i class="fa-solid fa-check"></i></button>
                                <button class="cancel-button cancel_repair" data-id="{{ $item->id }}"
                                    title="Cancelar" data-token="{{ csrf_token() }}"><i
                                        class="fa-solid fa-ban"></i></button>
                            @elseif ($item->status == 'Finalizado')
                                <button class="submit-button finish_repair" data-id="{{ $item->id }}"
                                    title="Terminar" data-token="{{ csrf_token() }}"><i
                                        class="fa-solid fa-check"></i></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{ asset('js/admin/repairs.function.js') }}"></script>
<script>
    $('#repairs-table').DataTable({
        dom: 'Bfrtip',
        columnDefs: [{
            target: 0,
            visible: false,
        },{
            target: 3,
            visible: false,
        }, ],
        buttons: [{
                extend: 'colvis',
                text: 'Columnas',
                columns: ':not(.noVis)'
            },
            {
                extend: 'excel',
                text: '<i class="fa-solid fa-file-excel"></i> Excel',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'print',
                text: '<i class="fa-solid fa-print"></i> Imprimir',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'Roatán Technology - Tecnicos',
                footer: 'false',
                customize: function(win) {
                    $(win.document.body).find('h1').remove();

                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            `
                            <div style="width:100%; height: auto; padding-bottom: 2rem; display: flex; justify-content: flex-start; aling-items: center; flex-direction: row;">
                                <div style="width: 40%; height: 100%">
                                    <img src="{{ asset('images/logo_roatan.png') }}" style="width: 60%" />
                                </div>
                                <div style="width: 60%; margin-top: 5%;">
                                    <h2>Lista de Clientes</h2>
                                </div>
                            </div>

                            `,
                            '<img src="{{ asset('images/logo_roatan.png') }}" style="opacity: 0.3; position: absolute; top: 0; left: 0; right: 0; bottom: 0; margin: auto; width: 80%" />'
                        );

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ],
        language: {
            processing: "Tratamiento en proceso...",
            search: "<i class='fa-solid fa-magnifying-glass'></i> Buscar",
            lengthMenu: "Mostrar _MENU_ registros por pagina",
            info: "Mostrando del registro _START_ al _END_ de _TOTAL_ registros",
            infoEmpty: "0 de 0 registros",
            infoFiltered: "(Filtro de _MAX_ registros en total)",
            infoPostFix: "",
            loadingRecords: "Cargando registros...",
            zeroRecords: "No hay registros que cargar",
            emptyTable: "No hay datos disponibles en la tabla",
            paginate: {
                first: "Primero",
                previous: "Previo",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": Activar orden ascendente",
                sortDescending: ": Activar orden descendente"
            }
        }
    });
</script>
