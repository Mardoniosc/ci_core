<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css"/>

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-content">
  
        <table id="ajaxTable" class="table table-striped" style="width: 100%;">
          <thead>
            <tr>
              <th>Imagem</th>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Situação</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>


<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>

<script>
  $(document).ready(function () {
    $('#ajaxTable').DataTable({
        ajax: '<?php echo site_url('usuarios/recuperausuarios'); ?>',
        columns: [
            { data: 'imagem' },
            { data: 'nome' },
            { data: 'email' },
            { data: 'ativo' }
        ],
    });
});
</script>

<?php echo $this->endSection(); ?>