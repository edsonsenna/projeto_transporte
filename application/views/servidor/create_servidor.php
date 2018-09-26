<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
?>

<div class="col-md-8">
		<form>
			<h3>Cadastro de Servidor</h3>
			<div class="form-group">
				<label for="employeeID">SIAPE</label>
				<input type="text" class="form-control" id="employeeID" placeholder="Digite o SIAPE do servidor">
			</div>
			<div class="form-group">
				<label for="employeeName">Nome</label>
				<input type="text" class="form-control" id="employeeName" placeholder="Digite o nome do servidor">
			</div>
		
			<div class="form-group">
				<label for="employeeCPF">CPF</label>
				<input type="text" class="form-control" id="employeeCPF" placeholder="Digite o CPF do servidor">
			</div>
			<label for="selectbasic">Possui portaria registrada?</label>
			<div class="form-group"> 
			  <div class="col-md-4">
				<select id="selectbasic" name="selectbasic" class="form-control">
				  <option value="1">Sim</option>
				  <option value="2">Não</option>
				</select>
			  </div>
			</div>
			<button type="submit" class="btn btn-default"  onclick="alert('Cadastrado com sucesso'), window.location('index.html');">Cadastrar</button>
			<a href="../index.html" class="btn btn-default" >Home</a>
		</form>
	</div>