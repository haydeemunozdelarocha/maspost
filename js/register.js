
var autorizados = $('#autorizados-length').val();
var direccionInvalida = false;
function otroPais(){
  var pais = $('#pais').val();
  if(pais === "Otro"){
    $('#otro-pais-container').css('visibility','visible');
    $('#otro-pais-container').css('display','block');
    $('#otro-pais-container').attr('required','true');
  } else {
    $('#otro-pais-container').css('visibility','hidden');
    $('#otro-pais-container').css('display','none');
    $('#otro-pais-container').attr('required','false');
  }
}

function agregarAdicional(){
    $('#agregar-adicional').css('visibility','visible');
    $('#agregar-adicional').css('display','block');
}

function agregarAutorizado(){
    $('#agregar-autorizado').css('visibility','visible');
    $('#agregar-autorizado').css('display','block');
}

function uploadFile(type){
  var file = document.getElementById('ife').files[0];
    console.log(file)
  var express = $.ajax({
    url: '/test.php',
    type: 'POST',
    dataType: file.type,
    data: {
      ife: file,
      type:type
    }
  });

  express.done(function(data){
    console.log(data);
    });

  express.fail(function(jqXHR, textStatus, errorThrown){
    console.log(errorThrown);
    $('#error-express').append('<p class="error">ERROR</p>')
  });

}

function borrarClienteRecibir(id,nombre) {
  console.log('borrando');
  $('#borrar-loading'+id).html('<i class="fa fa-spinner fa-spin" style="margin-top:10px;font-size:24px; color:#8999A8;"></i>');

var express = $.ajax({
    url: '/helpers/borrar_c_recibir.php',
    type: 'POST',
    dataType: 'text',
    data: {
      id: id,
      nombre:nombre
    }
  });

  express.done(function(data){
      $('#borrar-loading'+id).html('');
      $('#recibir-loading').html('');
      alert('Solicitud enviada! Nos comunicaremos lo antes posible para hacer los cambios en tu plan.');
    });

  express.fail(function(jqXHR, textStatus, errorThrown){
    console.log(errorThrown);
  });


}

function agregarClienteRecibir() {
  console.log('agregando');
var email = $('#email-adicional-nuevo').val();
var nombre = $('#nombre-adicional').val()+' '+$('#apellido-adicional').val();
if(nombre.length == 0){
  alert('Por favor ingrese el nombre del usuario por agregar a la lista de autorizados para recibir.')
} else {
  $('#recibir-loading').html('<i class="fa fa-spinner fa-spin" style="margin-top:10px;font-size:24px; color:#8999A8;"></i>');

var express = $.ajax({
    url: '/helpers/agregar_c_recibir.php',
    type: 'POST',
    dataType: 'text',
    data: {
      nombre: nombre,
      email:email
    }
  });

  express.done(function(data){
      $('#recibir-loading').html('');
      alert('Solicitud enviada! Nos comunicaremos lo antes posible para hacer los cambios en tu plan.');
     $('#email-adicional-nuevo').val('');
      $('#nombre-adicional').val('');
      $('#apellido-adicional').val('');
    });

  express.fail(function(jqXHR, textStatus, errorThrown){
    console.log(errorThrown);
  });
}

}

function emailAutorizado() {
  console.log('agregando');

var nombre = $('#nombre-autorizado').val();
var apellidopaterno=$('#apellido-paterno-autorizado').val();
var apellidomaterno=$('#apellido-materno-autorizado').val();
if(nombre.length == 0 || apellidomaterno.length ==0 || apellidopaterno.length == 0){
  alert('Por favor ingrese el nombre del usuario por agregar a la lista de autorizados para recibir.')
} else {
  $('#recibir-loading').html('<i class="fa fa-spinner fa-spin" style="margin-top:10px;font-size:24px; color:#8999A8;"></i>');

var express = $.ajax({
    url: '/helpers/agregar_autorizado.php',
    type: 'POST',
    dataType: 'text',
    data: {
      nombre: nombre,
      apellidopaterno:apellidopaterno,
      apellidomaterno:apellidomaterno
    }
  });

  express.done(function(data){
    console.log(data)
      $('#recibir-loading').html('');
      alert('El nombre autorizado para recoger ha sido agregado.');
      autorizados++;
      if(autorizados == 5){
        $('#boton-agregar-autorizado').css('visibility','hidden');
        $('#boton-agregar-autorizado').css('display','none');
        $('#agregar-autorizado').css('visibility','hidden');
        $('#agregar-autorizado').css('display','none');
      }
      loadAutorizados();
    });

  express.fail(function(jqXHR, textStatus, errorThrown){
    console.log(errorThrown);
  });
}
}

function borrarEntregar(id){
  var express = $.ajax({
    url: '/helpers/borrar_c_entregar.php',
    type: 'POST',
    dataType: 'text',
    data: {
      id: id
    }
  });

  express.done(function(data){
    console.log(data)
      $('#recibir-loading').html('');
      autorizados--;
      loadAutorizados();

    });

  express.fail(function(jqXHR, textStatus, errorThrown){
    console.log(errorThrown);
  });
}


function loadAutorizados(){
    $('#recibir-loading').html('<i class="fa fa-spinner fa-spin" style="margin-top:10px;font-size:24px; color:#8999A8;"></i>');
  $('#autorizados').html('');
    var express = $.ajax({
    url: '/helpers/get_autorizados.php',
    type: 'GET',
    dataType: 'text'
  });

  express.done(function(data){
    data = JSON.parse(data);
    if(!data.autorizados){
      alert('empty');
    }
    console.log(data.autorizados)
      for(var i = 0; i < data.autorizados.length;i++){
        if(data.autorizados[i].email == null){
          var email = '';
        } else {
          data.autorizados[i].email;
        }
      $('#autorizados').append('<br><br><div class="form-group" id="agregar-autorizado-form"><label for="nombre" style="margin-top: 10px;">Nombre:</label><input type="text" class="form-control" name="nombreautorizado[]" id="nombre" value="'+data.autorizados[i].nombre+' '+data.autorizados[i].app+' '+data.autorizados[i].apm+'"><label for="email-autorizado" style="margin-top: 10px;">Email:</label><input type="text" class="form-control" name="emailrecoger[]" id="email-autorizado" value="'+email+'"><input type="hidden" class="form-control" name="autorizadosids[]" id="ids-autorizados" value="'+data.autorizados[i].id+'"><br><button class="btn green-button" type="button" onclick="borrarEntregar('+data.autorizados[i].id+')">Borrar</button></div></div>');
      if(i == data.autorizados.length-1){
      $('#nombre-autorizado').val('');
      $('#apellido-paterno-autorizado').val('');
      $('#apellido-materno-autorizado').val('');
      $('#recibir-loading').html('');
      if(autorizados < 5){
        console.log('less than 5')
        $('#boton-agregar-autorizado').css('visibility','visible');
        $('#boton-agregar-autorizado').css('display','block');
      } else {
       $('#boton-agregar-autorizado').css('visibility','hidden');
        $('#boton-agregar-autorizado').css('display','none');
        $('#agregar-autorizado').css('visibility','hidden');
        $('#agregar-autorizado').css('display','none');
      }
      }
      }
    });

  express.fail(function(jqXHR, textStatus, errorThrown){
    console.log(errorThrown);
  });
}

function checkAddress(){
  var direccion = $('#direccion').val();
  console.log(direccion);
  if(direccion.search('2220 Bassett') == 0){
    direccionInvalida = true;
    $('#direccion').after('<p style="color:red">Dirección inválida.Ingrese su dirección física.</p>')
  }
}
