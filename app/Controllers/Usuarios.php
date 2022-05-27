<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Usuario;

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

        $usuarios = $this->usuarioModel->select($atributos)
            ->withDeleted(true)
            ->orderBy('id', 'DESC')
            ->findAll();
        $data = [];
        foreach ($usuarios as $usuario) {

            // definimos qual a url para a imagem do usuário
            if($usuario->imagem) {
                $imagem = [
                    'src' => site_url("usuarios/imagem/$usuario->imagem"),
                    'alt' => esc($usuario->nome),
                    'class' => 'img-circle',
                    'width' => '40',
                    'height' => '40',
                ];
            } else {
                $imagem = [
                    'src' => site_url("inspinia/img/user.jpg"),
                    'alt' => esc($usuario->nome),
                    'class' => 'img-circle',
                    'width' => '40',
                    'height' => '40',
                ];
            }

            $data[] = [
                'imagem' => $usuario->imagem = img($imagem),
                'nome'   => anchor("/usuarios/exibir/$usuario->id", esc($usuario->nome), 'title="Exibir usuário ' . esc($usuario->nome) . '"'),
                'email'  => esc($usuario->email),
                'ativo'  => ($usuario->ativo == true ? '<i class="fa fa-unlock-alt text-success"></i> <span class="text-success">Ativo</span>' : '<i class="fa fa-lock text-danger"></i> <span class="text-danger">Inativo</span>'),
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function criar()
    {
        $usuario = new Usuario();

        $data = [
            'titulo' => "Criando novo usuário ",
            'usuario' => $usuario,
        ];

        return view('Usuarios/criar', $data);
    }

    public function cadastrar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envia o hash do token do form
        $retorno['token'] = csrf_hash();

        $post = $this->request->getPost();

        $usuario = new Usuario($post);

        if ($this->usuarioModel->protect(false)->save($usuario)) {


            $btnCriar = anchor("/usuarios/criar", 'Cadastrar Novo Usuário', ['class' => 'btn btn-success b-t-sm']);

            session()->setFlashdata('sucesso', "Usuário cadastrado com sucesso! <br> $btnCriar");

            $retorno['id'] = $this->usuarioModel->getInsertID();

            return $this->response->setJSON($retorno);
        }
        // Se chegou aqui, é porque deu erro
        $retorno['erro'] = "Favor verificar os erros de validação abaixo e tenten novamente!";
        $retorno['erros_model'] = $this->usuarioModel->errors();


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

            session()->setFlashdata('sucesso', 'Usuário atualizado com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Se chegou aqui, é porque deu erro
        $retorno['erro'] = "Favor verificar os erros de validação abaixo e tenten novamente!";
        $retorno['erros_model'] = $this->usuarioModel->errors();


        return $this->response->setJSON($retorno);
    }

    public function editarImagem(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);

        $data = [
            'titulo' => "Alterando a imagem do usuário " . esc($usuario->nome),
            'usuario' => $usuario,
        ];

        return view('Usuarios/editar_imagem', $data);
    }

    public function upload()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envia o hash do token do form
        $retorno['token'] = csrf_hash();

        $validacao = service('validation');

        $regras = [
            'imagem' => 'uploaded[imagem]|max_size[imagem,1024]|mime_in[imagem,image/jpg,image/jpeg,image/png]',
        ];

        $mensagens = [
            "imagem" => [
                "uploaded" => "Favor escolher uma imagem!",
                "max_size" => "O tamanho máximo do arquivo é 1MB!",
                "mime_in" => "O arquivo deve ser do tipo JPEG, JPG ou PNG!",
            ],
        ];

        $validacao->setRules($regras, $mensagens);

        if ($validacao->withRequest($this->request)->run() == false) {
            $retorno['erro'] = "Favor verificar os erros de validação abaixo e tenten novamente!";
            $retorno['erros_model'] = $validacao->getErrors();

            return $this->response->setJSON($retorno);
        }

        $post = $this->request->getPost();

        $usuario = $this->buscaUsuarioOu404($post['id']);

        $imagem = $this->request->getFile('imagem');

        list($largura, $altura) = getimagesize($imagem->getPathName());

        if ($largura < "300" || $altura < "300") {
            $retorno['erro'] = "A imagem deve ter no mínimo 300x300 pixels!";
            $retorno['erros_model'] = ["Dimensão" => 'A imagem não pode ser menor do que 300x300 pixels!'];

            return $this->response->setJSON($retorno);
        }


        $caminhoImagem = $imagem->store('usuarios');

        $caminhoImagem = WRITEPATH . "uploads/$caminhoImagem";


        $this->manipulaImagem($caminhoImagem, $usuario->id);


        $imagemAntiga = $usuario->imagem;

        $usuario->imagem = $imagem->getName();

        $this->usuarioModel->save($usuario);

        if ($imagemAntiga != null) {
            $this->removeImagemDoFileSystem($imagemAntiga);
        }

        session()->setFlashdata('sucesso', 'Imagem de usuário atualizada com sucesso!');

        return $this->response->setJSON($retorno);
    }

    public function imagem(string $imagem = null)
    {
        if($imagem != null) {
            $this->exibeArquivo('usuarios', $imagem);
        }
    }

    public function excluir(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);

        if($this->request->getMethod() == 'post') {

            $this->usuarioModel->delete($usuario->id);
            
            if($usuario->imagem != null) {

                $this->removeImagemDoFileSystem($usuario->imagem);
            }

            $usuario->imagem = null;
            $usuario->ativo = false;

            $this->usuarioModel->protect(false)->save($usuario);

            return redirect()->to(site_url('usuarios'))->with('sucesso', "Usuário $usuario->nome excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o usuário " . esc($usuario->nome),
            'usuario' => $usuario,
        ];

        return view('Usuarios/excluir', $data);
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

    /**
     * Método que excluir imagem do usuário
     * @param string $imagem
     */
    public function removeImagemDoFileSystem(string $imagem)
    {
        $caminhoImagem = WRITEPATH . "uploads/usuarios/$imagem";

        if (is_file($caminhoImagem)) {
            unlink($caminhoImagem);
        }
    }


    /**
     * Método que Manipula Imagem do usuário
     * @param string $caminhoImagem
     * @param string $IdUsuario
     */
    public function manipulaImagem(string $caminhoImagem, int $usuario_id)
    {
        service('image')
            ->withFile($caminhoImagem)
            ->fit(300, 300, 'center')
            ->save($caminhoImagem);


        $anoAtual = date('Y');

        \Config\Services::image('imagick')
            ->withFile($caminhoImagem)
            ->text("CoreBase $anoAtual - User-ID $usuario_id", [
                'color'      => '#fff',
                'opacity'    => 0.5,
                'withShadow' => false,
                'hAlign'     => 'center',
                'vAlign'     => 'bottom',
                'fontSize'   => 12,
            ])
            ->save($caminhoImagem);
    }
}
