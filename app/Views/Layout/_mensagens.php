<?php if (session()->has('sucesso')) : ?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <strong>Sucesso!</strong> <?php echo session('sucesso'); ?>
  </div>
<?php endif; ?>

<?php if (session()->has('info')) : ?>
  <div class="alert alert-info alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <strong>Informação!</strong> <?php echo session('info'); ?>
  </div>
<?php endif; ?>

<?php if (session()->has('atencao')) : ?>
  <div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <strong>Atenção!</strong> <?php echo session('atencao'); ?>
  </div>
<?php endif; ?>

<?php if (session()->has('erros_model')) : ?>
  <ul>
    <?php foreach ($erros_model as $erro) : ?>
      <li class="text-danger"><?php echo $erro; ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>


<?php if (session()->has('error')) : ?>
  <div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <strong>Error!</strong> <?php echo session('error'); ?>
  </div>
<?php endif; ?>