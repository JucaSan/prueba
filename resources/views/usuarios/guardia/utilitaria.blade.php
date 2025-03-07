<x-app-layout>
    <x-slot name="header">
        <h2 class="header__title">
            {{ __('Registrar salida de unidad utilitaria') }}
        </h2>
    </x-slot>

    <div class="form-utilitaria">
        <form method="POST" action="{{ route('login') }}" class="form-unidades" enctype="multipart/form-data">
            @csrf

            <!-- Título del formulario -->
            <h2 class="form-unidades__title">{{ __('Registro de salida de unidades utilitarias') }}</h2>

            <!-- Contenedor de dos columnas -->
            <div class="form-unidades__columns">
                <!-- Columna izquierda -->
                <div class="form-unidades__column">
                    <!-- Fecha de salida (automática) -->
                    <div class="form-group">
                        <label for="fecha_salida" class="form-group__label">{{ __('Fecha de salida') }}</label>
                        <input id="fecha_salida" class="form-group__input" type="date" name="fecha_salida" required readonly />
                    </div>

                    <!-- Hora de salida (automática y en tiempo real) -->
                    <div class="form-group">
                        <label for="hora_salida" class="form-group__label">{{ __('Hora de salida') }}</label>
                        <input id="hora_salida" class="form-group__input" type="text" name="hora_salida" required readonly />
                    </div>

                    <!-- Unidad -->
                    <div class="form-group">
                        <label for="unidad" class="form-group__label">{{ __('Unidad') }}</label>
                        <input id="unidad" class="form-group__input" type="text" name="unidad" required placeholder="Número de unidad" />
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="form-unidades__column">


                    <!-- Se dirige -->
                    <div class="form-group">
                        <label for="se_dirige" class="form-group__label">{{ __('Se dirige') }}</label>
                        <input id="se_dirige" class="form-group__input" type="text" name="se_dirige" required placeholder="Destino" />
                    </div>

                    <!-- Conductor -->
                    <div class="form-group">
                        <label for="conductor" class="form-group__label">{{ __('Conductor') }}</label>
                        <input id="conductor" class="form-group__input" type="text" name="conductor" required placeholder="Nombre del conductor" />
                    </div>

                    <!-- Guardia en turno -->
                    <div class="form-group">
                        <label for="guardia_turno" class="form-group__label">{{ __('Guardia en turno') }}</label>
                        <input id="guardia_turno" class="form-group__input" type="text" name="guardia_turno" required placeholder="Nombre del guardia" />
                    </div>
                </div>
            </div>

            <!-- Fotografía de la unidad (múltiples imágenes, máximo 5) -->
            <div class="form-group">
                <label for="fotografia_unidad" class="form-group__label">{{ __('Fotografía de la unidad') }}</label>
                <input id="fotografia_unidad" class="form-group__input" type="file" name="fotografia_unidad[]" accept="image/*" multiple required />
                <small class="form-group__text">{{ __('Puedes subir hasta 5 imágenes.') }}</small>
            </div>

            <div class="form-group">
                <label for="comentarios" class="form-group__label">{{ __('Comentarios') }}</label>
                <textarea id="comentarios" class="form-group__input form-group__input--textarea" name="comentarios" rows="3" placeholder="Escribe cualquier observacion adicional ejemplo: Viene otro conductor" ></textarea>
            </div>

            <!-- Botones al final del formulario -->
            <div class="form-buttons">
                <button type="button" class="form-buttons__btn form-buttons__btn--scan" id="btn-scan">
                    {{ __('Escanear automóvil') }}
                </button>
                <button type="submit" class="form-buttons__btn form-buttons__btn--submit">
                    {{ __('Enviar') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Incluye SweetAlert2 y html5-qrcode -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="{{asset('js/qr.js')}}"></script>

</x-app-layout>

