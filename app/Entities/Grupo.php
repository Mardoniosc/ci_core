<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Grupo extends Entity
{
    protected $dates   = ['criado_em', 'atualizado_em', 'deletado_em'];

    public function exibeSituacao()
    {
        if ($this->deletado_em != null) {
            $icone = '<span class="badge badge-danger">Excluído</span>&nbsp; <i class="fa fa-undo"></i>Desfazer';
            $situacao = anchor("grupos/desfazerexclusao/$this->id", $icone, ['class' => 'btn text-danger btn-outline btn-sm']);

            return $situacao;
        }

        if($this->exibir == true) {
            return '<i class="fa fa-eye text-success"></i> &nbsp;Exibir grupo';
        }

        return  '<i class="fa fa-eye-slash text-danger"></i> &nbsp;Não exibir grupo';
    }
}
