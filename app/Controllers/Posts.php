<?php

	/*
	controller cujos métodos só serão acessíveis
	a quem estiver logado no sistema.
	*/
	class Posts extends Controller {

		private $postModel;
		private $usuarioModel;
		private $favoritoModel;

		public function __construct() {
			//se o usuário não estiver logado, é redirecionado para a home.
			if (!Sessao::logado()) {
				Url::redirecionar('usuarios/login');
			}

			//definição de variáveis que usam os métodos das models
			$this->postModel = $this->model('Post');
			$this->usuarioModel = $this->model('Usuario');
			$this->favoritoModel = $this->model('Favorito');
		}


		//Método padrão que direciona o usuário a página que lista todos os posts.
		public function index() {
			$dados = [
				'posts'=> $this->postModel->lerPosts()
			];
			$this->view('posts/index',$dados);
		}

		
		
		//Função que direciona para a página de admin do usuário
		public function perfil($id) {
			//checa se o id é o mesmo do usuário logado, antes de fazer as operações.
			if ($id == $_SESSION['usuario_id']) {
				//variável que recebe os dados enviados via formulário
				$formulario = filter_input_array(INPUT_POST, 513, FILTER_FLAG_NO_ENCODE_QUOTES);
				$usuario = $this->usuarioModel->lerUsuarioPorId($id);
				//se o formulário foi preenchido, os dados do usuário serão atualizados.
				if (isset($formulario)) { 
					$dados = [ 
						'id'=>$id,
						'nome'=>trim($formulario['nome']),
						'email'=>trim($formulario['email']),
						'bio'=>trim($formulario['bio']),
						'posts'=>$this->postModel->lerPostsPorAutor($id),
						'favoritos'=>$this->favoritoModel->lerFavoritos($_SESSION['usuario_id'])			
					];
	           		
					//algumas validações, antes de editar os dados do usuário
					if ($this->usuarioModel->checarEmail($formulario['email']) && $formulario['email'] != $usuario->email) {
	            		Sessao::mensagem('post','Já existe um email com este cadastro','perigo');
	            	} else if ($this->usuarioModel->atualizar($dados)) {
	            		//armazena a foto, caso exista.
						Sessao::mensagem('post','Perfil atualizado com sucesso');
					} else {
						die('Erro ao atualizar');
					}
				//se o formulário não for preenchido, os dados não serão alterados.
				} else {
					$dados = [
						'id'=>$usuario->id,
						'nome'=>$usuario->nome,
						'email'=>$usuario->email,
						'bio'=>$usuario->bio,
						'posts'=>$this->postModel->lerPostsPorAutor($id),
						'favoritos'=>$this->favoritoModel->lerFavoritos($_SESSION['usuario_id'])
					];
				}
			//se o usuário em questão não está logado, é redirecionado para a página de posts.
			} else {
				Url::redirecionar('posts');
			}

			$this->view('posts/perfil',$dados);
		}


		
		//Função que efetua o cadastro de post
		//Direciona para a view de cadastro de post
		public function cadastrar() {

			//varíável que recebe os dados do formulário
			$formulario = filter_input_array(INPUT_POST, 513, FILTER_FLAG_NO_ENCODE_QUOTES);

			//se o formulário foi preenchido:
       		if (isset($formulario)) {
            //define os dados
	            $dados = [
	            	'id_usuario'=>$_SESSION['usuario_id'],
	                'titulo' => trim($formulario['titulo']),
	                'categoria' => trim($formulario['categoria']),
	                'texto' => trim($formulario['texto'])
	            ];

	            if ($this->postModel->armazenar($dados)) {
	            		Sessao::mensagem('post', 'Post criado com sucesso');
	            		Url::redirecionar('posts');
	            } else {
	            	die('Erro ao criar post');
	            }
	            
	        //se o formulário não foi preechido, a página de cadastro aparece sem dados
	        } else {
		        $dados = [
		            'titulo' => '',
		            'categoria' => '',
		            'texto'=> ''
		        ];	        	
		    }

			$this->view('posts/cadastrar',$dados);
		}



		//função que mostra um post em particular
		public function ver($id=0) {
			//variável que lê o post a partir do id passado via get
			$post = $this->postModel->lerPostPorId($id);

			//se o post não existe, direciona para a página de erro.
			if ($post == null) {
				Url::redirecionar('paginas/erro');
			}
			
			
			$usuario = $this->usuarioModel->lerUsuarioPorId($post->id_usuario);
			$dados = [
				'post'=>$post,
				'usuario'=>$usuario,
				'favorito' => $this->favoritoModel->checarFavorito($_SESSION['usuario_id'],$id)
			];
			$this->view('posts/ver',$dados);
		}


		//////////////////////////////////////////////////////////////////////////


		public function categoria() {

			$formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			if (isset($formulario)) {
				$dados = [
					'posts'=> $this->postModel->lerPostsPorCategoria($formulario['busca']),
					'categoria'=> $formulario['busca']
				];
			} else {
				$dados = [
					'posts'=> $this->postModel->lerPosts()
				];
				Url::redirecionar('posts');
			}

			$this->view('posts/categoria',$dados);			
		}


		//////////////////////////////////////////////////////////////////////////

		public function autor($id=0) { 

			$usuario = $this->usuarioModel->lerUsuarioPorId($id);

			if ($usuario == null) {
				Url::redirecionar('paginas/erro');
			}

			$dados = [
				'posts'=> $this->postModel->lerPostsPorAutor($id),
				'autor'=> $this->usuarioModel->lerUsuarioPorId($id)
			];

			$this->view('posts/autor',$dados);			
		}

		//////////////////////////////////////////////////////////////////////////


		public function editar($id=0) {

			$formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

       		if (isset($formulario)) {
            //define os dados
	            $dados = [
	            	'id'=> $id,
	                'titulo' => trim($formulario['titulo']),
	                'categoria' => trim($formulario['categoria']),
	                'texto' => trim($formulario['texto'])
	            ];

	            if ($this->postModel->atualizar($dados)) {
	            		Sessao::mensagem('post', 'Post atualizado com sucesso');
	            		Url::redirecionar('posts');
	            } else {
	            	die('Erro ao atualizar post');
	            }
	            

	        } else {
	        	$post = $this->postModel->lerPostPorId($id);

	        	if ($post->id_usuario != $_SESSION['usuario_id']) {
	        		Sessao::mensagem('post','Você não tem permissão para alterar esse post','perigo');
	        		Url::redirecionar('posts');
	        	}

		        $dados = [
		        	'id'=>$post->id,
		            'titulo' => $post->titulo,
		            'categoria' => $post->categoria,
		            'texto'=> $post->texto
		        ];	        	
		    }

			$this->view('posts/editar',$dados);
		}


		//////////////////////////////////////////////////////////////////////////


    	public function deletar($id) {
    		if (!$this->checarAutorizacao($id)) {
            	$id = filter_var($id, FILTER_VALIDATE_INT);
           
            	$metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
            
            	if ($id && $metodo == 'POST') {
                //chama o metodo destruir do modelo Post por seu ID
                	if ($this->postModel->destruir($id)) {
                    	Sessao::mensagem('post', 'Post deletado com sucesso!');
                    	Url::redirecionar('posts');
                    }
            	} else {
                	Sessao::mensagem('post', 'Você não tem autorização para deletar esse Post', 'perigo');
                	Url::redirecionar('posts');
            	}

        	}else {
            	Sessao::mensagem('post', 'Você não tem autorização para deletar esse Post', 'perigo');
            	Url::redirecionar('posts');
        	}
    	}


	    //////////////////////////////////////


    	public function marcarFavorito($id) {
    		if ($this->checarAutorizacao($id)) {
            	$id = filter_var($id, FILTER_VALIDATE_INT);
           
            	$metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
            
            	if ($id && $metodo == 'POST') {
                //chama o metodo destruir do modelo Post por seu ID
                	if ($this->favoritoModel->armazenar($_SESSION['usuario_id'],$id)) {
                    	Url::redirecionar('posts/ver/'.$id);
                    }
            	} else {
                	Sessao::mensagem('post', 'Você não tem autorização para marcar este Post', 'perigo');
                	Url::redirecionar('posts');
            	}

        	}else {
            	Sessao::mensagem('post', 'Você não tem autorização para marcar este Post', 'perigo');
            	Url::redirecionar('posts');
        	}
    	}

    	public function desmarcarFavorito($id) {
    		if ($this->checarAutorizacao($id)) {
            	$id = filter_var($id, FILTER_VALIDATE_INT);
           
            	$metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
            
            	if ($id && $metodo == 'POST') {
                //chama o metodo destruir do modelo Post por seu ID
                	if ($this->favoritoModel->destruir($_SESSION['usuario_id'],$id)) {
                    	Url::redirecionar('posts/ver/'.$id);
                    }
            	} else {
                	Sessao::mensagem('post', 'Você não tem autorização para marcar este Post', 'perigo');
                	Url::redirecionar('posts');
            	}

        	}else {
            	Sessao::mensagem('post', 'Você não tem autorização para marcar este Post', 'perigo');
            	Url::redirecionar('posts');
        	}
    	}


  	//////////////////////////////////////////////////////////////////////////

	    private function checarAutorizacao($id) {
	        $post = $this->postModel->lerPostPorId($id);
	        if ($post->id_usuario != $_SESSION['usuario_id']) {
	            return true;
	        } else {
	            return false;
	        }
	    }


	}
?>