<?php

class Post
{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function armazenar($dados) {
        $this->db->query("INSERT INTO posts(id_usuario,titulo, categoria, texto) VALUES (:id, :titulo, :categoria, :texto)");

        $this->db->bind(":id",$dados['id_usuario']);
        $this->db->bind(":titulo", $dados['titulo']);
        $this->db->bind(":categoria", $dados['categoria']);
        $this->db->bind(":texto", $dados['texto']);

        if ($this->db->executa()) {
            return true;
        }
        else {
            return false;
        }
    }


    public function lerPosts() {
        $this->db->query("SELECT *,
            usuarios.criado_em as usuarioData, 
            posts.criado_em as postData,
            posts.id_usuario as postIdUser,
            usuarios.id as usuarioId,
            posts.id as postId,
            usuarios.criado_em as usuarioData 
            from posts inner join usuarios
            on posts.id_usuario = usuarios.id
            order by posts.id desc");
        return $this->db->resultados();
    }

    public function atualizar($dados)
    {
        $this->db->query("UPDATE posts SET titulo = :titulo, categoria = :categoria, texto = :texto WHERE id = :id");

        $this->db->bind("id", $dados['id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("categoria", $dados['categoria']);
        $this->db->bind("texto", $dados['texto']);

        if ($this->db->executa()) :
            return true;
        else :
            return false;
        endif;
    }

    //primeiro deleta todas as linhas da tabela favoritos que têm o id do post que se deseja deletar.
    //depois, deleta o post desejado.
    public function destruir($id) {
        $this->db->query("DELETE FROM favoritos where id_post = :id");
        $this->db->bind(":id", $id);

        if ($this->db->executa()) {
            $this->db->query("DELETE FROM posts where id = :id");
            $this->db->bind(":id", $id);
            if ($this->db->executa()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
  


    public function lerPostPorId($id){
        $this->db->query("SELECT * FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->resultado();
    }

    public function lerPostsPorCategoria($cat) {
        $this->db->query("SELECT *,
            usuarios.criado_em as usuarioData, 
            posts.criado_em as postData,
            posts.id_usuario as postIdUser,
            usuarios.id as usuarioId,
            posts.id as postId,
            usuarios.criado_em as usuarioData 
            from posts inner join usuarios
            on posts.id_usuario = usuarios.id
            where categoria = :cat
            order by posts.id desc");
        $this->db->bind(':cat',$cat);
        return $this->db->resultados();
    }


   public function lerPostsPorAutor($id) {
        $this->db->query("SELECT *,
            usuarios.criado_em as usuarioData, 
            posts.criado_em as postData,
            posts.id_usuario as postIdUser,
            usuarios.id as usuarioId,
            posts.id as postId,
            usuarios.criado_em as usuarioData 
            from posts inner join usuarios
            on posts.id_usuario = usuarios.id
            where usuarios.id = :id
            order by posts.id desc");
        $this->db->bind(':id',$id);
        return $this->db->resultados();
    }


}
