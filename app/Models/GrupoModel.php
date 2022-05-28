<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupoModel extends Model
{
    protected $table            = 'grupos';
    protected $returnType       = 'App\Entities\Grupo';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nome', 'descricao', 'exibir'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    // Validation
    protected $validationRules    = [
        'nome'     => 'required|alpha_numeric_space|min_length[3]|max_length[125]|is_unique[grupos.nome]',
        'descricao'        => 'required|max_length[235]',
    ];

    protected $validationMessages = [
        'nome'        => [
            'required' => 'O campo nome é obrigatório.',
            'alpha_numeric_space' => 'O campo nome deve conter apenas letras, números e espaços.',
            'min_length' => 'O campo nome deve ter no mínimo 3 caracteres.',
            'max_length' => 'O campo nome deve ter no máximo 125 caracteres.',
        ],
        'descricao'       => [
            'required' => 'O campo descrição é obrigatório.',
            'max_length' => 'O campo descrição é deve ter no máximo 235 caracteres.',
        ],

    ];

}
