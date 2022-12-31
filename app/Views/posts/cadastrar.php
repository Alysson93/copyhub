<link rel="stylesheet" href="<?=URL?>/public/css/forms.css">
<title>CopyHub - Criar novo post</title>
<?=Sessao::mensagem('post')?>

	<main>
		<div class="center">
			<form  method="post" action="<?=URL?>/posts/cadastrar">
				<h2>Criar nova copy</h2>
				<p>Artigos, críticas, resenhas, crônicas, o céu é o limite!<br>
				Dê asas a sua imaginação!</p>
				<label for="titulo">Título:</label>
				<input type="text" id="titulo" name="titulo" value="<?=$dados['titulo']?>" placeholder="Título" required>
				<br><br>
				<label for="categoria">Categoria:</label>
				<input type="text" id="categoria" name="categoria" value="<?=$dados['categoria']?>" placeholder="Defina uma palavra chave para o seu texto" required>
				<br><br>
				<label for="texto">Texto:</label>
				<textarea id="texto" name="texto">
					<?=$dados['texto']?>
				</textarea>
				<br>			
				<input type="submit" name="ok" value="Criar post">
			</form>
			<div style="clear: both;"></div>		
		</div>
	</main>

