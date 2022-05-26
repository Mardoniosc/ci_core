<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="row">
  <div class="col-lg-4 panel">
    <div class="panel-body">
      <div class="text-center">
        <?php if ($usuario->imagem == null) : ?>
          <img src="<?php echo site_url('inspinia/img/user.jpg'); ?>" alt="Usuário sem imagem" class="card-img-top" style="width: 90%;">

        <?php else : ?>

          <img src="<?php echo site_url("usuarios/imagem/$usuario->imagem"); ?>" alt="<?php echo $usuario->nome; ?>" class="card-img-top" style="width: 90%;">
        <?php endif; ?>
        <a class="btn btn-outline btn-primary btn-sm m-t-md" href="<?php echo site_url("usuarios/editarimagem/$usuario->id"); ?>">Alterar Imagem</a>
      </div>

      <hr class="hr-line-solid">

      <h5 class="card-title m-t-sm"><?php echo esc($usuario->nome); ?></h5>
      <p class="card-text"><?php echo esc($usuario->email); ?></p>
      <p class="card-text"><strong>Status: </strong> <?php echo $usuario->ativo == 't' ? 'Ativo' : 'Invativo' ; ?></p>
      <p class="card-text"><strong>Criado:</strong> <?php echo $usuario->criado_em->humanize(); ?></p>
      <p class="card-text"><strong>Atualizado:</strong> <?php echo $usuario->atualizado_em->humanize(); ?></p>

      <div class="row">
        <div class="col-lg-2">
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Ações
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="<?php echo site_url("usuarios/editar/$usuario->id"); ?>">Editar Usuário</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo site_url("usuarios/excluir/$usuario->id"); ?>">Excluir Usuário</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-1">
          <a href="<?php echo site_url("usuarios");?>" class="btn btn-info">Voltar</a>
        </div>
      </div>

    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<?php echo $this->endSection(); ?>