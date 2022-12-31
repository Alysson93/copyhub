<?=Sessao::mensagem('post')?>
<link rel="stylesheet" href="<?=URL?>/public/css/perfil.css">
<title>CopyHub - Painél de Controle</title>

	<aside>
		<h2>Olá, <?=$dados['nome']?>!</h2>
		<a href="#" onclick="mostraMeusTextos()">Minhas copys</a>
		<a href="#" onclick="mostraFavoritos()">Copys Favoritas</a>
		<a href="<?=URL?>/posts/cadastrar">Criar nova copy</a>
		<a href="#" onclick="mostraForm()">Configurar conta</a>
	</aside>

	<section id="meusTextos" class="conteudo">
		<div class="center">
			<h1>Minhas copys</h1>
			<?php foreach ($dados['posts'] as $post) { ?>
			<div class="bloco">
				<h3><?=$post->titulo?></h3>
				<p><?=substr($post->texto,0,500)?>...</p>
				<br>
				<a class="lerMais" href="<?=URL?>/posts/ver/<?=$post->postId?>">Ler mais</a>
			</div>
			<?php } ?>
	</section>


	<section class="conteudo" id="favoritos">
		<div class="center">
			<h1>Favoritos</h1>
			<?php foreach ($dados['favoritos'] as $post) { ?>
			<div class="bloco">
				<h3><?=$post->titulo?></h3>
				<p><?=substr($post->texto,0,500)?>...</p>
				<br>				
				<a class="lerMais" href="<?=URL?>/posts/ver/<?=$post->id?>">Ler mais</a>
			</div>
			<?php }  ?>
		</div>
	</section>



	<section class="conteudo" id="conf">
		<div class="center">
			<form method="post" action="<?=URL?>/posts/perfil/<?=$_SESSION['usuario_id']?>" enctype="multipart/form-data">
				<h1>Configurar dados</h1>
				<label for="nome">Nome:</label><br>
				<input type="text" name="nome" id="nome" value="<?=$dados['nome']?>" required><br><br>
				<label for="email">Email:</label><br>
				<input type="email" name="email" id="email" value="<?=$dados['email']?>" required><br><br>
				<label for="bio">Bio:</label><br>
				<textarea name="bio" id="bio">
					<?=$dados['bio']?>
				</textarea><br>
				<br><br>
				<input type="submit" name="ok" value="Editar dados">
			</form>
		</div>
	</section>

	<div style="clear: both;"></div>



	<script>
		function mostraMeusTextos() {
			document.getElementById("meusTextos").style.display = "block"
			document.getElementById("favoritos").style.display = "none"
			document.getElementById("conf").style.display = "none"
		}

		function mostraFavoritos() {
			document.getElementById("meusTextos").style.display = "none"
			document.getElementById("favoritos").style.display = "block"
			document.getElementById("conf").style.display = "none"
		}

		function mostraForm() {
			document.getElementById("meusTextos").style.display = "none"
			document.getElementById("favoritos").style.display = "none"
			document.getElementById("conf").style.display = "block"
		}
	</script>

