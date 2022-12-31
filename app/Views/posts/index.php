<title>CopyHub - Posts</title>
<link rel="stylesheet" href="<?=URL?>/public/css/posts.css">

<?=Sessao::mensagem('post')?>


<h1 class="center" style="text-align: center; padding: 30px 0 15px 0;">
	Bem-vindo(a), <?=$_SESSION['usuario_nome']?>!
</h1>

<div class="center">
<section id="chamada">
		<h1>Postagens mais recentes</h1>	
</section>
<section id="motor">
	<form method="post" action="<?=URL?>/posts/categoria">
		<label for="busca">Qual o assunto que você quer ler hoje?</label>
		<input type="text" name="busca" id="busca" required>
		<input type="reset" value="X">
		<input type="submit" name="ok" value="Pesquisar">
	</form>
</section>
<main>
		<?php foreach ($dados['posts'] as $post) { ?>
		<article>
			<h3><?=$post->titulo?></h3>
			<h4><?=$post->categoria?></h4>
			<small>Criado por <a href="<?=URL?>/posts/autor/<?=$post->usuarioId?>"><?=$post->nome?> (<?=$post->email?>) </a> em <?=date('d/m/Y H:i',strtotime($post->postData))?></small>
			<br><br>
			<p><?=substr($post->texto,0,700)?>...</p>
			<br>
			<a class="lerMais" href="<?=URL.'/posts/ver/'.$post->postId?>">Ler mais</a>
			<br><br>
		</article>
		<br><br>
		<?php } ?>
</main> 
</div>

<style>
	main {
		min-height: 50vh;
	}
</style>