<div class="popup" id="popup-autorizacion">
    <div class="popup-header">
        <div class="popup-close" onclick="cerrarPopup()">X</div>
    </div>
    <div class="popup-container">
        <h3>Autorización para entrega: </h3>
        <div id="error-autorizacion"></div>
        <div id="autorizacion-container">
            <label>Selecciona un nombre de la lista:
                <select class="form-control" name="autorizado" id="nombres-autorizados">
                    <option value="">---</option>
                    <?php
                    foreach ($array['autorizados'] as $rowA) {
                        echo '<option value="' .$rowA['nombre'] . ' '.$rowA['app'].' '.$rowA['apm']. '">' .$rowA['nombre'] . ' '.$rowA['app'].' '.$rowA['apm'].'</option>';

                    }
                    ?>
                </select>
            </label>
            <label>Agrega uno nuevo:
                <input class="form-control" type="text" id="nombre-nuevo" placeholder="Nombre">
                <br>
                <input class="form-control"  type="text" id="apellido-nuevo" placeholder="Apellido">
            </label>
            <input name="button" type="submit" id="button" value="Autorizar" onclick="guardarAutorizado()" class="btn green-button button-popup" />
            <div id='autorizacion-loading' style="display:inline"></div>
        </div>
    </div>
</div>
