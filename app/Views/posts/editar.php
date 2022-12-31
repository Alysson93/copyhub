<link rel="stylesheet" href="<?=URL?>/public/css/forms.css">
<link rel="stylesheet" href="css/forms.css">
<title>CopyHub - Editar post</title>

	<main>
		<div class="center">
			<form method="post" action="<?=URL?>/posts/editar/<?=$dados['id']?>">
				<h2>Editar post</h2>
				<br><br>
				<label for="titulo">Título:</label>
				<input type="text" id="titulo" name="titulo" value="<?=$dados['titulo']?>" placeholder="Título" required>
				<br><br>
				<label for="categoria">Categoria:</label>
				<input type="text" id="categoria" name="categoria" value="<?=$dados['categoria']?>" placeholder="Defina uma palavra chave para o seu texto" required>
				<br><br>
				<label for="texto">Texto:</label>
				<textarea id="texto" name="texto"><?=$dados['texto']?></textarea>
				<br>			
				<input type="submit" name="ok" value="Editar post">
			</form>
			<div style="clear: both;"></div>		
		</div>
	</main>

