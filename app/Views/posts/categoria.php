<title>CopyHub - Posts</title>
<link rel="stylesheet" href="<?=URL?>/public/css/posts.css">

<?=Sessao::mensagem('post')?>

<div class="center">
<section id="chamada">
		<h1>Postagens relacionadas a <?=$dados['categoria']?></h1>
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
		<?php if (count($dados['posts']) == 0) { ?> 
			<article class="noFound">
				Não encontramos nenhum texto com este tema :(
			</article>
		<?php } else {
		foreach ($dados['posts'] as $post) { ?>
		<article>
			<h3><?=$post->titulo?></h3>
			<h4><?=$post->categoria?></h4>
			<small>Criado por <a href="<?=URL?>/posts/autor/<?=$post->usuarioId?>"><?=$post->nome?> (<?=$post->email?>)</a> em <?=date('d/m/Y H:i',strtotime($post->postData))?></small>
			<br><br>
			<p><?=substr($post->texto,0,700)?>...</p>
			<br>
			<a class="lerMais" href="<?=URL.'/posts/ver/'.$post->postId?>">Ler mais</a>
			<br><br>
		</article>
		<br><br>
		<?php } } ?>
</main> 
</div>

<style>
	main {
		min-height: 55vh;
	}
</style>