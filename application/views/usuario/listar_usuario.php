<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
?>
<script src="<?php echo base_url()?>assets/js/comandos.js"></script>

<div class="col-md-8">
    <h2>Listar Usuários</h2>
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
                            <th>Data Cadastro</th>
                            <th>Permissão</th>
                            <th>Setor</th>	
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($usuarios as $usuario){?>
                            <tr class="<?php if($usuario->priv_usuario == 1) { echo 'bg-info'; } else { echo 'bg-success';}?>">
                                <td><?php echo $usuario->id_usuario ?></td>
                                <td><?php echo $usuario->login_usuario ?></td>
                                <td><?php echo $usuario->data_cadastro_usuario ?></td>
                                <td><?php echo $usuario->desc_privilegio?></td>
                                <td><?php echo $usuario->nome_setor?></td>
                                <td><a href="<?php echo base_url()?>index.php/Usuario/editar_usuario/<?php echo $usuario->id_usuario?>">Editar</a></td>
                                <td><a href="<?php echo base_url()?>index.php/Usuario/excluir_usuario/<?php echo $usuario->id_usuario?>" onclick="confirm('Deseja excluir o servidor(a) cadastrado?');">Excluir</a></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>   
        </div>
    </div>

</div>