var paquetes = [];
var mode = false;

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});

$('[data-toggle="popover"]').popover().click(function () {
    setTimeout(function () {
        $('[data-toggle="popover"]').popover('hide');
    }, 2000);
});

function seleccionarPaquete(id){
  paquetes.push(id);
}

function sortExpress(){
  clearError();
  var fecha = $('#fecha_express').val();
  var time = moment().tz("America/Denver").format("YYYY-MM-DD HH:mm");
  var hora = fecha + ' '+ $('#hora_express').val();

  var difference = moment.utc(moment(moment(hora,"YYYY-MM-DD HH:mm")).diff(time)).format('x');
console.log(difference)
  if(difference < 0){
    console.log('hora invalida')
        $('#error-express').append('<p class="error">Por favor seleccione una hora mayor al tiempo actual.</p>')
  }
  else if(difference >= 5400000){
      guardarExpress(paquetes);
  } else {
      var r = confirm('Las solicitudes de entrega express agendadas con menos de una hora y media de anticipación no están garantizadas. Envíe su solicitud, si su entrega está lista recibirá un correo electrónico.');
      if (r == true) {
           guardarExpress(paquetes);
      } else {
          cerrarPopup();
      }
  }
}

function sortAutorizacion(){
  var nombre;
  clearError();
  if($('#nombres-autorizados').val() || $('#nuevo-nombre').val()){
    if($('#nuevo-nombre').val()){
      nombre = $('#nuevo-nombre').val();
    } else {
      nombre = $('#nombres-autorizados').val();
    }
    guardarAutorizado(nombre);
  }
}

function clearError(){
$('#error-express').html('');
}

function checkWeekend(){
  var date = new Date($('#fecha_express').val()).getDay();
console.log(date)
if(date == 5 || date == 6){
  alert('Las entregas en fin de semana tienen un cargo adicional y requieren confirmación de disponibilidad. Por favor envíe su solicitud y nos comunicaremos más tarde con la disponibilidad de horario.');
}
}
function guardarExpress(ids) {
  console.log('guardando');
var recepcion_ids = ids;
var fecha = $('#fecha_express').val();
var hora = $('#hora_express').val();
  if($('#express-nombre-recojer').val() === 'otro'){
    var nombre = $('#express-nombre-nuevo').val() + ' '+$('#express-apellido-nuevo').val() ;
  } else {
    var nombre=$('#express-nombre-recojer').val();
  }

$('#express-loading').html('<i class="fa fa-spinner fa-spin" style="margin-left:20px;margin-top:2px;vertical-align:bottom;font-size:24px; color:#8999A8;"></i>');
clearError();
var express = $.ajax({
    url: '/helpers/entrega_express.php',
    type: 'POST',
    dataType: 'text',
    data: {
      recepcion_ids: recepcion_ids,
      fecha:fecha,
      hora: hora,
      nombre:nombre
    }
  });

  express.done(function(data){
    console.log(data);
    if(data){
      console.log('equals')
      $('.popup-header').html('');
      $('.popup-container').css('text-align','center');
      $('.popup-container').css('padding-top','30px');
      $('.popup-container').html('<span class="glyphicon glyphicon-ok" style="font-size:100px;color:#d6df3f;"></span><h2 style="margin-top:34px;">Enviado!</h2>');
      setTimeout(reload, 1000);
    }
    });

  express.fail(function(jqXHR, textStatus, errorThrown){
    console.log(errorThrown);
    $('#error-express').append('<p class="error">ERROR '+errorThrown+'</p>')
  });


}

