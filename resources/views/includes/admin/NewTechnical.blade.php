<div class="modal" id="technical-modal">
    <div class="modal-body">
        <div class="modal-header">
            <h2 id="technical-modal-title">Crear Nuevo Técnico</h2>
        </div>
        <hr>
        <div class="modal-content">
            <form method="post">
                @csrf
                <input type="hidden" name="" id="technical_id">
                <div class="form-group">
                    <label for="">Nombre Completo</label>
                    <input type="text" name="technical_name" id="technical_name" class="form-control">
                    <center><span id="technical_name-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Especialidad</label>
                    <select name="technical_specialty" id="technical_speciality" class="form-control">
                        <option value="Computadoras">Computadoras</option>
                        <option value="Laptops">Laptops</option>
                        <option value="Smart Watch">Smart Watch</option>
                        <option value="Telefonos">Teléfonos</option>
                        <option value="Tablets">Tablets</option>
                        <option value="General">General</option>
                    </select>
                    <center><span id="technical_speciality-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Numero Teléfono</label>
                    <input type="text" name="technical_phone" id="technical_phone" class="form-control">
                    <center><span id="technical_phone-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Correo Electrónico</label>
                    <input type="email" name="technical_email" id="technical_email" class="form-control">
                    <center><span id="technical_email-error"></span></center>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="submit-button" id="update-technical-button">Actualizar</button>
            <button class="submit-button" id="submit-technical-button">Guardar</button>
            <button class="cancel-button" id="cancel-button">Cancelar</button>
        </div>
    </div>
</div>
