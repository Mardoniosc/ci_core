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

      <?php echo form_open_multipart('/', ['id' => 'form'], ['id' => "$usuario->id"]) ?>


      <div class="form-group">
        <label>Escolha uma imagem</label>
        <input type="file" class="form-control" name="imagem">
      </div>

      <div class="form-group m-t-md m-b-sm">

        <input type="submit" id="btn-salva" class="btn btn-primary btn-sm m-r-sm" value="Salvar">

        <a href="<?php echo site_url("usuarios/exibir/$usuario->id"); ?>" class="btn btn-info btn-sm">Voltar</a>
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

<script>
  $(document).ready(function() {
    $('#form').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('usuarios/upload'); ?>",
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          $('#response').html('');
          $('#btn-salva').val('Salvando...');
          $('#btn-salva').attr('disabled', true);
        },
        success: function(response) {
          $('#btn-salva').val('Salvar');
          $('#btn-salva').removeAttr('disabled');
          $('#response').html(response.response);
          $("[name=csrf_core]").val(response.token);

          if (!response.erro) {
            window.location.href = "<?php echo site_url("usuarios/exibir/$usuario->id"); ?>";
          }

          if (response.erro) {
            $('#response').html('<div class="alert alert-danger"> ' + response.erro + ' </div>');
            if (response.erros_model) {
              $.each(response.erros_model, function(key, value) {
                $('#response').append('<ul class="list-unstyled"><li class="text-danger">' + value + '</li></ul>');
              });
            }
          }
        },
        error: function(response) {
          alert("Erro 403 de bakcend ao processar sua requisição");
          $('#btn-salva').val('Salvar');
          $('#btn-salva').removeAttr('disabled');
        }
      });
    });

    $('#form').submit(function(e) {
      $(this).find(':submit').attr('disabled', 'disabled');
    });
  });
</script>


<?php echo $this->endSection(); ?>