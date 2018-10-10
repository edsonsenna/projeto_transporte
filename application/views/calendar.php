<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br"> 
<head>
<meta charset='utf-8' />
<title>Sistema Transporte</title>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap/bootstrap.css">
<link href='<?php echo base_url()?>assets/css/style.css' rel='stylesheet' />
<link href='<?php echo base_url()?>assets/css/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url()?>assets/css/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url()?>assets/css/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src="<?php echo base_url()?>assets/js/fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/js/fullcalendar/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/js/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>assets/js/fullcalendar/locale/pt-br.js"></script>
<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      /**customButtons: {
        requisitarTransporte: {
          text: 'Nova Requisição',
          click: function() {
            $('#requisitaTransporte').modal('show');
          }
        }
      },*/
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      defaultDate: new Date(),
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      dayClick: function(date, jsEvent, view) {
         // $(document).ready(function(){
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>index.php/Transporte/verifica_disponibilidade_veiculo?ajax=true",
              data: {data: date.format('YYYY-MM-DD')},
              dataType: 'json',
              success: function(data)
              {
                var select = document.getElementById('veiculo');
                var veiculos = data.veiculos;
                  
                if(data.result == false){
                  alert(data.message);
                }
                else{
                  if(!veiculos.length == 0){
                  select.options.length = 0;
                  veiculos.forEach(function(element, index){
                      var opt = document.createElement('option');
                      opt.value = element.id_veiculo;
                      opt.innerHTML = element.nome_veiculo;
                      select.appendChild(opt);
                    });
                  }else{
                    select.options.length = 0;
                    var veiculos_obj = Object.values(veiculos);
                    veiculos_obj.forEach(function(element){
                      var opt = document.createElement('option');
                      opt.value = element.id_veiculo;
                      opt.innerHTML = element.nome_veiculo;
                      select.appendChild(opt);
                    });
                  }

                  $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>index.php/Transporte/verifica_disponibilidade_motorista?ajax=true",
                    data: {data: date.format('YYYY-MM-DD')},
                    dataType: 'json',
                    success: function(data)
                    {

                      var select = document.getElementById('motorista');
                      var motoristas = data.motoristas;

                      if(data.result == false){
                        alert(data.message);
                      }
                      else{
                        if(!motoristas.length == 0){
                        select.options.length = 0;
                        motoristas.forEach(function(element, index){
                            var opt = document.createElement('option');
                            opt.value = element.id_motorista;
                            opt.innerHTML = element.nome_motorista;
                            select.appendChild(opt);
                          });
                        }else{
                          select.options.length = 0;
                          var motoristas_obj = Object.values(motoristas);
                          motoristas_obj.forEach(function(element){
                            var opt = document.createElement('option');
                            opt.value = element.id_motorista;
                            opt.innerHTML = element.nome_motorista;
                            select.appendChild(opt);
                          });
                        }


                        $('#requisitaTransporte #requisitaTransporteTitle').text('Requisitar Transporte - ' + date.format('DD-MM-YYYY'));
                        document.getElementById('dia').value = date.format('YYYY-MM-DD');
                        $('#requisitaTransporte').modal('show');
                        
                      }
                    }
                  });

                 // $('#requisitaTransporte #requisitaTransporteTitle').text('Requisitar Transporte - ' + date.format('DD-MM-YYYY') +' - '+ data.message);
                  //$('#requisitaTransporte').modal('show');
                  
                }
            }
          });
        //});
       
        //alert('Clicked on: ' + date.format());

      },
      eventClick: function(event) {
        $('#exampleModalLong #text-modal-id').text(event.id);
        $('#exampleModalLong #text-modal-requisitante').text(event.title);
        $('#exampleModalLong #text-modal-saida').text(event.start);
        $('#exampleModalLong #text-modal-chegada').text(event.end);
        $('#exampleModalLong #text-modal-status').text('Aguardando Requisição');
        $('#exampleModalLong').modal('show');
        return false;

      },
      events: [
        <?php foreach($transportes as $tp){ ?>
          {
            id: <?php echo $tp->id ?>,
            title: <?php echo $tp->doc_requisitante ?>,
            start: '<?php echo $tp->data_transporte_saida ?>',
            end: '<?php echo $tp->data_transporte_chegada ?>',
            color: '<?php echo $tp->color ?>'
          },
        <?php } ?>
      ]
    });

  });

</script>
<style>

  body {
    margin:2px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
</head>
<body>
  <?php  $this->load->view('commons/side_menu'); ?>
  <div class="col-md-6">
    <div id='calendar'></div>
  </div>
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Dados do Transporte</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd id="text-modal-id"></dd>
            <dt>Requisitante</dt>
            <dd id="text-modal-requisitante"></dd>
            <dt>Data Saída:</dt>
            <dd id="text-modal-saida"></dd>
            <dt>Data Chegada:</dt>
            <dd id="text-modal-chegada"></dd>
            <dt>Status</dt>
            <dd id="text-modal-status"></dd>
          </dl>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="requisitaTransporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requisitaTransporteTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()?>index.php/Transporte/cria_transporte" method="POST">
            <div class="form-row">
              <div class="col-md-3 form-group">
                <label for="dia">Data:</label>
                <input type="text" class="form-control" name="dia" id="dia"/>
              </div>
              <div class="col-md-4 form-group control">
                <label for="saida">Horário de Saída:</label>
                <input type="time" class="form-control" id="saida" name="saida" value="08:00"
                      required />
              </div>
              <div class="col-md-4 form-group control">
                <label for="chegada">Horário de Chegada:</label>
                <input type="time" class="form-control" id="chegada" name="chegada" value="12:00"
                      required />
              </div>
            </div>
            
            <div class="form-group">
              <label for="doc">Documento Requisitante</label>
              <input type="number" class="form-control" id="doc" placeholder="12344566" name="doc">
            </div>
            <div class="form-group">
              <label for="nome">Nome Requisitante</label>
              <input type="text" class="form-control" id="nome" placeholder="Fulano de Tal" name="nome">
            </div>
            <div class="form-group">
              <label for="motorista">Motoristas</label>
              <select class="form-control" id="motorista" name="motorista">
              </select>
            </div>
            <div class="form-group">
              <label for="veiculo">Veículo</label>
              <select class="form-control" id="veiculo" name="veiculo">
              </select>
            </div>
            <input type="submit" value="Cadastrar" class="btn btn-primary">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Cadastrar" class="btn btn-primary">
        </div>
      </div>
    </div>
  </div>


  

</body>
</html>
