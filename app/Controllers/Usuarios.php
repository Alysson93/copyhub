<?php
	class Usuarios extends Controller {

		private $postModel;
		private $usuarioModel;


		public function __construct() {
			$this->usuarioModel = $this->model('Usuario');
			$this->postModel = $this->model('Post');
		}

		public function index() {

			if (Sessao::logado()) {
				Url::redirecionar('posts');
			}

			$dados = [
				'email' => '',
				'senha' => ''
			];

			$this->view('usuarios/login',$dados);
		}

		public function cadastrar() {

			$formulario = filter_input_array(INPUT_POST, 513, FILTER_FLAG_NO_ENCODE_QUOTES);

       		if (isset($formulario)) {
            //define os dados
	            $dados = [
	                'nome' => trim($formulario['nome']),
	                'email' => trim($formulario['email']),
	                'senha' => trim($formulario['senha']),
	                'confirmaSenha'=>trim($formulario['confirmaSenha'])
	            ];

	            //algumas validações
	            if (Checa::checarNome($formulario['nome'])) {
	            	Sessao::mensagem('usuario','Nome inválido','perigo');
	            } else if(Checa::checarEmail($formulario['email'])) {
	            	Sessao::mensagem('usuario','E-mail inválido','perigo');
	            } else if ($this->usuarioModel->checarEmail($formulario['email'])) {
	            	Sessao::mensagem('usuario','Já existe um email com este cadastro','perigo');
	            } else if(strlen($formulario['senha']) < 6) {
	            	Sessao::mensagem('usuario','A senha deve ter no mínimo 6 caracteres','perigo');
	            } else if($formulario['senha'] != $formulario['confirmaSenha']) {
	            	Sessao::mensagem('usuario','As senhas são diferentes','perigo');
	            } else {
	            	$dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);
	            	if ($this->usuarioModel->armazenar($dados)) {
	            		Sessao::mensagem('usuario', 'Cadastro realizado com sucesso');
	            		Url::redirecionar('usuarios/login');
	            		
	            	} else {
	            		die('Erro ao cadastrar');
	            	}
	            }

	        } else {
		        $dados = [
		            'nome' => '',
		            'email' => '',
		            'senha'=> '',
		            'confirmaSenha' => ''
		        ];	        	
		    }

			$this->view('usuarios/cadastrar',$dados);
		}



	    public function login()
	    {
	        //recebe os dados do formulario e os filtra
	        $formulario = filter_input_array(INPUT_POST, 513, FILTER_FLAG_NO_ENCODE_QUOTES);
	        if (isset($formulario)) {
	            $dados = [
	                'email' => trim($formulario['email']),
	                'senha' => trim($formulario['senha']),
	            ];

	            $usuario = $this->usuarioModel->checarLogin($formulario['email'], $formulario['senha']);
	                    
	            if ($usuario) {
	                $this->criarSessaoUsuario($usuario);
	            } else {
	                Sessao::mensagem('usuario', 'Usuario ou senha invalidos', 'perigo');
	            }
	        } else {
	            $dados = [
	                'email' => '',
	                'senha' => ''
	            ];
	        }
	        //define a view de login
	        $this->view('usuarios/login', $dados);
	    }





	    private function criarSessaoUsuario($usuario) {
	        //definir variáveis ​​de sessão
	        $_SESSION['usuario_id'] = $usuario->id;
	        $_SESSION['usuario_nome'] = $usuario->nome;
	        $_SESSION['usuario_email'] = $usuario->email;
	        $_SESSION['usuario_bio'] = $usuario->bio;
	        Sessao::mensagem('usuario','Bem vindo');
	        Url::redirecionar('posts');
	    }

	
	    public function sair()
	    {
	        //unset — Destrói a variável especificada
	        unset($_SESSION['usuario_id']);
	        unset($_SESSION['usuario_nome']);
	        unset($_SESSION['usuario_email']);
	        unset($_SESSION['usuario_bio']);
	        session_destroy();
	        Url::redirecionar('paginas/home');
	    }


	}
?>