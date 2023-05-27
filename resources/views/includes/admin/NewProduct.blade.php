<div class="modal" id="product-modal">
    <div class="modal-body">
        <div class="modal-header">
            <h2 id="product-modal-title">Crear Nuevo Producto</h2>
        </div>
        <hr>
        <div class="modal-content">
            <form method="post">
                @csrf
                <input type="hidden" name="" id="product_id">
                <div class="form-group">
                    <label for="">Nombre del Producto</label>
                    <input type="text" name="product_name" id="product_name" class="form-control">
                    <center><span id="product_name-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="number" name="product_quantity" id="product_quantity" class="form-control" min="1">
                    <center><span id="product_phone-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Precio</label>
                    <input type="number" name="product_price" id="product_price" class="form-control" min="0">
                    <center><span id="product_email-error"></span></center>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="submit-button" id="update-product-button">Actualizar</button>
            <button class="submit-button" id="submit-product-button">Guardar</button>
            <button class="cancel-button" id="cancel-button">Cancelar</button>
        </div>
    </div>
</div>
