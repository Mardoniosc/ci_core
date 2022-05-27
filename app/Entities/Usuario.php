<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Usuario extends Entity
{
    protected $dates   = ['criado_em', 'atualizado_em', 'deletado_em'];

    public function exibeSituacao()
    {
        if ($this->deletado_em != null) {
            $icone = '<span class="badge badge-danger">Excluído</span>&nbsp; <i class="fa fa-undo"></i>Desfazer';
            $situacao = anchor("/usuarios/desfazerexclusao/$this->id", $icone, ['class' => 'btn text-danger btn-outline btn-sm']);

            return $situacao;
        }

        if($this->ativo == true) {
            return '<i class="fa fa-unlock-alt text-success"></i> <span class="text-success">Ativo</span>';
        }

        return  '<i class="fa fa-lock text-danger"></i> <span class="text-danger">Inativo</span>';
    }
}
