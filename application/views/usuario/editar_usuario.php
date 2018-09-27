<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
?>

<div class="col-md-8">
		<form action="<?php echo base_url()?>index.php/Usuario/atualizar_usuario" method="POST" >
			<h3>Editar Usuário -> <?php echo $usuario->id_usuario?></h3>
			<div class="form-group">
				<label for="login">Login</label>
				<input type="text" class="form-control" id="login" name="login" placeholder="Digite o seu login:" value="<?php echo $usuario->login_usuario ?>">
			</div>
			<div class="form-group"  style="display:none;">
				<label for="senha">Senha</label>
				<input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha:" value="<?php echo $usuario->login_usuario ?>"  >
			</div>
			
			<div class="form-group"> 

				<label for="setor">Setor</label>
				<select id="setor" name="setor" class="form-control">
					<?php foreach($setores as $set){?>
						<option value="<?php echo $set->id_setor?>" <?php if($set->id_setor == $usuario->setor_usuario) {echo 'selected';} ?>><?php echo $set->nome_setor?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group form-row">
				<button type="submit" class="btn btn-default"  onclick="alert('Cadastrado com sucesso'), window.location('index.html');">Cadastrar</button>
            </div>
            <input type="text" name="id" id="id" value="<?php echo $usuario->id_usuario?>" style="display:none;"> 
		</form>
	</div>