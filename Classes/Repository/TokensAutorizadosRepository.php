<?php

namespace Repository;

use DB\PostgreSQL;
use InvalidArgumentException;
use Util\ConstantesGenericasUtil;

class TokensAutorizadosRepository
{
    private object $PostgreSQL;
    public const TABELA = 'tokens_autorizados';

    /**
     * UsuariosRepository constructor.
     */
    public function __construct()
    {
        $this->PostgreSQL = new PostgreSQL();
    }

    /**
     * @param $token
     */
    public function validarToken($token)
    {
        $token = str_replace([' ', 'Bearer'], '', $token);

        if ($token) {
            $consultaToken = 'SELECT id FROM ' . self::TABELA . ' WHERE token = :token AND status = :status';
            $stmt = $this->getPostgreSQL()->getDb()->prepare($consultaToken);
            $stmt->bindValue(':token', $token);
            $stmt->bindValue(':status', true);
            $stmt->execute();
            if ($stmt->rowCount() !== 1) {
                header("HTTP/1.1 401 Unauthorized");
                throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_NAO_AUTORIZADO);
            }
        } else {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_TOKEN_VAZIO);
        }
    }

    /**
     * @return PostgreSQL|object
     */
    public function getPostgreSQL()
    {
        return $this->PostgreSQL;
    }
}