function guardarAutorizado() {
  console.log('guardando');
  clearError();
  if($('#nombres-autorizados').val().length > 0 || $('#nombre-nuevo').val().length > 0 || $('#apellido-nuevo').val().length > 0){
       if($('#nombres-autorizados').val()){
        var nombre = $('#nombres-autorizados').val();
       } else {
          if(/^\s*$/.test($('#nombre-nuevo').val()) || /^\s*$/.test($('#apellido-nuevo').val())){
            alert("Por favor ingrese nombre y apellido de la persona por autorizar.");
            return;
          } else {
            var nombre = $('#nombre-nuevo').val() +' '+$('#apellido-nuevo').val();
          }
      }
           $('#autorizacion-loading').html('<i class="fa fa-spinner fa-spin" style="margin-left:20px;margin-top:2px;vertical-align:bottom;font-size:24px; color:#8999A8;"></i>');
                  var autorizacion = $.ajax({
                  url: '/helpers/nombre_autorizado.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    nombre_autorizado: nombre,
                    recepcion_ids: paquetes
                  }
                });

                autorizacion.done(function(data){
                  console.log(data.success);
                  if(data.success === true){
                    $('.popup-header').html('');
                    $('.popup-container').css('text-align','center');
                    $('.popup-container').css('padding-top','30px');

                    $('.popup-container').html('<span class="glyphicon glyphicon-ok" style="font-size:100px;color:#d6df3f;"></span><h2 style="margin-top:34px;">Nombre Autorizado!</h2>');
                    setTimeout(reload, 1000);
                  }
                  });

                autorizacion.fail(function(jqXHR, textStatus, errorThrown){
                  console.log(jqXHR);
                  $('#error-express').append('<p class="error">ERROR</p>')
                });
  } else {
    alert("Por favor ingrese el nombre por autorizar.")
  }
}

function cerrarPopup(){
  $('.popup').css('visibility','hidden');
  $('#nombres-express').css('display','block');
  $('#otro-recojer').css('display','none');
  $('#express-nombre-recojer').val('');
  clearError();
}

function reload(){
  location.reload();
}

function showExpressPopup(){
if ($(".entrega-checkbox").is(":checked"))
{
    $('#popup-express').css('visibility','visible');

}
else
{
  alert('Por favor seleccione un paquete para agendar.')
}
}

function showAutorizacionPopup(){
  if ($(".entrega-checkbox").is(":checked")) {
    $('#popup-autorizacion').css('visibility','visible');

}
else
{
  alert('Por favor seleccione un paquete por autorizar.')
}
}

function abrirCampoOtro(){
  var nombre = $('#express-nombre-recojer').val();

  if(nombre === 'otro'){
    $('#express-nombre-nuevo').val('');
    $('#express-apellido-nuevo').val('');
    $('#nombres-express').css('display','none');
     $('#otro-recojer').css('display','block');
  }

}

