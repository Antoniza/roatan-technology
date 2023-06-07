<body>
    <h1>Configuración</h1>
    <div class="themes-container">
        <h3>Temas</h3>
        <div class="theme-container">
            <div class="theme-card" id="light-theme">
                <span>Light</span>
            </div>

            <div class="theme-card" id="dark-theme">
                <span>Night</span>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="user-container">
        <h3>Información de usuario</h3>
        <div class="user-container">
            <div>
                <span>Nombre de usuario:</span>
                <input type="text" id="user_name" value="{{Auth::user()->name}}">
            </div>

            <div>
                <span>Correo:</span>
                <input type="text" id="user_email" value="{{Auth::user()->email}}">
            </div>

            <div>
                <span>Telefono:</span>
                <input type="text" id="user_phone" value="{{Auth::user()->phone}}">
            </div>

            <div>
                <span></span>
                <button class="submit-button" id="update_profile" data-token="{{ csrf_token() }}">Actualizar</button>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="user-container">
        <h3>Cambio de contraseña</h3>
        <div class="user-container">
            <div>
                <span>Contraseña actual:</span>
                <span class="update_password">
                    <input type="password" id="current_password">
                    <span id="hide_current_password"><i class="fa-regular fa-eye"></i></span>
                    <span id="show_current_password"><i class="fa-solid fa-eye-slash"></i></span>
                </span>
            </div>

            <div>
                <span>Nueva contraseña:</span>
                <span class="update_password">
                    <input type="password" id="new_password">
                    <span id="hide_new_password"><i class="fa-regular fa-eye"></i></span>
                    <span id="show_new_password"><i class="fa-solid fa-eye-slash"></i></span>
                </span>
            </div>

            <div>
                <span>Confirmar contraseña:</span>
                <span class="update_password">
                    <input type="password" id="confirm_password">
                    <span id="hide_confirm_password"><i class="fa-regular fa-eye"></i></span>
                    <span id="show_confirm_password"><i class="fa-solid fa-eye-slash"></i></span>
                </span>
            </div>

            <div>
                <span></span>
                <button class="submit-button" id="update_password" data-token="{{ csrf_token() }}">Actualizar</button>
            </div>
        </div>
    </div>
</body>
<script src="{{asset('js/admin/settings.function.js')}}"></script>