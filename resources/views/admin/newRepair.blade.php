<body>
    <div class="new_repair">
        <form method="post">
            @csrf
            <input type="hidden" name="" id="repair_id">
            <div class="form-group">
                <label for="">Nombre del cliente</label>
                <input type="text" name="client_name" id="client_name" class="form-control">
                <center><span id="repair_name-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">Correo del cliente</label>
                <input type="email" name="client_email" id="client_email" class="form-control" min="1">
                <center><span id="repair_email-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">Telefono del cliente</label>
                <input type="text" name="client_phone" id="client_phone" class="form-control" min="1">
                <center><span id="repair_phone-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">Informacion del dispositivo</label>
                <input type="text" name="client_device" id="client_device" class="form-control" min="1">
                <center><span id="repair_quantity-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">Servicio requerido</label>
                <select name="" id="repair_service">
                    @foreach ($services as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <center><span id="repair_service-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">Tecnico</label>
                <select name="" id="repair_technical">
                    @foreach ($technicals as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->speciality }}</option>
                    @endforeach
                </select>
                <center><span id="repair_technical-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">Observaciones</label>
                <textarea name="" id="observations" cols="30" rows="5"></textarea>
                <center><span id="repair_quantity-error"></span></center>
            </div>
        </form>
        <button class="submit-button" id="submit-repair-button">Guardar</button>
    </div>
    <script src="{{ asset('js/admin/repairs.function.js') }}"></script>
</body>
