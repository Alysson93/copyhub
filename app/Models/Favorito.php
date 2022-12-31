<?php

class Favorito
{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }


    public function checarFavorito($user,$post) {
        $this->db->query("SELECT * from favoritos where id_usuario = :user and id_post = :post");
        $this->db->bind(":user",$user);
        $this->db->bind(":post", $post);
        return $this->db->resultado();
    }


    public function armazenar($user,$post) { 
        $this->db->query("INSERT INTO favoritos(id_usuario,id_post) VALUES (:user,:post)");

        $this->db->bind(":user",$user);
        $this->db->bind(":post", $post);

        if ($this->db->executa()) {
            return true;
        }
        else {
            return false;
        }
    }


 

    public function destruir($user,$post) {
        $this->db->query("DELETE FROM favoritos where id_usuario = :user and id_post = :post");
        $this->db->bind(":user", $user);
        $this->db->bind(":post", $post);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function lerFavoritos($user) {
        $this->db->query("SELECT posts.id, posts.titulo,posts.categoria,posts.texto,usuarios.nome from favoritos,posts,usuarios where favoritos.id_post = posts.id and usuarios.id = favoritos.id_usuario and favoritos.id_usuario = :user");
        $this->db->bind(":user",$user);
        return $this->db->resultados();
    }


}
