<?php

namespace Src\Controllers;

use Src\Models\SysTokens; // validateToken requires
use Src\Models\DailyPrograms; // Model DailyPrograms

use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;

// openweathermap

class DailyProgramsController
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
     * Fetch all Daily Program
     */
    public function getAll($headers)
    {
        #$this->validateToken($headers);
        $dailyPrograms = (new DailyPrograms())->find("deleted_at IS NULL")->fetch(true);
        $data = $dailyPrograms ? array_map(fn($dailyPrograms) => $dailyPrograms->data(), $dailyPrograms) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getAll function

    /**
     * Fetch a Daily Program by ID
     */
    public function getByID($id,$headers)
    {
        #$this->validateToken($headers);
        $dailyProgram = (new DailyPrograms())->find("dpID=:id AND deleted_at IS NULL","id={$id}")->fetch();
        if (!$dailyProgram) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Program not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($dailyProgram->data());
    } // end getById function

    /**
     * Fetch a Daily Program by UUID
     */
    public function getByUUID($uuid,$headers)
    {
        #$this->validateToken($headers);
        $dailyProgram = (new DailyPrograms())->find("dpUUID=:uuid AND deleted_at IS NULL ","uuid={$uuid}")->fetch();
        if (!$dailyProgram) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Program not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($dailyProgram->data());
    } // end getById function

    /**
     * Fetch a Daily Program by shipCode
     */
    public function getByShipCode($code,$headers)
    {
        #$this->validateToken($headers);
        $dailyPrograms = (new DailyPrograms())->find("shipCode=:ship AND deleted_at IS NULL","ship={$code}")->fetch(true);
        if (!$dailyPrograms) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Program not found"]);
            return;
        }
        $data = $dailyPrograms ? array_map(fn($dailyPrograms) => $dailyPrograms->data(), $dailyPrograms) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getById function

    /**
     * Fetch a Daily Program File by Ship
     */
    public function getFile($shipCode, $headers)
    {

        
        #$this->validateToken($headers);
        $dProgram = (new DailyPrograms())->find("shipCode=:sCode AND dpStatus=:st AND deleted_at IS NULL","sCode={$shipCode}&st=1")->fetch();
        if (!$dProgram) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Program File Not found > shipCode {$shipCode}"]);
            return;
        }
        $result = [];
        $result['file'] = $dProgram->dpFile;
        
        http_response_code(200);
        echo json_encode($result);
        
        

    } // end getDpFile function

    /**
     * Create a new Daily Program
     */
    public function create($data, $headers)
    {
        #$this->validateToken($headers);

        $dailyProgram = new DailyPrograms();
        // campos para o insert
        // dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
     
        foreach ($data as $field => $value) {
            $dailyProgram->{$field} = $data[$field] ?? null;
        }

        if (!$dailyProgram->save()) {
            if ($dailyProgram->fail()) {
                $error = $dailyProgram->fail()->getMessage();
            }
                #$error = $dailyProgram->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to create Daily Program", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Daily Program created", "dpID" => $dailyProgram->dpID]);
            return;
        }
    } // end create function

    /**
     * Update an existing Daily Program
     */
    public function update($data, $headers)
    {
        #$this->validateToken($headers);
        $id = $data['dmID'];
        unset($data['dmID']);

        $dailyProgram = (new DailyPrograms())->findById($id);
        // dmID, dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
        if (!$dailyProgram) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Program not found"]);
            return;
        }

        foreach ($data as $field => $value) {
            $dailyProgram->{$field} = $data[$field] ?? $dailyProgram->{$field};
        }

        if (!$dailyProgram->save()) {
            if ($dailyProgram->fail()) {
                $error = $dailyProgram->fail()->getMessage();
            }
                #$error = $dailyProgram->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to update Daily Program", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Daily Program updated"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to update Daily Program"]);
    } // end update function

    /**
     * Soft Delete
     */
    public function delete($id, $headers)
    {
        #$this->validateToken($headers);

        $dailyProgram = (new DailyPrograms())->findById($id);
        if (!$dailyProgram) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Program not found"]);
            return;
        }

        $dailyProgram->deleted_at = date("Y-m-d H:i:s");

        if ($dailyProgram->save()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Daily Program Soft deleted"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to Soft delete Daily Program"]);

    } // end delete function

} // end LogsController