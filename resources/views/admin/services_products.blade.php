<body>
    <div class="header-products_services">
        <h1>Sección de Productos y Servicios</h1>
        <div>
            <a id="newProductButton"><button> <span><i class="fa-solid fa-box"></i></span> Nuevo Producto</button></a>
            <a id="newServiceButton"><button> <span><i class="fa-solid fa-file-contract"></i></span> Nuevo Servicio</button></a>
        </div>
    </div>
    <hr>
    <div class="summary-container">
        <span id="summary-btn_p">Tabla de Productos <span class="drop-icon"><i class="fa-solid fa-chevron-up"></i></span></span>
    </div>
    <div id="summary_p" class="show">
        <div class="table-container">
            <h3>Lista de Productos</h3>
            <table id="products-table" class="hover stripe row-border" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <tb>{{$item->id}}</tb>
                            <tb>{{$item->name}}</tb>
                            <tb>{{$item->price}}</tb>
                            <tb>{{$item->quantity}}</tb>
                            <tb>edit | delete</tb>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="summary-container">
        <span id="summary-btn_s">Tabla de Servicios <span class="drop-icon"><i class="fa-solid fa-chevron-up"></i></span></span>
    </div>
    <div id="summary_s">
        <div class="table-container">
            <h3>Lista de Servicios</h3>
            <table id="services-table" class="hover stripe row-border" style="width:100%">
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
                    @foreach ($services as $item)
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
    </div>
</body>
<script src="{{asset('js/admin/products_services.function.js')}}"></script>
<script>
    $('#services-table').DataTable({
        dom: 'Bfrtip',
        columnDefs: [{
                target: 0,
                visible: false,
            },
        ],
        buttons: [{
                extend: 'colvis',
                text: 'Columnas',
                columns: ':not(.noVis)'
            },
            {
                extend: 'excel',
                text: '<i class="fa-solid fa-file-excel"></i> Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }, {
                extend: 'print',
                text: '<i class="fa-solid fa-print"></i> Imprimir',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'Roatán Technology - Servicios',
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
                                    <h2>Lista de Servicios</h2>
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
            emptyTable: "No hay datos disponibles en la tabla s",
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

    $('#products-table').DataTable({
        dom: 'Bfrtip',
        columnDefs: [{
                target: 0,
                visible: false,
            },
        ],
        buttons: [{
                extend: 'colvis',
                text: 'Columnas',
                columns: ':not(.noVis)'
            },
            {
                extend: 'excel',
                text: '<i class="fa-solid fa-file-excel"></i> Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }, {
                extend: 'print',
                text: '<i class="fa-solid fa-print"></i> Imprimir',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'Roatán Technology - Productos',
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
                                    <h2>Lista de Productos</h2>
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
            emptyTable: "No hay datos disponibles en la tabla p",
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