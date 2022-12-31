	<header>
		<div class="center">
			<div class="logo left">
				<?php if (isset($_SESSION['usuario_id'])) { ?>
				<a href="<?=URL?>/posts">COPYHUB</a>
				<?php } else { ?>
				<a href="<?=URL?>/paginas">COPYHUB</a>
				<?php } ?>
			</div>
			<div class="desktop right">
				<ul>
					<?php if (isset($_SESSION['usuario_id'])) { ?>
					<li><a href="<?=URL?>/posts">Posts</a></li>
					<li><a href="<?=URL?>/posts/perfil/<?=$_SESSION['usuario_id']?>"><i class="fa fa-user"></i> <?=$_SESSION['usuario_nome']?></a></li>
					<li><a href="<?=URL?>/usuarios/sair">Sair</a></li>
					<?php } else { ?>
					<li><a href="<?=URL?>/paginas">Home</a></li>
					<li><a href="<?=URL?>/paginas#descricao">Sobre</a></li>
					<li><a href="<?=URL?>/usuarios/cadastrar">Cadastre-se</a></li>
					<li><a href="<?=URL?>/usuarios/login">Login</a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="mobile right">
				<i class="fa fa-bars"></i>
				<ul>
					<?php if (isset($_SESSION['usuario_id'])) { ?>
					<li><a href="<?=URL?>/posts">Posts</a></li>
					<li><a href="<?=URL?>/posts/perfil/<?=$_SESSION['usuario_id']?>"><?=$_SESSION['usuario_nome']?></a></li>
					<li><a href="<?=URL?>/usuarios/sair">Sair</a></li>
					<?php } else { ?>
					<li><a href="<?=URL?>/paginas">Home</a></li>
					<li><a href="<?=URL?>/paginas#descricao">Sobre</a></li>
					<li><a href="<?=URL?>/usuarios/cadastrar">Cadastre-se</a></li>
					<li><a href="<?=URL?>/usuarios/login">Login</a></li>
					<?php } ?>
				</ul>
			</div>
		<div style="clear: both;"></div>
		</div>
	</header>