function getTipo(){
  if($('#tipo').val() == 0){
    window.reload();

  } else {
    var entregados = $.ajax({
    url: '/helpers/get_entregados.php',
    type: 'GET',
    dataType: 'json'
  });

  entregados.done(function(data){
    console.log(data);
    if(data.entregados.length>0){
      console.log('removing');
      $('#mes').removeAttr('disabled');
      $("#fecha").html('');
      $("#fecha").html('Fecha Entrega');
      $("#id-heading").after('<th style="width:10%;" id="salida-heading"># Salida</th>');
      $("#tabla-inventario tbody").remove();
      $('#tabla-inventario').append('<tbody></tbody>');
      $('#recibio').html('Recibió');
      $('#inventario-mobile').html('');
      var tableRef = document.getElementById('tabla-inventario').getElementsByTagName('tbody')[0];
      var divInventario = document.getElementById('inventario-mobile');
      var heading =  ['Fecha Recibido','ID','# Salida','Tipo','Remitente','Destinatario','Fletera','Tracking','Peso(lbs)','COD','Recibido por'];
      for(var j=0;j<data.entregados.length;j++){
          var iDiv = document.createElement('div');
         iDiv.className='tarjeta';
      var newRow   = tableRef.insertRow(tableRef.rows.length);
      var count = 0;
        for (var key in data.entregados[j]) {
           if(count == 0){
              var checkboxText  = '<div class="tarjeta-top"></div>';
              iDiv.innerHTML = iDiv.innerHTML+checkboxText;
            }
        var newCell  = newRow.insertCell(count);
        newCell.style.width = '10%';
        if(key === 'fromm'){
          newCell.style.width = '13%';
        }
        if(key === 'nombre'){
          newCell.style.width = '10%';
        }
          if(key === 'traking'){
            newCell.style.width = '11%';
              var tracking = data.entregados[j]['traking'].slice(0,4)+'...'+data.entregados[j]['traking'].slice(data.entregados[j]['traking'].length-4,data.entregados[j]['traking'].length);
              var tarjetaText  = '<p><strong style="text-decoration:underline;">'+heading[count]+':</strong> '+tracking+'</p>';
              var newText  = document.createTextNode(tracking);
          } else if(key === 'cod'){
            var cod = '$'+data.entregados[j][key];
            var tarjetaText  = '<p><strong style="text-decoration:underline;">'+heading[count]+':</strong> '+cod+'</p>';
            var newText  = document.createTextNode(cod);
          } else if(key == 'tipo'){

                  switch (data.entregados[j]['tipo']) {
                  case "SP-CH":
                     tipo = "Sobre/Paquete Chico";
                  break;
                  case "SP-M":
                     tipo = "Sobre/Paquete Mediano";
                    break;
                   case "SP-G":
                     tipo =  "Sobre/Paquete Grande";
                  break;
                  case "SP-XG":
                     tipo =  "Sobre/Paquete Extra-Grande";
                  break;
                  case "C-XCH":
                     tipo = "Caja Extra-Chica";
                  break;
                  case "C-CH":
                     tipo =  "Caja Chica";
                  break;
                  case "C-M":
                    tipo =  "Caja Mediana";
                  break;
                  case "C-G":
                     tipo = "Caja Grande";
                  break;
                  case "C-XG":
                     tipo =  "Caja Extra-Grande";
                  break;
                  default:
                  tipo =  "";
                  }

              var newText = document.createElement('a');
              var linkText = document.createTextNode(data.entregados[j][key]);
                newText.appendChild(linkText);
                newText.href = "#";
                newText.title = "Descripción";
                newText.setAttribute('data-toggle','popover');
                newText.setAttribute('data-content',tipo.toString());
                var tarjetaText  = '<p><strong style="text-decoration:underline;">'+heading[count]+':</strong> <a href="#" data-toggle="popover" title="Descripción" data-content="'+tipo+'">'+data.entregados[j][key]+'</a></p>';
              } else {
            var tarjetaText  = '<p><strong style="text-decoration:underline;">'+heading[count]+':</strong> '+data.entregados[j][key]+'</p>';
            var newText  = document.createTextNode(data.entregados[j][key]);
              }
        newCell.appendChild(newText);
        iDiv.innerHTML = iDiv.innerHTML+tarjetaText;
        newCell.appendChild(newText);
        count++;
         if(Object.keys(data.entregados[j]).length == count){
          divInventario.appendChild(iDiv);
        }
        }
        if(data.entregados.length-1 == j){
          console.log('done');
          $('[data-toggle="popover"]').popover();
        }
      }
      for(var i = 0; i < data.meses.length;i++){

        $('#mes').append('<option value="'+data.meses[i].year+'-'+data.meses[i].mes_numero+'">'+data.meses[i].mes+' '+data.meses[i].year+'</option>');
      }
    }
    });

    entregados.fail(function(jqXHR, textStatus, errorThrown){
      console.log(jqXHR);
      $('#error-express').append('<p class="error">ERROR</p>')
    });


  }
}

