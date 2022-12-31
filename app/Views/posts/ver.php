<link rel="stylesheet" href="<?=URL?>/public/css/artigo.css">
<title><?=$dados['post']->titulo?></title>

<div class="center">
<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <section class="botoes">
      <?php if ($dados['usuario']->id == $_SESSION['usuario_id']) { ?>
              <a class="botao verde left" href="<?=URL?>/posts/editar/<?=$dados['post']->id?>">Editar copy</a>  
              <a class="botao vermelho left" onclick="document.getElementById('id01').style.display='block'">Excluir copy</a>
              <div style="clear: both;"></div> 
      <?php } else if ($dados['favorito']) { ?>
              <form method="post" action="<?=URL?>/posts/desmarcarFavorito/<?=$dados['post']->id?>">
                <input class="botao azul" type="submit" name="ok" value="Desmarcar favorito">
              </form>   
      <?php } else if (!$dados['favorito']) { ?>
              <form method="post" action="<?=URL?>/posts/marcarFavorito/<?=$dados['post']->id?>">
                <input class="botao azul" type="submit" name="ok" value="Marcar como favorito">
              </form>  
      <?php } ?>
      </section> 
      <br> 
      <h6><?=$dados['post']->categoria?></h6>
      <br>
      <h2><?=$dados['post']->titulo?></h2>
      <br>
      <h5>Escrito por <?=$dados['usuario']->nome?>, <?=date('d/m/Y H:i',strtotime($dados['post']->criado_em))?></h5>
      <br>
      <p><?=$dados['post']->texto?></p>
    </div>
  </div>


  <div class="rightcolumn">
    <div class="card">
      <h2>Sobre o autor</h2>
      <!--
      <div class="fakeimg" style="height:100px;">Image</div> -->
      <p><a href="<?=URL?>/posts/autor/<?=$dados['usuario']->id?>"><?=$dados['usuario']->email?></p></a>
      <br>
      <p><?=$dados['usuario']->bio != '' ? $dados['usuario']->bio : 'Usuário sem descrição'?></p>
    </div>
  </div>
</div>
</div>


<!-------------------- modal -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <div class="modal-content">
    <div class="container">
      <h1>Você está prestes a deletar esta copy.</h1>
      <br>
      <p>Uma vez deletada, sua copy também não ficará disponível para nenhum usuário.</p>
      <p>Tem certeza que deseja continuar com esta operação?</p>
      <br>
        <form method="post" action="<?=URL?>/posts/deletar/<?=$dados['post']->id?>">
            <input class="botao vermelho right" type="submit" name="ok" value="Deletar copy">
            <input class="botao verde right" onclick="document.getElementById('id01').style.display='none'" type="reset" name="cancelar" value="Cancelar">
            <div style="clear: both;"></div>
        </form>   
    </div>
  </div>
</div>
<!-------------------------->



<style>

  .botao {
    padding: 10px;
    margin: 5px;
    color: #fff;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    text-transform: uppercase;
    font-size: 10px;
  }

  .azul {
    background-color: blue;
  }

  .verde {
    background-color: green;

  }

  .vermelho {
    background-color: red;
  }

  .row {
    min-height: 80vh;
  }

/* Add padding and center-align text to the container */
.container {
  padding: 16px;
  text-align: center;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* The Modal Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

@media screen and (max-width: 700px) {
  .modal-content {
    width: 80%;
  }
</style>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script> 
