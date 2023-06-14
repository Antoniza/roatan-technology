<h1>Información de Reparación</h1>
<div class="complete-content">
    <div class="information-panel">
        <h3>Detalles:</h3>
        <p><b>Estado:</b> <span style="@if ($repair->status == 'Pendiente') color: yellow @elseif($repair->status == 'Finalizado') color: blue @elseif($repair->status == 'Terminado') color: green @else color: red @endif">{{ $repair->status }}</span></p>
        <p><b>Nombre del cliente:</b> {{ $repair->client_name }}</p>
        <p><b>Correo del cliente:</b> {{ $repair->client_email }}</p>
        <p><b>Telefono del cliente:</b> {{ $repair->client_phone }}</p>
        <p><b>Dispositivo:</b> {{ $repair->device }}</p>
        <p><b>Servicio Requerido:</b> {{ $service->name }}</p>
        <p><b>Observaciones:</b> <br>{{ $repair->observations }}</p>
        <p><b>Recomendacion:</b> <br>{{ $repair->recomendation }}</p>
    </div>
    <div class="products-panel">
        <table class="dataTables_wrapper" id="product-list">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @if (empty($details))
                @else
                @foreach ($details as $item)
                        <tr>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->total }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <h3>Subtotal: <span id="subtotal">{{ $repair->total }} Lps</span></h3>
        <h3>ISV 15%: <span id="isv">{{ $repair->total * 0.15 }} Lps</span></h3>
        <h3>Total: <span id="total">{{ $repair->total + $repair->total * 0.15 }} Lps</span></h3>
    </div>
</div>
<button class="cancel-button" id="cancel_complete_repair">Regresar</button>
<script src="{{ asset('js/admin/repairs.function.js') }}"></script>
