<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
?>
<script src="<?php echo base_url()?>assets/js/comandos.js"></script>

<div class="col-md-8">
    <h2>Listar Motoristas</h2>
    <div class="row">
        <div class="col-md-3">
            <form action="#" method="get">
                <div class="input-group">
                    <input class="form-control" id="system-search" name="q" placeholder="Procurar por" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        </br></br></br></br>
        <div class="col-md-9">
            <table class="table table-list-search">
                    <thead>
                        <tr>

                            <th>ID</th>
                            <th>Nome</th>
                            <th>Documento</th>
                            <th>Data Cadastro</th>
                            <th>Contato</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($motoristas as $motorista){ ?>
                            <tr class="<?php if($motorista->ativo_motorista == 1) {echo 'bg-success';} else { echo 'bg-danger';} ?>">
                                <td><?php echo $motorista->id_motorista?></td>
                                <td><?php echo $motorista->nome_motorista?></td>
                                <td><?php echo $motorista->documento_motorista?></td>
                                <td><?php echo $motorista->data_cadastro_motorista?></td>
                                <td><?php echo $motorista->tel_motorista?></td>
                                <td><a href="<?php echo base_url()?>index.php/Motorista/editar_motorista/<?php echo $motorista->id_motorista?>">Editar</a></td>
                                <td><a href="<?php echo base_url()?>index.php/Motorista/excluir_motorista/<?php echo $motorista->id_motorista?>" onclick="confirm('Deseja excluir o(a) motorista cadastrado?');">Excluir</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>   
        </div>
    </div>

</div>
