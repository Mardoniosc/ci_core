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
      <div class="tooltip-demo" style="display: flex; flex-direction: row; align-items: center;">
      <p class="card-text"><strong>Status: </strong> <?php echo $grupo->exibeSituacao(); ?>
        <?php if ($grupo->deletado_em == null) : ?>
            <a
              style="background: none; border: none; outline: none; position: relative; top: -10px; margin-left: 5px;"  
              data-toggle="tooltip" 
              data-placement="top" 
              title="Importante! Esse grupo <?php echo $grupo->exibir == true ? 'será' : 'não será';?> exibido como opção na hora de definir um Responsável técnico pela ordem de serviço.">
              <h1><i class="fa fa-question-circle "></i></h1>
        </a>
          <?php endif; ?>
        </p>
      </div>
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