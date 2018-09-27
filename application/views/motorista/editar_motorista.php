<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
?>

<div class="col-md-8">
    <h3><?php if(isset($message_error)) { echo $message_error;}?></h3>
    <h3><?php if(isset($message_fdbd)) { echo $message_fdbd;}?></h3>
    <form action="<?php echo base_url()?>index.php/Motorista/atualizar_motorista" method="POST">
            <h3>Cadastro de Motorista</h3>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do motorista" value="<?php echo $motorista->nome_motorista?>">
            </div>
        
            <div class="form-group">
                <label for="num_doc">Número da Carteira</label>
                <input type="text" class="form-control" id="num_doc"  name="num_doc" placeholder="Digite o número da carteira" value="<?php echo $motorista->documento_motorista?>"> 
            </div>
            <div class="form-group">
                <label for="tel">Telefone de Contato</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="(XX) X XXXX-XXXX" value="<?php echo $motorista->tel_motorista?>">
            </div>
            <label for="cat_doc">Categoria da carteira</label>
            <div class="form-group"> 
                <div>
                <select id="cat_doc" name="cat_doc" class="form-control">
                    <?php foreach($categorias as $cat){ ?>
                        <option value="<?php echo $cat->id_categoria_vec?>" <?php if($cat->id_categoria_vec == $motorista->cat_motorista) { echo 'selected'; } ?>> <?php echo $cat->desc_categoria_vec?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
            <input type="text" class="form-control" id="id" name="id" value="<?php echo $motorista->id_motorista?>" style="display:none;">               

            
            <button type="submit" class="btn btn-default">Cadastrar</button>
        </div>
    </form>   

</div>


<script>
    $('.alert').alert();
</script>