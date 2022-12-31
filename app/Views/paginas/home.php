<link rel="stylesheet" href="<?=URL?>/public/css/index.css">
<title>CopyHub - Página inicial</title>
<?=Sessao::mensagem('usuario')?>

<?php if (!isset($_SESSION['usuario_id'])) { ?>
	<main>
		<div class="banner" style="background-image: url('<?=URL?>/img/wallpaper1.jpg');"></div>
		<div class="banner" style="background-image: url('<?=URL?>/img/wallpaper2.jpg');"></div>
		<div class="overlay"></div>
		<div class="center">
			<form method="post" action="<?=URL?>/usuarios/login">
				<h2>As melhores copys, você encontra aqui!</h2>
				<input type="email" name="email" placeholder="E-mail" required>
				<input type="password" name="senha" placeholder="Senha" required>
				<input type="submit" name="ok" value="Logar">
			</form>
		</div>
		<div class="bullets">
			
		</div>
	</main>
<?php } ?>


	<section id="descricao">
		<div class="center">
			<div class="w50 left">
				<h2>Sobre o CopyHub</h2>
				<p>CopyHub é uma rede social de criação e divulgação de copys. É um espaço tanto para pesquisa dos mais variados temas quanto criação de portfólio para redatores e copywriters que desejam divulgar seus trabalhos para agências de publicidade ou clientes em geral.   </p>
				<p>Em sua primeira versão, o projeto foi desenvolvido como requisito do curso de Engenharia de Software do Instituto Federal de Pernambuco (Campus Belo Jardim) para as disciplinas "Desenvolvimento web", "Interação Humano - Máquina" e "Projeto de Software".</p>
			</div>
			<div class="w50 left">
				<img src="<?=URL?>/public/img/note.jpg" class="right" alt="imagem de um notebook">
			</div>
			<div style="clear: both;"></div>
		</div>
	</section>

	<section id="cursos">
		<div class="center">
			<h2>Como usar o CopyHub?</h2>
			<div class="w33 left especialidade">
				<h3><i class="fa fa-sticky-note"></i></h3>
				<h4>Cadastre-se</h4>
				<p>Fazer o seu cadastro é bem simples! Você só precisa de um e-mail e de uma senha (mínimo 6 caracteres). Lembre-se que é por meio deste e-mail que seu trabalho será divulgado então de preferência, use o seu email profissional.</p>
			</div>
			<div class="w33 left especialidade">
				<h3><i class="fa fa-headphones"></i></h3>
				<h4>Acesse a sua conta</h4>
				<p>Agora que você já está cadastrado no CopyHub, acesse a sua conta usando o email e senha que você cadastrou. Você será direcionado a uma página com as postagens recentes e terá acesso a um universo dos mais variados textos.</p>
			</div>
			<div class="w33 left especialidade">
				<h3><i class="fa fa-music"></i></h3>
				<h4>Divulgue seu trabalho</h4>
				<p>Caso você seja um redator, você pode encontrar aqui, inspiração para criar seus próprios textos ou até divulgar o seu trabalho para que a comunidade CopyHub também leia os seus textos e, quem sabe, entre em contato para criar parcerias comerciais. </p>
			</div>
			<div style="clear: both;"></div>
		</div>
	</section>

