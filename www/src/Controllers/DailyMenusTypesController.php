<?php

namespace Src\Controllers;

use Src\Models\SysTokens; // validateToken requires
use Src\Models\DailyMenusTypes; // Model DailyMenusTypes
use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;

// openweathermap

class DailyMenusTypesController
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
     * Fetch all Daily Menu Type
     */
    public function getAll($headers)
    {
        #$this->validateToken($headers);
        $dmTypes = (new DailyMenusTypes())->find("deleted_at IS NULL")->fetch(true);
        $data = $dmTypes ? array_map(fn($dmTypes) => $dmTypes->data(), $dmTypes) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getAll function

    /**
     * Fetch a Daily Menu Type by ID
     */
    public function getByID($id,$headers)
    {
        #$this->validateToken($headers);
        $dmType = (new DailyMenusTypes())->find("dmTypeID=:id AND deleted_at IS NULL","id={$id}")->fetch();
        if (!$dmType) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu Type not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($dmType->data());
    } // end getById function

    /**
     * Fetch a Daily Menu Type by UUID
     */
    public function getByUUID($uuid,$headers)
    {
        #$this->validateToken($headers);
        $dmType = (new DailyMenusTypes())->find("dmTypeUUID=:uuid AND deleted_at IS NULL ","uuid={$uuid}")->fetch();
        if (!$dmType) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu Type not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($dmType->data());
    } // end getById function

    /**
     * Fetch a Daily Menu Type by shipCode
     */
    public function getByShipCode($code,$headers)
    {
        #$this->validateToken($headers);
        $dmTypes = (new DailyMenusTypes())->find("shipCode=:ship AND deleted_at IS NULL","ship={$code}")->fetch(true);
        if (!$dmTypes) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu Type not found"]);
            return;
        }
        $data = $dmTypes ? array_map(fn($dmTypes) => $dmTypes->data(), $dmTypes) : [];


        http_response_code(200);
        echo json_encode($data);
    } // end getById function

    /**
     * Create a new Daily Menu Type
     */
    public function create($data, $headers)
    {
        #$this->validateToken($headers);

        $dmType = new DailyMenusTypes();
        // campos para o insert
        // dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
     
        foreach ($data as $field => $value) {
            $dmType->{$field} = $data[$field] ?? null;
        }

        if (!$dmType->save()) {
            if ($dmType->fail()) {
                $error = $dmType->fail()->getMessage();
            }
                #$error = $dmType->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to create Daily Menu Type", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Daily Menu Type created", "logID" => $dmType->dmTypeID]);
            return;
        }
    } // end create function

    /**
     * Update an existing Daily Menu Type
     */
    public function update($data, $headers)
    {
        #$this->validateToken($headers);
        $id = $data['dmTypeID'];
        unset($data['dmTypeID']);

        $dmType = (new DailyMenusTypes())->findById($id);
        // dmTypeID, dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
        if (!$dmType) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu Type not found"]);
            return;
        }

        foreach ($data as $field => $value) {
            $dmType->{$field} = $data[$field] ?? $dmType->{$field};
        }

        if (!$dmType->save()) {
            if ($dmType->fail()) {
                $error = $dmType->fail()->getMessage();
            }
                #$error = $dmType->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to update Daily Menu Type", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Daily Menu Type updated"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to update Daily Menu Type"]);
    } // end update function

    /**
     * Soft Delete
     */
    public function delete($id, $headers)
    {
        #$this->validateToken($headers);

        $dmType = (new DailyMenusTypes())->findById($id);
        if (!$dmType) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu Type not found"]);
            return;
        }

        $dmType->deleted_at = date("Y-m-d H:i:s");

        if ($dmType->save()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Daily Menu Type Soft deleted"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to Soft delete Daily Menu Type"]);

    } // end delete function

} // end LogsController