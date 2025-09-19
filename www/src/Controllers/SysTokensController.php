<?php

namespace Src\Controllers;

use Src\Models\SysTokens;
use Ramsey\Uuid\Uuid;
use Firebase\JWT\JWT;

class SysTokensController
{

    /**
     * Validate Token by headers
     */
    private function validateToken($headers)
    {
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(["error" => "Unauthorized: Missing token"]);
            exit;
        }

        // Extrai o token do cabeçalho Authorization
        $token = str_replace("Bearer ", "", $headers['Authorization']);

        // Consulta a tabela sysTokens
        $tokenRecord = (new SysTokens())
            ->find("tokenString = :token AND tokenStatus = 1 AND deleted_at IS NULL", "token={$token}")
            ->fetch();

        if (!$tokenRecord) {
            http_response_code(401);
            echo json_encode(["error" => "Unauthorized: Invalid or inactive token"]);
            exit;
        }

        // Verifica validade do token
        $currentTime = new \DateTime();
        $startTime = new \DateTime($tokenRecord->tokenStartDateTime);
        $endTime = new \DateTime($tokenRecord->tokenEndDateTime);

        if ($currentTime < $startTime || $currentTime > $endTime) {
            http_response_code(401);
            echo json_encode(["error" => "Unauthorized: Token expired"]);
            exit;
        }

        // Token é válido
        return $tokenRecord;
    }
} // end Class SysShipsController