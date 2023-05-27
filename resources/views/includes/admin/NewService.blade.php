<div class="modal" id="service-modal">
    <div class="modal-body">
        <div class="modal-header">
            <h2 id="service-modal-title">Crear Nuevo Servicio</h2>
        </div>
        <hr>
        <div class="modal-content">
            <form method="post">
                @csrf
                <input type="hidden" name="" id="service_id">
                <div class="form-group">
                    <label for="">Nombre del Servicio</label>
                    <input type="text" name="service_name" id="service_name" class="form-control">
                    <center><span id="service_name-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Precio</label>
                    <input type="number" name="service_price" id="service_price" class="form-control" min="0" value="1">
                    <center><span id="service_email-error"></span></center>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="submit-button" id="update-service-button">Actualizar</button>
            <button class="submit-button" id="submit-service-button">Guardar</button>
            <button class="cancel-button" id="cancel-button">Cancelar</button>
        </div>
    </div>
</div>
