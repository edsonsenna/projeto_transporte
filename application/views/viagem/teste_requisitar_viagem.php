<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
$this->load->view('commons/side_menu');
echo $message_error;

?>

<div class="col-md-8">
    <form action="<?php echo base_url()?>index.php/System/testePDF" method="post">
        <input type="text" name="nome" id="nome">
        <input type="date" name="data" id="data">
        <input type="text" name="veiculo" id="veiculo">
        <input type="submit" value="Requisitar">
    </form>
</div>