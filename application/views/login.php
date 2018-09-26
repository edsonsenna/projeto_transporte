<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
?>

    <div class="row justify-content-center">
        <div class="col-md-4 form-login">
            <form id="formLogin" action="<?php echo base_url()?>index.php/system/verifica_login" method="post">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" value="" id="login" name="login">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" value="" id="senha" name="senha">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Entrar">
                </div>
            
            </form>
        </div>
    </div>


<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/validate.js"></script>

<script type="text/javascript">
        $(document).ready(function(){

            $('#login').focus();
            $("#formLogin").validate({
                    rules :{
                        login: { required: true},
                        senha: { required: true}
                },
                messages:{
                        login: { required: 'Campo Requerido.'},
                        senha: {required: 'Campo Requerido.'}
                },
                submitHandler: function( form ){       
                        var dados = $( form ).serialize();    
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/system/verifica_login?ajax=true",
                        data: dados,
                        dataType: 'json',
                        success: function(data)
                        {
                        if(data.result == true){
                           // alert('Teste');
                            window.location.href = "<?php echo base_url();?>index.php/system";
                        }
                        else{
                            alert('Login ou Senha Incorretos!');

                            $('#btn-acessar').removeClass('disabled');
                            $('#progress-acessar').addClass('hide');
                            
                            $('#call-modal').trigger('click');
                        }
                        }
                        });

                        return false;
                }
            });

        });

</script>
