<h1>Completar Reparación</h1>
<div class="complete-content">
    <div class="information-panel">
        <details>
            <summary style="cursor: pointer">> Agregar servicio</summary>
            <div class="services-form">
                <input type="hidden" name="" id="item_id_service">
                <input type="text" id='service_search' placeholder="Buscar servicio..." data-item autofocus class="form-control">
                <button id="add-servicer_table">Agregar</button>
            </div>
        </details>
        <div class="products-form">
            <input type="hidden" name="" id="item_id">
            <input type="text" id='product_search' placeholder="Buscar producto..." data-item autofocus class="form-control">
            <input type="number" placeholder="Cantidad" id="quantity" min="1" value="1">
        </div>
        <br>
        <hr>
        <br>
        <h3>Información de la reparación:</h3>
        <input type="hidden" id="repair_id" value="{{$repair->id}}">
        <p><b>Nombre del cliente:</b> {{$repair->client_name}}</p>
        <p><b>Correo del cliente:</b> {{$repair->client_email}}</p>
        <p><b>Telefono del cliente:</b> {{$repair->client_phone}}</p>
        <p><b>Dispositivo:</b> {{$repair->device}}</p>
        <p><b>Servicio Requerido:</b> {{$service[0]->name}}</p>
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
                <tr data-product_id="{{$service[0]->name}}" data-type='service'>
                    <td>1</td>
                    <td>{{$service[0]->name}}</td>
                    <td>{{$service[0]->price}}</td>
                    <td>{{$service[0]->price}}</td>
                </tr>
            </tbody>
        </table>
        <h3>Subtotal: <span id="subtotal">{{$service[0]->price}} Lps</span></h3>
        <h3>ISV 15%: <span id="isv">{{$service[0]->price * 0.15}} Lps</span></h3>
        <h3>Total: <span id="total">{{$service[0]->price + ($service[0]->price * 0.15)}} Lps</span></h3>
    </div>
</div>
<button class="submit-button" id="complete_repair">Completar</button>
<button class="cancel-button" id="cancel_complete_repair">Regresar</button>
<script src="{{ asset('js/admin/repairs.function.js') }}"></script>