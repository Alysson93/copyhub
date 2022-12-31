<link rel="stylesheet" href="<?=URL?>/public/css/forms.css">
<title>CopyHub - Cadastro</title> 
<?=Sessao::mensagem('usuario')?>

	<main>
		<div class="center">
			<div class="w50 left">
				<img src="<?=URL?>/public/img/copy.jpg">
			</div>
			<form class="w50 right" method="post" action="<?=URL?>/usuarios/cadastrar">
				<h2>Cadastre-se</h2>
				<p>Criar uma conta no CopyHub é rápido, fácil e prático. Com o mínimo de informações, você já pode criar seu portfólio!.</p>
				<label for="nome">Nome:</label>
				<input type="text" name="nome" id="nome" value="<?=$dados['nome']?>" placeholder="Digite o seu nome *" required>
				<br>
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" value="<?=$dados['email']?>" placeholder="Digite o seu email *" required>
				<br>
				<label for="senha">Senha:</label>
				<input type="password" name="senha" id="senha" value="<?=$dados['senha']?>" placeholder="Digite a sua senha (Mínimo 6 caracteres) *" required>
				<br>
				<label for="confirmaSenha">Confirmar senha:</label>
				<input type="password" name="confirmaSenha" id="confirmaSenha" value="<?=$dados['confirmaSenha']?>" placeholder="Confirme a sua senha *" required>				
				<input type="submit" name="ok" value="Cadastrar">
				<p>Já tem uma conta CopyHub? Acesse clicando <a href="<?=URL?>/usuarios/login">aqui</a>.</p>
			</form>
			<div style="clear: both;"></div>		
		</div>
	</main>
