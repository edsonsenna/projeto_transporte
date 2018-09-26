<style type="text/css">
		@page { margin: 1cm }
		P { margin-bottom: 0.21cm; direction: ltr; color: #000000; widows: 2; orphans: 2 }
		P.western { font-family: "Times New Roman", serif; font-size: 12pt }
		P.cjk { font-family: "Times New Roman", serif; font-size: 12pt; so-language: zh-CN }
		P.ctl { font-family: "Times New Roman", serif; font-size: 12pt; so-language: ar-SA }

	</style>
  
  <script language="javascript">
/**
* Funcao que contem chamadas a funcoes
* que serao feitas no evento onload do window
*/
function doOnLoad(){

	//Adiciona funcao de validacao aos forms
	adicionarValidacaoForms();

}

/**
* Funcao que adiciona ao evento onsubmit de todos os formularios
* do documento, a funcao de validacao de formulario "validaForm()"
*
*/
function adicionarValidacaoForms(){

	var forms = document.forms;

	for ( var i = 0; i < forms.length; i++ ){

		forms[i].onsubmit = validaForm;

	}

}


/**
* Funcao que valida os campos obrigatorios num formulario.

* @return boolean
*/
var validaForm = function(){

	var frm = this;

	for (var i = 0; i < frm.elements.length; i++){

		if ( (frm.elements[i].title.substr(0,1)) == "*" ){

			if (frm.elements[i].value == ""){
				alert("O campo '"+frm.elements[i].title.substr(1,(frm.elements[i].title.length))+"' e de preenchimento obrigatorio!");
				frm.elements[i].style.backgroundColor = "#ffffcc";
				frm.elements[i].focus();
				return false;
				break;
			}else{
				frm.elements[i].style.backgroundColor = "#efefef";
			}

		}

	}

	return true;

}

// Atribui ao evento onload da janela a funcao doOnLoad.

window.onload = doOnLoad;

function ValidaCampos() {

var CPF = document.viagem.txtCPF.value;
/* verifica cpf */
if ( CPF == '' ) {
alert("Por favor digite seu cpf completo!");
return false;
}


// Aqui comecaa a checagem do CPF
var POSICAO, I, SOMA, DV, DV_INFORMADO;
var DIGITO = new Array(10);
DV_INFORMADO = CPF.substr(9, 2); // Retira os dois Ãºltimos digitos do n&uacute;mero informado

// Desmembra o nÃºmero do CPF na array DIGITO
for (I=0; I<=8; I++) {
  DIGITO[I] = CPF.substr( I, 1);
}

// Calcula o valor do 10Âº dÃ­gito da verificaÃ§Ã£o
POSICAO = 10;
SOMA = 0;
   for (I=0; I<=8; I++) {
      SOMA = SOMA + DIGITO[I] * POSICAO;
      POSICAO = POSICAO - 1;
   }
DIGITO[9] = SOMA % 11;
   if (DIGITO[9] < 2) {
        DIGITO[9] = 0;
}
   else{
       DIGITO[9] = 11 - DIGITO[9];
}

// Calcula o valor do 11Âº dÃ­Â­gito da verificaÃ§Ã£o
POSICAO = 11;
SOMA = 0;
   for (I=0; I<=9; I++) {
      SOMA = SOMA + DIGITO[I] * POSICAO;
      POSICAO = POSICAO - 1;
   }
DIGITO[10] = SOMA % 11;
   if (DIGITO[10] < 2) {
        DIGITO[10] = 0;
   }
   else {
        DIGITO[10] = 11 - DIGITO[10];
   }

// Verifica se os valores dos dÃ­gitos verificadores conferem
DV = DIGITO[9] * 10 + DIGITO[10];
   if (DV != DV_INFORMADO) {
      alert('CPF invalido');
      document.viagem.txtCPF.value = '';
      document.viagem.txtCPF.focus();
      return false;
   }
   }
 
 </script>
<style type="text/css">
#campo_field{
       width: 950px;
       height: 80px;
       margin: 0 auto;
       border: 1px solid black;
       padding: 2px;
       text-align: center;
}
</style>
<br>

<br>

<p class="western" style="margin-left: 1.25cm; margin-bottom: 0cm;" align="center"><br>
</p>

<div style="font-size: 15px;" &gt;="" align="center"><strong><img style="width: 253px; height: 111px;" alt="" src="http://www.ifsuldeminas.edu.br/documentos/Logo.jpg"><br>
</strong>
<div style="text-align: center;"><big><strong><b>MINIST&Eacute;RIO DA EDUCA&Ccedil;&Atilde;O<br>
</b></strong><strong>Secretaria de Educa&ccedil;&atilde;o Profissional e Tecnol&oacute;gica <br>
Instituto Federal de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia do Sul de Minas
Gerais</strong></big><br>
</div>
<div>
</div>
<div style="text-align: center;">
</div>
<p class="western" style="margin-bottom: 0cm; text-align: center; text-decoration: underline;"><big><strong><font face="Century, serif"><font size="2"><big><b>FORMUL&Aacute;RIO DE CONCESS&Atilde;O
DE
PASSAGENS E DI&Aacute;RIAS</b></big></font></font></strong></big></p>
<strong><br>
</strong>
<!--<table
 style="text-align: left; width: 356px; height: 33px; margin-left: auto; margin-right: 310px;"
 border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td style="vertical-align: top;">SCDP NÂº:<br>
      </td>
    </tr>
  </tbody>
