<?php

class Database {

    private $dialect = DB['DIALECT'];
    private $host = DB['HOST'];
    private $usuario = DB['USUARIO'];
    private $senha = DB['SENHA'];
    private $banco = DB['BANCO'];
    private $porta = DB['PORTA'];
    private $dbh;
    private $stmt;

    public function __construct()
    {
        //fonte de dados ou DSN contém as informações necessárias para conectar ao banco de dados.
        $dsn = $this->dialect.':host='.$this->host.';port='.$this->porta.';dbname='.$this->banco;
        $opcoes = [
            //armazena em cache a conexão para ser reutilizada, evita a sobrecarga de uma nova conexão, resultando em um aplicativo mais rápido
            PDO::ATTR_PERSISTENT => true,
            //lança uma PDOException se ocorrer um erro 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            //cria a instancia do PDO
            $this->dbh = new PDO($dsn, $this->usuario, $this->senha, $opcoes);
        } catch (PDOException $e) {
            //exibe a mensagem de erro
            phpErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die();
        }
    }

    //Prepared Statements com query
    public function query($sql){
        //prepara uma consulta sql
        $this->stmt = $this->dbh->prepare($sql);
    }

    //vincula um valor a um parâmetro
    public function bind($parametro, $valor, $tipo = null){
        if(is_null($tipo)){
            switch (true):
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                break;
                default:
                $tipo = PDO::PARAM_STR;
            endswitch;
        }

        $this->stmt->bindValue($parametro, $valor, $tipo);
    }

    //executa prepared statement
    public function executa(){
        return $this->stmt->execute(); 
    }

    //obtem um único registro
    public function resultado(){
        $this->executa();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //obtem um conjunto de registros
    public function resultados(){
        $this->executa();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //retorna o número de linhas afetadas pela última instrução SQL
    public function totalResultados(){
        return $this->stmt->rowCount();
    }

    //retorna o último ID inserido no banco de dados
    public function ultimoIdInserido(){
        return $this->dbh->lastInsertId();
    }

}



