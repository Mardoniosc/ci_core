<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Usuarios extends BaseController
{

    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new \App\Models\UsuarioModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Listando Usuários',
        ];

        return view('Usuarios/index', $data);
    }

    public function recuperaUsuarios() {

        if(!$this->request->isAJAX()) {
            // return redirect()->back();
        }

        $atributos = [
            'id',
            'nome',
            'email',
            'ativo',
            'imagem',
        ];

        $usuarios = $this->usuarioModel->select($atributos)->findAll();
        $data = [];
        foreach ($usuarios as $usuario) {
            $data[] = [
                'id' => $usuario->id,
                'imagem' => $usuario->imagem,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'ativo' => ($usuario->ativo == 't' ? 'Ativo' : '<span class="text-danger">Inativo</span>'),
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }
}