</table>--> <strong><br>
</strong>
<form method="post" action="impressao_requisicao_viagem.php" name="viagem"><span><span style="font-weight: bold;">DADOS PESSOAIS:<br>
  <br>
  </span>
  <div><span style="font-weight: bold;"><fieldset id="campo_field"><legend>Selecione o tipo de Benefici&aacute;rio:</legend><br>
  </span>
  <table style="text-align: left; width: 968px; height: 33px;" border="0" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="servidor"><input name="tipo_beneficiario" id="servidor" value="Servidor" type="radio" title="*BeneficiÃ¡rio">Servidor</label></span></td> 
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="assessor"><input name="tipo_beneficiario" id="assessor" value="Terceirizado" type="radio" title="*BeneficiÃ¡rio">Terceirizado</label><br>
        </span></td>
        <td style="vertical-align: top;"><label for ="eventual"><input name="tipo_beneficiario" id="eventual" value="Colaborar Eventual" type="radio" title="*BeneficiÃ¡rio"><span style="font-weight: bold;">Colaborador Eventual</label><br>
        </span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="convidado"><input name="tipo_beneficiario" id="convidado" value="Convidado" type="radio" title="*BeneficiÃ¡rio">Convidado</label></span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="outro"><input name="tipo_beneficiario" id="outro" value="Outros" type="radio" title="*BeneficiÃ¡rio">Outros</label></span></td>
      </tr>
    </tbody>
  </table>
</fieldset>
<br>
  <strong> </strong>
  <table style="text-align: left; width: 204px; height: 60px;" border="0" cellpadding="2" cellspacing="2">
    <tbody>
	<tr><td colspan = "4" align = "center">ATEN&Ccedil;&Atilde;O: A Primeira linha &eacute; obrigat&oacute;ria e as demais deve ser utilizada apenas no caso de inclus&atilde;o de outras pessoas na mesma requisi&ccedil;&atilde;o desde que tenham as mesmas caracter&iacute;sticas</td></tr>
      <tr>
        <td style="vertical-align: top;">Nome:</td>
        <td style="vertical-align: top;"><input maxlength="80" size="60" name="txtNome" title="*Nome" ><br>
        </td>
        <td style="vertical-align: top;">CPF:<br>
        </td>
        <td style="vertical-align: top;"><input maxlength="50" size="30" name="txtCPF" title="*CPF" ><br>
        </td>
      </tr>

      <tr>
        <td style="vertical-align: top;">Nome:</td>
        <td style="vertical-align: top;"><input maxlength="80" size="60" name="txtNome1" title="Nome" ><br>
        </td>
        <td style="vertical-align: top;">CPF:<br>
        </td>
        <td style="vertical-align: top;"><input maxlength="50" size="30" name="txtCPF1" title="CPF" ><br>
        </td>
      </tr>

	<tr>
        <td style="vertical-align: top;">Nome:</td>
        <td style="vertical-align: top;"><input maxlength="80" size="60" name="txtNome2" title="Nome" ><br>
        </td>
        <td style="vertical-align: top;">CPF:<br>
        </td>
        <td style="vertical-align: top;"><input maxlength="50" size="30" name="txtCPF2" title="CPF" ><br>
        </td>
      </tr>

	<tr>
        <td style="vertical-align: top;">Nome:</td>
        <td style="vertical-align: top;"><input maxlength="80" size="60" name="txtNome3" title="Nome" ><br>
        </td>
        <td style="vertical-align: top;">CPF:<br>
        </td>
        <td style="vertical-align: top;"><input maxlength="50" size="30" name="txtCPF3" title="CPF" ><br>
        </td>
      </tr>

	<tr>
        <td style="vertical-align: top;">Nome:</td>
        <td style="vertical-align: top;"><input maxlength="80" size="60" name="txtNome4" title="Nome" ><br>
        </td>
        <td style="vertical-align: top;">CPF:<br>
        </td>
        <td style="vertical-align: top;"><input maxlength="50" size="30" name="txtCPF4" title="CPF" ><br>
        </td>
      </tr>

    </tbody>
  </table>
  <strong> <br>
  </strong></div>

  </span><span><strong> DADOS DA VIAGEM:</strong></span><br>
  <span><strong>&nbsp; </strong><strong></strong><br>
  <div> <span style="font-weight: bold;"><fieldset id="campo_field"><legend>Selecione a Natureza:</legend></span><br>
  <table style="text-align: left; width: 966px; height: 34px;" border="0" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="servico"><input name="natureza" id = "servico" value="Servico" type="radio">Servi&ccedil;o</label></span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="convocacao"><input name="natureza" id = "convocacao" value="Convocacao" type="radio">Convoca&ccedil;&atilde;o</label><br>
        </span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="treinamento"><input name="natureza" id = "treinamento" value="Treinamento" type="radio">Treinamento</label><br>
        </span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="congresso"><input name="natureza" id = "congresso" value="Congresso" type="radio">Congresso</label></span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="encontro"><input name="natureza" id = "encontro" value="Encontro Seminario" type="radio">Encontro/Semin&aacute;rio</label></span></td>
      </tr>
    </tbody>
  </table>
