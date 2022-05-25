<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioFakerSeeder extends Seeder
{
    public function run()
    {
        $usuarioModel = new \App\Models\UsuarioModel();

        $faker = \Faker\Factory::create();

        $criarQuantosUsuarios = 20000;

        $usuariosPush = [];

        for ($i = 0; $i < $criarQuantosUsuarios; $i++) {
            array_push($usuariosPush, [
                'nome' => $faker->unique()->name,
                'email' => $faker->unique()->email,
                // 'password_hash' => password_hash('123456', PASSWORD_DEFAULT),
                'password_hash' => '123456',
                'ativo' => $faker->boolean(),
            ]);
        }

        $usuarioModel->skipValidation(true)
                        ->protect(false)
                        ->insertBatch($usuariosPush);

        echo "$criarQuantosUsuarios Usuários criados com sucesso!";
    }
}
