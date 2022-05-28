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
      <h5 class="card-title m-t-sm"><?php echo esc($grupo->nome); ?></h5>
      <p class="card-text"><strong>Descrição:</strong> <?php echo esc($grupo->descricao); ?></p>
      <p class="card-text"><strong>Status: </strong> <?php echo $grupo->exibeSituacao(); ?></p>
      <p class="card-text"><strong>Criado:</strong> <?php echo $grupo->criado_em->humanize(); ?></p>
      <p class="card-text"><strong>Atualizado:</strong> <?php echo $grupo->atualizado_em->humanize(); ?></p>

      <div class="row">
        <div class="col-lg-3">
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Ações
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <?php if ($grupo->deletado_em == null) : ?>
                <li><a href="<?php echo site_url("grupos/editar/$grupo->id"); ?>">Editar Grupo</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo site_url("grupos/excluir/$grupo->id"); ?>">Excluir Grupo</a></li>
              <?php else : ?>
                <li><a href="<?php echo site_url("grupos/desfazerexclusao/$grupo->id"); ?>">Restaurar Grupo</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
        <div class="col-lg-2">
          <a href="<?php echo site_url("grupos"); ?>" class="btn btn-info">Voltar</a>
        </div>
      </div>

    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<?php echo $this->endSection(); ?>