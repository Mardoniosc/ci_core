<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>
<link href="<?php echo site_url('inspinia/'); ?>css/plugins/iCheck/custom.css" rel="stylesheet">

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
  <div class="col-lg-6 panel">
    <div class="panel-body">

      <!-- Exibira os retornos do backend -->
      <div id="response"></div>

      <?php echo form_open('/', ['id' => 'form'], ['id' => "$usuario->id"]) ?>


      <?php echo $this->include('Usuarios/_form'); ?>

      <div class="form-group m-t-md m-b-sm">

        <input type="submit" id="btn-salva" class="btn btn-danger m-r-sm" value="Salvar">

        <a href="<?php echo site_url("usuarios/exibir/$usuario->id"); ?>" class="btn btn-info">Voltar</a>
      </div>

      <?php echo form_close(); ?>


    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<!-- iCheck -->
<script src="<?php echo site_url('inspinia/'); ?>js/plugins/iCheck/icheck.min.js"></script>
<script>
  $(document).ready(function() {
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
    });
  });
</script>
<?php echo $this->endSection(); ?>