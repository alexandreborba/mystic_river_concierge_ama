<?php

namespace Src\Controllers;

use Src\Models\SysTokens; // validateToken requires
use Src\Models\DailyMenus; // Model DailyMenus

use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
// 1920 x 800 HD
// 2160 x 900 4K

// openweathermap

class DailyMenusController
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
     * Fetch all Daily Menu
     */
    public function getAll($headers)
    {
        #$this->validateToken($headers);
        $dailyMenus = (new DailyMenus())->find("deleted_at IS NULL")->fetch(true);
        $data = $dailyMenus ? array_map(fn($dailyMenus) => $dailyMenus->data(), $dailyMenus) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getAll function

    /**
     * Fetch a Daily Menu by ID
     */
    public function getByID($id,$headers)
    {
        #$this->validateToken($headers);
        $dailyMenu = (new DailyMenus())->find("dmID=:id AND deleted_at IS NULL","id={$id}")->fetch();
        if (!$dailyMenu) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($dailyMenu->data());
    } // end getById function

    /**
     * Fetch a Daily Menu by UUID
     */
    public function getByUUID($uuid,$headers)
    {
        #$this->validateToken($headers);
        $dailyMenu = (new DailyMenus())->find("dmUUID=:uuid AND deleted_at IS NULL ","uuid={$uuid}")->fetch();
        if (!$dailyMenu) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($dailyMenu->data());
    } // end getById function

    /**
     * Fetch a Daily Menu by shipCode
     */
    public function getByShipCode($code,$headers)
    {
        #$this->validateToken($headers);
        $dailyMenus = (new DailyMenus())->find("shipCode=:ship AND deleted_at IS NULL","ship={$code}")->fetch(true);
        if (!$dailyMenus) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu not found"]);
            return;
        }
        $data = $dailyMenus ? array_map(fn($dailyMenus) => $dailyMenus->data(), $dailyMenus) : [];


        http_response_code(200);
        echo json_encode($data);
    } // end getById function

    /**
     * Fetch a Daily Program by Ship
     */
    public function getFile($shipCode, $headers)
    {

        #$this->validateToken($headers);
        $dMenu = (new DailyMenus())->find("shipCode=:sCode AND dmStatus=:st AND deleted_at IS NULL","sCode={$shipCode}&st=1")->fetch();
        if (!$dMenu) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu File Not found"]);
            return;
        }
        $result = [];


        $result['file'] = $dMenu->dmFile;
        
        
        http_response_code(200);
        echo json_encode($result);

    } // end getById function

    /**
     * Create a new Daily Menu
     */
    public function create($data, $headers)
    {
        #$this->validateToken($headers);

        $dailyMenu = new DailyMenus();
        // campos para o insert
        // dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
     
        foreach ($data as $field => $value) {
            $dailyMenu->{$field} = $data[$field] ?? null;
        }

        if (!$dailyMenu->save()) {
            if ($dailyMenu->fail()) {
                $error = $dailyMenu->fail()->getMessage();
            }
                #$error = $dailyMenu->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to create Daily Menu", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Daily Menu created", "dmID" => $dailyMenu->dmID]);
            return;
        }
    } // end create function

    /**
     * Update an existing Daily Menu
     */
    public function update($data, $headers)
    {
        #$this->validateToken($headers);
        $id = $data['dmID'];
        unset($data['dmID']);

        $dailyMenu = (new DailyMenus())->findById($id);
        // dmID, dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
        if (!$dailyMenu) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu not found"]);
            return;
        }

        foreach ($data as $field => $value) {
            $dailyMenu->{$field} = $data[$field] ?? $dailyMenu->{$field};
        }

        if (!$dailyMenu->save()) {
            if ($dailyMenu->fail()) {
                $error = $dailyMenu->fail()->getMessage();
            }
                #$error = $dailyMenu->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to update Daily Menu", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Daily Menu updated"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to update Daily Menu"]);
    } // end update function

    /**
     * Soft Delete
     */
    public function delete($id, $headers)
    {
        #$this->validateToken($headers);

        $dailyMenu = (new DailyMenus())->findById($id);
        if (!$dailyMenu) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu not found"]);
            return;
        }

        $dailyMenu->deleted_at = date("Y-m-d H:i:s");

        if ($dailyMenu->save()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Daily Menu Soft deleted"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to Soft delete Daily Menu"]);

    } // end delete function

} // end LogsController