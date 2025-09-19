<?php

namespace Src\Controllers;

use Src\Models\SysTokens; // validateToken requires
use Src\Models\Spas; // Model spas
use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
// 1920 x 800 HD
// 2160 x 900 4K

// openweathermap

class SpasController
{
    /**
     * Validate Token
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

        /**
     * Fetch all Spa
     */
    public function getAll($headers)
    {
        #$this->validateToken($headers);
        $spas = (new Spas())->find("deleted_at IS NULL")->fetch(true);
        $data = $spas ? array_map(fn($spas) => $spas->data(), $spas) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getAll function

    /**
     * Fetch a Spa by ID
     */
    public function getByID($id,$headers)
    {
        #$this->validateToken($headers);
        $spa = (new Spas())->find("spaID=:id AND deleted_at IS NULL","id={$id}")->fetch();
        if (!$spa) {
            http_response_code(404);
            echo json_encode(["error" => "Spa not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($spa->data());
    } // end getById function

    /**
     * Fetch a Spa by UUID
     */
    public function getByUUID($uuid,$headers)
    {
        #$this->validateToken($headers);
        $spa = (new Spas())->find("spaUUID=:uuid AND deleted_at IS NULL ","uuid={$uuid}")->fetch();
        if (!$spa) {
            http_response_code(404);
            echo json_encode(["error" => "Spa not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($spa->data());
    } // end getById function

    /**
     * Fetch a Spa by shipCode
     */
    public function getByShipCode($code,$headers)
    {
        #$this->validateToken($headers);
        $spas = (new Spas())->find("shipCode=:ship AND deleted_at IS NULL","ship={$code}")->fetch(true);
        if (!$spas) {
            http_response_code(404);
            echo json_encode(["error" => "Spa not found"]);
            return;
        }
        $data = $spas ? array_map(fn($spas) => $spas->data(), $spas) : [];


        http_response_code(200);
        echo json_encode($data);
    } // end getById function

    /**
     * Fetch a Daily Program by Ship
     */
    public function getFile($shipCode, $headers)
    {
        #$this->validateToken($headers);
        $spa = (new Spas())->find("shipCode=:sCode AND spaStatus=:st AND deleted_at IS NULL","sCode={$shipCode}&st=1")->fetch();
        if (!$spa) {
            http_response_code(404);
            echo json_encode(["error" => "Spa File Not found"]);
            return;
        }
        $result = [];
        $result['file'] = $spa->spaFile;
        http_response_code(200);
        echo json_encode($result);
    } // end getById function

    /**
     * Create a new Spa
     */
    public function create($data, $headers)
    {
        #$this->validateToken($headers);

        $spa = new Spas();
        // campos para o insert
        // dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
     
        foreach ($data as $field => $value) {
            $spa->{$field} = $data[$field] ?? null;
        }

        if (!$spa->save()) {
            if ($spa->fail()) {
                $error = $spa->fail()->getMessage();
            }
                #$error = $spa->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to create Spa", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Spa created", "dmID" => $spa->dmID]);
            return;
        }
    } // end create function

    /**
     * Update an existing Spa
     */
    public function update($data, $headers)
    {
        #$this->validateToken($headers);
        $id = $data['dmID'];
        unset($data['dmID']);

        $spa = (new Spas())->findById($id);
        // dmID, dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
        if (!$spa) {
            http_response_code(404);
            echo json_encode(["error" => "Spa not found"]);
            return;
        }

        foreach ($data as $field => $value) {
            $spa->{$field} = $data[$field] ?? $spa->{$field};
        }

        if (!$spa->save()) {
            if ($spa->fail()) {
                $error = $spa->fail()->getMessage();
            }
                #$error = $spa->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to update Spa", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Spaupdated"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to update Spa"]);
    } // end update function

    /**
     * Soft Delete
     */
    public function delete($id, $headers)
    {
        #$this->validateToken($headers);

        $spa = (new Spas())->findById($id);
        if (!$spa) {
            http_response_code(404);
            echo json_encode(["error" => "Spa not found"]);
            return;
        }

        $spa->deleted_at = date("Y-m-d H:i:s");

        if ($spa->save()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Spa Soft deleted"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to Soft delete Spa"]);

    } // end delete function

} // end LogsController