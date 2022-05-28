<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo'); ?>
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('estilos'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo site_url('inspinia/css/datatables.min.css'); ?>" />

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">

      
      <a href="<?php echo site_url('grupos/criar')?>" class="btn btn-primary pull-right m-b-n-md">+ Adicionar Novo Grupo</a>
      <div class="ibox-content">

        <table id="ajaxTable" class="table table-striped" style="width: 100%;">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Descrição</th>
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

<script type="text/javascript" src="<?php echo site_url('inspinia/js/datatables.min.js'); ?>"></script>

<script>
  $(document).ready(function() {

    const DATATABLE_PTBR = {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      },
      "select": {
        "rows": {
          "_": "Selecionado %d linhas",
          "0": "Nenhuma linha selecionada",
          "1": "Selecionado 1 linha"
        }
      },
      "processing": "<span class='sr-only'>Loading...</span>",
    }

    $('#ajaxTable').DataTable({
      "language": DATATABLE_PTBR,
      ajax: '<?php echo site_url('grupos/recuperagrupos'); ?>',
      columns: [
        {
          data: 'nome'
        },
        {
          data: 'descricao'
        },
        {
          data: 'exibir'
        }
      ],
      "deferRender": true,
      "processing": true,
      "responsive": true,
      "pagingType": $(window).width() < 768 ? 'simple' : 'simple_numbers',
    });
  });
</script>

<?php echo $this->endSection(); ?>