<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
  <div class="col-lg-6 panel">
    <div class="panel-body">

    <!-- Exibira os retornos do backend -->
    <div id="response"></div>
      

    <?php echo form_open('/', ['id' => 'form'], ['id' => "$usuario->id"])?>

    <div class="form-group m-t-md m-b-sm">

      <input type="submit" id="btn-salva" class="btn btn-danger m-r-sm" value="Salvar">

      <a href="<?php echo site_url("usuarios");?>" class="btn btn-info">Voltar</a>
    </div>

    <?php echo form_close(); ?>


    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<?php echo $this->endSection(); ?>