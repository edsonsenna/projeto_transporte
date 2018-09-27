<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
?>

<div class="col-md-8">
		<form>
			<h3>Cadastro de Servidor</h3>
			<div class="form-group">
				<label for="login">Login</label>
				<input type="text" class="form-control" id="login" placeholder="Digite o seu login:">
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" class="form-control" id="senha" placeholder="Digite sua senha:">
			</div>
			
			<div class="form-group"> 

				<label for="setor">Setor</label>
				<select id="setor" name="selectbasic" class="form-control">
					<?php foreach($setores as $set){?>
						<option value="<?php echo $set->id_setor?>"><?php echo $set->nome_setor?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group form-row">
				<button type="submit" class="btn btn-default"  onclick="alert('Cadastrado com sucesso'), window.location('index.html');">Cadastrar</button>
			</div>
		</form>
	</div>