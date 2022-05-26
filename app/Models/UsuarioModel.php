<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'nome',
        'email',
        'password',
        'reset_hash',
        'reset_expira_em',
        'imagem',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    // Validation
    protected $validationRules    = [
        'nome'     => 'required|alpha_numeric_space|min_length[3]|max_length[125]',
        'email'        => 'required|valid_email|is_unique[usuarios.email]|max_length[235]',
        'password'     => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]',
    ];

    protected $validationMessages = [
        'nome'        => [
            'required' => 'O campo nome é obrigatório.',
            'alpha_numeric_space' => 'O campo nome deve conter apenas letras, números e espaços.',
            'min_length' => 'O campo nome é deve ter no mínimo 3 caracteres.',
            'max_length' => 'O campo nome é deve ter no máximo 125 caracteres.',
        ],

        'email'        => [
            'required' => 'O campo email é obrigatório.',
            'valid_email' => 'O campo email deve ser um email válido.',
            'is_unique' => 'O email informado já está cadastrado.',
        ],
        'password'     => [
            'required' => 'O campo senha é obrigatório.',
            'min_length' => 'O campo senha deve ter no mínimo 6 caracteres.',
        ],
        'password_confirmation' => [
            'required_with' => 'O campo confirmação de senha é obrigatório.',
            'matches' => 'O campo confirmação de senha deve ser igual ao campo senha.',
        ],
    ];


    // Callbacks
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }
}
