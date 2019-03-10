<div class="popup" id="popup-express">
    <div class="popup-header">
        <div class="popup-close" onclick="cerrarPopup()">X</div>
    </div>
    <div class="popup-container">
        <h3>Programa tu entrega: </h3>
        <div id="error-express">
        </div>
        <div id="dia-container">
            <label for="fecha_express">Día</label>
            <input type="date" id="fecha_express" class="form-control" onChange="clearError();checkWeekend();" min="<?php date_default_timezone_set('America/Denver'); echo date("Y-m-d"); ?>" />
        </div>
        <div id="hora-container">
            <label for="hora">Hora</label>
            <select name="hora" id="hora_express"  class="form-control" onChange="clearError()">
                <option value="09:30">9:30 AM</option>
                <option value="10:00">10:00 AM</option>
                <option value="10:30">10:30 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="11:30">11:30 AM</option>
                <option value="12:00">12:00 PM</option>
                <option value="12:30">12:30 PM</option>
                <option value="13:00">1:00 PM</option>
                <option value="13:30">1:30 PM</option>
                <option value="14:00">2:00 PM</option>
                <option value="14:30">2:30 PM</option>
                <option value="15:00">3:00 PM</option>
                <option value="15:30">3:30 PM</option>
                <option value="16:00">4:00 PM</option>
                <option value="16:30">4:30 PM</option>
            </select>
        </div>
        <div id="nombres-express">
            <label>Quién va a recojer?:</label>
            <select class="form-control" name="nombre" id="express-nombre-recojer" onChange="abrirCampoOtro()">
                <option value="">---</option>
                <?php
                foreach ($array['autorizados'] as $rowA) {
                    echo '<option value="' .$rowA['nombre'] . ' '.$rowA['app'].' '.$rowA['apm']. '">' .$rowA['nombre'] . ' '.$rowA['app'].' '.$rowA['apm'].'</option>';
                }
                ?>
                <option value="otro">Otro</option>
            </select>
        </div>
        <div id="otro-recojer" style="display:none;">
            <label>Otro:</label>
            <input class="form-control"  type="text" id="express-nombre-nuevo" placeholder="Nombre">
            <br>
            <input class="form-control"  type="text" id="express-apellido-nuevo" placeholder="Apellido">
        </div>
        <input style="margin-top:24px;" name="button" type="submit" id="button" value="Programar" onclick="sortExpress()" class="btn green-button button-popup" />
        <div id='express-loading' style="display:inline"></div>
    </div>
</div>
