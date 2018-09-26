<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
?>

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
</script>
<div class="col-md-8">
    <div align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:12px; color:#000">
    <form name="viagem" action="impressao_relatorio_viagem.php" method="post" accept-charset="utf-8">
    <script language="JavaScript" type="text/javascript">
    <!--
    function submitForm() {
        //make sure hidden and iframe values are in sync before submitting form
        //to sync only 1 rte, use updateRTE(rte)
        //to sync all rtes, use updateRTEs
        //updateRTE('rte1');
        updateRTE('rte1');
        alert("rte1 = " + document.RTEDemo.rte1.value);
        
        
        
        //change the following line to true to submit form
        return false;
    }

    //Usage: initRTE(imagesPath, includesPath, cssFile)
    initRTE("rte/images/", "rte/", "rte/");
    //-->
    </script>
    <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
        
        <div align="center" style="font-size:24px;"><strong><img src="http://www.ifsuldeminas.edu.br/documentos/Logo.jpg" width="253" height="111" /><br />
        RELAT&Oacute;RIO DE VIAGEM</strong></div>
        <br />
        <br />
        <div align="center">
        <strong>MINIST&Eacute;RIO DA EDUCA&Ccedil;&Atilde;O<br />
        SECRETARIA DE EDUCA&Ccedil;&Atilde;O PROFISSIONAL E TECNOL&Oacute;GICA<br />
        INSTITUTO FEDERAL DE EDUCA&Ccedil;&Atilde;O, CI&Ecirc;NCIA E TECNOLOGIA<br />
        DO SUL DE MINAS GERAIS</strong> </div>
    <br />
    
        <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr height="30">
            <td width="100">Servidor(a): </td>
            <td><input type="text" size="57" name="nome" id="nome" /></td>
        </tr>	
    <tr>
        <td colspan="2" valign="top"><table width="700" border="0" cellpadding="0" cellspacing="0">
        <tr height="30">
            <td width="100">Data de sa&iacute;da: </td>
            <td width="244"><input type="text" name="data_saida" size="8"  title="*Data de saida" />
                <span style="font-size:11px; color:#999"><i> Ex.: 10/05/2016</i></span></td>
            <td width="100">Data de retorno:</td>
            <td width="258"><input type="text" name="data_chegada" size="8" title="*Data de chegada" />
                <span style="font-size:11px; color:#999"><i> Ex.: 15/05/2016</i></span></td>
        </tr>
        <tr height="30">
            <td>Hor&aacute;rio: </td>
            <td><input type="text" name="hora_saida" size="8" title="*Hora de saida" />
                <span style="font-size:11px; color:#999"><i>Ex.: 16h30</i></span> </td>
            <td>Hor&aacute;rio:</td>
            <td><input type="text" name="hora_chegada" size="8" title="*Hora de chegada" />
                <span style="font-size:11px; color:#999"><i>Ex.: 12h30</i></span></td>
        </tr>
        </table></td>
        </tr>
    
    <tr height="30">
        <td width="100">Local:</td>
        <td><input type="text" name="local" size="78" title="*Local" /></td>
    </tr>
    <tr height="30">
        <td valign="top" width="100">Objetivo:</td>
        <td><textarea name="objetivo" rows="6" cols="80" title="*Objetivo"></textarea></td>
    </tr>
    <tr><td>&nbsp;</td></tr>  
    <tr height="30">
        <td valign="top" width="100">Atividades:</td>
        <td><textarea name="atividades" rows="10" cols="80" title="*Atividades"></textarea></td>    
    </tr>  
    <tr><td>&nbsp;</td></tr>
    <tr height="30" align=center>    
        <td colspan=2><input type="submit" value="Finalizar" onclick="submitForm()" />    </td>
    </tr>
    </table>
    </div>
        </td>
    </tr>
    </table>
    </form>
    </div>
    </div>