<?php

namespace Repository;

use DB\PostgreSQL;
// use Service\UsuariosService;

class UsuariosRepository
{
    private object $PostgreSQL;
    const TABELA = 'usuarios';
    // const TABELA = UsuariosService::TABELA;

    /**
     * UsuariosRepository constructor.
     */
    public function __construct()
    {
        $this->PostgreSQL = new PostgreSQL();
    }

    /**
     * @param $login
     * @return int
     */
    public function getRegistroByLogin($login)
    {
        $consulta = 'SELECT * FROM ' . self::TABELA . ' WHERE login = :login';
        $stmt = $this->PostgreSQL->getDb()->prepare($consulta);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * @param $login
     * @param $senha
     * @return int
     */
    public function insertUser($login, $senha)
    {
        $consultaInsert = 'INSERT INTO ' . self::TABELA . ' (login, senha) VALUES (:login, :senha)';
        $this->PostgreSQL->getDb()->beginTransaction();
        $stmt = $this->PostgreSQL->getDb()->prepare($consultaInsert);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * @param $id
     * @param $login
     * @param $senha
     * @return int
     */
    public function updateUser($id, $dados)
    {
        $consultaUpdate = 'UPDATE ' . self::TABELA . ' SET login = :login, senha = :senha WHERE id = :id';
        $this->PostgreSQL->getDb()->beginTransaction();
        $stmt = $this->PostgreSQL->getDb()->prepare($consultaUpdate);
        $stmt->bindParam(':id', $id);
        $stmt->bindValue(':login', $dados['login']);
        $stmt->bindValue(':senha', $dados['senha']);
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * @return PostgreSQL|object
     */
    public function getPostgreSQL()
    {
        return $this->PostgreSQL;
    }
}
