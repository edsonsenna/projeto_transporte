<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');

?>
<script src="<?php echo base_url()?>assets/js/comandos.js"></script>
<div class="col-md-8">
<h1>Buscar Veiculos</h1>
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
								<th>Modelo</th>
								<th>Marca</th>
								<th>Ano</th>	
								<th>Nº Passageiros</th>	
							</tr>
						</thead>
						<tbody>
                            <?php foreach($veiculos as $veiculo){?>
                                <tr class="<?php if($veiculo->man_veiculo == 0) { echo 'bg-danger';} else { echo 'bg-success';}?>">
								<td><?php echo $veiculo->nome_veiculo?></td>
								<td><?php echo $veiculo->marca_veiculo?></td>
								<td><?php echo $veiculo->cat_veiculo?></td>
								<td><?php echo $veiculo->qtd_pas_veiculo?></td>
								<td><a href="alterarVeiculos.html">Editar</a></td>
								<td><a href="" onclick="confirm('Deseja excluir o veículo cadastrado?');">Excluir</a></td>
								
							    </tr>

                            <?php }?>
							
						</tbody>
					</table>   
			</div>
		</div>

</div>