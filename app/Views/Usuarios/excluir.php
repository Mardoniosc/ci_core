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


      <?php echo form_open("usuarios/excluir/$usuario->id") ?>

      <div class="alert alert-warning">
        Tem certeza que deseja excluir o usuário?
      </div>

      <div class="form-group m-t-md m-b-sm">

        <input type="submit" class="btn btn-primary btn-sm m-r-sm" value="Sim, pode excluir">

        <a href="<?php echo site_url("usuarios/exibir/$usuario->id"); ?>" class="btn btn-info btn-sm">Cancelar</a>
      </div>

      <?php echo form_close(); ?>


    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<?php echo $this->endSection(); ?>