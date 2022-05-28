<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GrupoTempSeeder extends Seeder
{
    public function run()
    {
        $grupoModel = new \App\Models\GrupoModel();

        $grupos = [
            [ // ID 1 usuário master
                'nome' => 'Administrador',
                'descricao' => 'Grupo de acesso total ao sistema.',
                'exibir' => false,
            ],
            [ // ID 2 usuários clientes
                'nome' => 'Clientes',
                'descricao' => 'Esse grupo é destinado para atribuição de clientes, pois os mesmo poderão logar no sistema para acesso as suas ordems de serviço.',
                'exibir' => true,
            ],
            [
                'nome' => 'Atendentes',
                'descricao' => 'Grupo para atendimentos dos clientes pelos funcionários.',
                'exibir' => true,
            ],
        ];

        foreach ($grupos as $grupo) {
            $grupoModel->insert($grupo);
        }

        echo "Grupos criados com sucesso!";
    }
}