function getEntregasMes(){
  if($('#mes').val()){
    var mes =$('#mes').val();
      var entregados = $.ajax({
        url: '/helpers/entregados_mes.php',
        type: 'POST',
        dataType: 'json',
        data:{
          mes:mes
        }
      });

      entregados.done(function(data){
        console.log(data);
        if(data.length>0){
          console.log('removing');
          $('#mes').removeAttr('disabled');
          $("#fecha").html('');
          $("#fecha").html('Fecha Entrega');
          $("#tabla-inventario tbody").remove();
          $('#tabla-inventario').append('<tbody></tbody>');
          $('#recibio').html('Recibió');
          $('#inventario-mobile').html('');
          var tableRef = document.getElementById('tabla-inventario').getElementsByTagName('tbody')[0];
          var divInventario = document.getElementById('inventario-mobile');
          var heading =  ['Fecha Recibido','ID','# Salida','Tipo','Remitente','Destinatario','Fletera','Tracking','Peso(lbs)','COD','Recibió'];
          for(var j=0;j<data.length;j++){
         var iDiv = document.createElement('div');
         iDiv.className='tarjeta';
          var newRow   = tableRef.insertRow(tableRef.rows.length);
          var count = 0;
            for (var key in data[j]) {

              if(count == 0){
               var checkboxText  = '<div class="tarjeta-top"></div>';
                iDiv.innerHTML = iDiv.innerHTML+checkboxText;
              }
              var newCell  = newRow.insertCell(count);
        newCell.style.width = '10%';
        if(key === 'fromm'){
          newCell.style.width = '13%';
        }
        if(key === 'nombre'){
          newCell.style.width = '10%';
        }
              if(key == 'traking'){
                  var tracking = data[j]['traking'].slice(0,4)+'...'+data[j]['traking'].slice(data[j]['traking'].length-4,data[j]['traking'].length);
                  var newText  = document.createTextNode(tracking);
                  var tarjetaText  = '<p><strong style="text-decoration:underline;">'+heading[count]+':</strong> '+tracking+'</p>';
              } else if(key === 'cod'){
                  var cod = '$'+data[j][key];
                  var tarjetaText  = '<p><strong style="text-decoration:underline;">'+heading[count]+':</strong> '+cod+'</p>';
                  var newText  = document.createTextNode(cod);
              }else if(key == 'tipo'){
                  switch (data[j]['tipo']) {
                case "SP-CH":
                     tipo = "Sobre/Paquete Chico";
                  break;
                  case "SP-M":
                     tipo = "Sobre/Paquete Mediano";
                    break;
                   case "SP-G":
                     tipo =  "Sobre/Paquete Grande";
                  break;
                  case "SP-XG":
                     tipo =  "Sobre/Paquete Extra-Grande";
                  break;
                  case "C-XCH":
                     tipo = "Caja Extra-Chica";
                  break;
                  case "C-CH":
                     tipo =  "Caja Chica";
                  break;
                  case "C-M":
                    tipo =  "Caja Mediana";
                  break;
                  case "C-G":
                     tipo = "Caja Grande";
                  break;
                  case "C-XG":
                     tipo =  "Caja Extra-Grande";
                  break;
                  default:
                  tipo =  "";
                  }

              var newText = document.createElement('a');
              var linkText = document.createTextNode(data[j][key]);
                newText.appendChild(linkText);
                newText.href = "#";
                newText.title = "Descripción";
                newText.setAttribute('data-toggle','popover');
                newText.setAttribute('data-content',tipo);
            var tarjetaText  = '<p><strong style="text-decoration:underline;">'+heading[count]+':</strong> <a href="#" data-toggle="popover" title="Descripción" data-content="'+tipo+'">'+data[j][key]+'</a></p>';

              } else {
                var newText  = document.createTextNode(data[j][key]);
               var tarjetaText  = '<p><strong style="text-decoration:underline;">'+heading[count]+':</strong> '+data[j][key]+'</p>';
              }
            newCell.appendChild(newText);
            iDiv.innerHTML = iDiv.innerHTML+tarjetaText;
            count++;
            if(Object.keys(data[j]).length == count){
              console.log('done');
             divInventario.appendChild(iDiv);
              $('[data-toggle="popover"]').popover();
            }
            }
          }
        }
        });

      entregados.fail(function(jqXHR, textStatus, errorThrown){
        console.log(jqXHR);
        $('#error-express').append('<p class="error">ERROR</p>')
      });
  } else {
    $('#mes').html('<option value="">Todo el año</option>');
    getTipo();
    $("#salida-heading").remove();
  }
}

$(window).scroll(function(){
    console.log('scrolling')
       if ($(this).scrollTop() > 80) {
           $('#go-top').fadeIn();
       } else {
           $('#go-top').fadeOut();
       }


});

function selectAll(){
  if(!mode){
  mode = true;
    console.log('selecting');
  $('.entrega-checkbox').prop('checked', true);
  $('.entrega-checkbox').map(function(){
    paquetes.push($(this).val());
  });
  $(".selectall").html("Deselect All");
    console.log(paquetes);
} else {
  console.log('deselecting')
  mode = false;
  $('.entrega-checkbox').prop('checked',false);
  paquetes =[];
  $(".selectall").html("Select All");
  console.log(paquetes);
}
}
