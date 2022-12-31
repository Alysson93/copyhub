<link rel="stylesheet" href="<?=URL?>/public/css/forms.css">
<title>CopyHub - Login</title>
<?=Sessao::mensagem('usuario')?>

	<main>
		<div class="center">
			<div class="w50 right">
				<img src="<?=URL?>/public/img/start.jpg">
			</div>
			<form class="w50 right" method="post" action="<?=URL?>/usuarios/login">
				<h2>Login</h2>
				<br><br>
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" value="<?=$dados['email']?>" placeholder="Digite o seu email" required>
				<br>
				<label for="senha">Senha:</label>
				<input type="password" name="senha" id="senha" value="<?=$dados['senha']?>" placeholder="Digite a sua senha" required>
				<br>			
				<input type="submit" name="ok" value="Login">
				<p>Caso ainda não tenha conta CopyHub, cadastre-se <a href="<?=URL?>/usuarios/cadastrar">aqui</a>.</p>
			</form>
			<div style="clear: both;"></div>		
		</div>
	</main>