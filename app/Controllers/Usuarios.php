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

    public function recuperaUsuarios()
    {

        if (!$this->request->isAJAX()) {
            return redirect()->back();
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
                'imagem' => $usuario->imagem,
                'nome'   => anchor("/usuarios/exibir/$usuario->id", esc($usuario->nome), 'title="Exibir usuário ' . esc($usuario->nome) . '"'),
                'email'  => esc($usuario->email),
                'ativo'  => ($usuario->ativo == 't' ? '<i class="fa fa-unlock-alt text-success"></i> <span class="text-success">Ativo</span>' : '<i class="fa fa-lock text-danger"></i> <span class="text-danger">Inativo</span>'),
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function exibir(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);

        $data = [
            'titulo' => "Detalhando o usuário " . esc($usuario->nome),
            'usuario' => $usuario,
        ];

        return view('Usuarios/exibir', $data);
    }

    public function editar(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);

        $data = [
            'titulo' => "Editando o usuário " . esc($usuario->nome),
            'usuario' => $usuario,
        ];

        return view('Usuarios/editar', $data);
    }

    public function atualizar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envia o hash do token do form
        $retorno['token'] = csrf_hash();

        $post = $this->request->getPost();

        $usuario = $this->buscaUsuarioOu404($post['id']);

        if (empty($post['password'])) {
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        // Preenchemos os atributos do usuário com os valores do POST
        $usuario->fill($post);


        if ($usuario->hasChanged() == false) {

            $retorno['info'] = "Nenhum dados do usuário foi alterado!";
            return $this->response->setJSON($retorno);
        }

        if ($this->usuarioModel->protect(false)->save($usuario)) {
            return $this->response->setJSON($retorno);
        }

        // Se chegou aqui, é porque deu erro
        $retorno['erro'] = "Favor verificar os erros de validação abaixo e tenten novamente!";
        $retorno['erros_model'] = $this->usuarioModel->errors();


        return $this->response->setJSON($retorno);
    }

    /**
     * Método que recupera os dados do usuário
     * @param int $id
     * @return Exception|object
     * 
     */
    private function buscaUsuarioOu404(int $id = null)
    {
        if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuário não encontrado:  $id");
        }

        return $usuario;
    }
}