</fieldset>

  <strong> <br>
  <span style="font-weight: bold;">Motivo da Viagem (Objeto/assunto a
ser tratado/evento):</span><br>
  <textarea cols="80" rows="7" name="txtMotivo" title="*Motivo da Viagem"></textarea><br>
  <br>
  <span style="font-weight: bold;">Justificativa (Preencha somente em caso Viagem em final de
semana ou feriado):</span><br>
  <textarea cols="80" rows="7" name="txtJustificativa" title="Justificativa"></textarea><br>
  <br>
<fieldset id="campo_field"><legend>Selecione o tipo de Custeio:</legend>
<br><table style="text-align: left; width: 948px; height: 34px;" border="0" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="diariapassagem"><input name="custeio" id ="diariapassagem" value="Diarias e Passagens" type="radio" title="*Diarias">Di&aacute;rias e Passagens</label><br>
        </span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="passagem"><input name="custeio" id ="passagem" value="Somente Passagens" type="radio">Somente Passagens</label><br>
        </span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="diaria"><input name="custeio" id ="diaria" value="Somente Diarias" type="radio">Somente Di&aacute;rias</label><br>
        </span></td>
        <td style="vertical-align: top;"><span style="font-weight: bold;"><label for ="veiculo"><input name="custeio" id ="veiculo" value="Somente VeÃ­culo Oficial" type="radio">Somente Ve&iacute;culo Oficial</label><br>
        </span></td>
      </tr>
    </tbody>
  </table>
</fieldset>
</div>
<div>
  <strong> <br>
  <br>
  </strong> </span><span>
  <table style="border:1px;text-align: left; width: 950px; height: 220px;" border="0" cellpadding="2" cellspacing="2">
    <tbody>
      <tr style="font-weight: bold;">
        <td style="vertical-align: top; text-align: center;" colspan="6"><big>Trechos A&eacute;reos e Terrestres</big><br>
        </td>
      </tr>
<!--
      <tr>
        <td style="vertical-align: top; font-weight: bold; text-align: center; font-style: italic;" colspan="2">Trechos<br>
        </td>
        <td style="vertical-align: top; font-weight: bold; text-align: center; font-style: italic;" colspan="4">Embarques<br>
        </td>
      </tr>
-->
      <tr>
        <td style="vertical-align: top; text-align: center; font-weight: bold; font-style: italic;"><br>Local deOrigem<br>
        </td>
        <td style="vertical-align: top; text-align: center; font-weight: bold; font-style: italic;"><br>Local de Destino<br>
        </td>
        <td style="vertical-align: top; text-align: center; font-weight: bold; font-style: italic;"><br>Data<br>
        </td>
        <td style="vertical-align: top; text-align: center; font-weight: bold; font-style: italic;" colspan="2"><br>Hor&aacute;rios: Sa&iacute;da / Chegada<br>
        </td>
        <td style="vertical-align: top; text-align: center; font-weight: bold; font-style: italic;">Meio de Transporte.<br>Caso seja a&eacute;reo mencionar a CIA/VOO
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtOrigem1" title="*Primeira Linha - Local de Origen"><br>
        </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtDestino1" title="*Primeira Linha - Local de Destino"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtData1" title="*Primeira Linha - Data"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtSaida1" title="*Primeira Linha - Horario de SaÃ­da"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtChegada1" title="*Primeira Linha - HorÃ¡rio de Chegada"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="26" name="txtCiavoo1" title="*Primeira Linha - VeÃ­culo ou Cia AÃ©rea"> </td>
      </tr>
      <tr>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtOrigem2" > </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtDestino2" > </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtData2"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtSaida2"></td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtChegada2"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="26" name="txtCiavoo2"> </td>
      </tr>
      <tr>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtOrigem3"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtDestino3"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtData3"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtSaida3"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtChegada3"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="26" name="txtCiavoo3"> </td>
      </tr>
      <tr>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtOrigem4"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtDestino4"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtData4"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtSaida4"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="15" name="txtChegada4"> </td>
        <td style="vertical-align: top; font-weight: bold;"><input maxlength="70" size="26" name="txtCiavoo4"> </td>
      </tr>
    </tbody>
  </table>
  <strong> <br>
  <span style="font-weight: bold;">Justificativa se, s&oacute; di&aacute;rias ou
Passagens:</span><br>
  <textarea cols="80" rows="7" name="txtJustificativa2"></textarea><br>
  <br>
  <br>
  </strong>
  <div align="center"><strong><input value="Finalizar" type="submit" onclick="ValidaCampos();"> <br>
  <br>
  </strong></div>
  </span></form>
</div>
