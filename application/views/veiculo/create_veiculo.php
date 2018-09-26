<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
echo $message_error;

?>
<div class="col-md-6">
    <form action="<?php echo base_url()?>index.php/System/cadastro_veiculo" method="POST">
        <h3>Cadastro de Veículos</h3>
        <div class="form-group">
            <label for="modelo">Modelo do Veículo</label>
            <input type="text" class="form-control" id="modelo" name="modelo"placeholder="Digito o modelo do veículo">
        </div>
        <div class="form-group">
            <label for="fabricante">Fabricante do Veículo</label>
            <input type="text" class="form-control" id="fabricante" name="fabricante" placeholder="Digite o nome da fabricante do veículo">
        </div>
        <div class="form-group">
            <label for="placa">Placa do Veículo</label>
            <input type="text" class="form-control" id="placa" name="placa" placeholder="Digite a placa do veículo">
        </div>
        <div class="form-group">
            <label for="ano">Ano de Fabricação</label>
            <input type="number" class="form-control" id="ano" name="ano" placeholder="Digite o ano de fabricação do veículo">
        </div>
        <div class="form-group">
            <label for="num_pass">Número de passageiros</label>
            <input type="text" class="form-control" id="num_pass" name="num_pass" placeholder="Digite a capacidade de passageiros do veiculo">
        </div>
        <div class="form-group"> 
            <div class="col-md-4">
            <select id="categoria" name="categoria" class="form-control">
                <?php foreach($categorias as $cat){?>
                    <option value="<?php echo $cat->id_categoria_vec?>"><?php echo $cat->desc_categoria_vec?></option>
                <?php } ?>
            </select>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default"  onclick="alert('Cadastrado com sucesso'), window.location('index.html');">Cadastrar</button>       
        </div>
        
  
    
    </form>

</div>
