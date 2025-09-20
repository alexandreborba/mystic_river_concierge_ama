<?php

namespace Src\Controllers;

use Src\Models\SysTokens; // validateToken requires
use Src\Models\DailyMenusVerticais; // Model DailyMenus
use Src\Models\ConciergeShips; // Model DailyMenus

use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
// 1920 x 800 HD
// 2160 x 900 4K

// openweathermap

ini_set("display_errors", 0);
#error_reporting(E_ALL);

class DailyMenusVerticaisController
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
     * Fetch a Daily Menu Vertical by Ship
     */
    public function getFiles($shipCode, $headers)
    {
        #$this->validateToken($headers);
        $dailyMenuVerticals = (new DailyMenusVerticais())->find("shipCode=:sCode AND dmvStatus=:st AND deleted_at IS NULL","sCode={$shipCode}&st=1")->order("dmvOrder ASC")->fetch(true);
        if (!$dailyMenuVerticals) {
            $noContent = (new ConciergeShips())->find("shipCode=:sCode","sCode={$shipCode}")->fetch();
           
            $shipCode = $shipCode;
            $dmvID = $noContent->shipID ?? 0;
            $dmvUUID = $noContent->shipUUID ?? "b6573d5d-e648-4212-a951-9039b12f1273";
            $dmvDate = $noContent->updated_at ?? date("YmdHis");

            $dmvName="noContent";
            $dmTypeUUID="";

            $dmvFile = 'no_content.png';
            $dmvFileOriginal=$noContent->shipRestaurantNoContentImage ?? "no_content.png";
            $dmvFileSize=$noContent->shipRestaurantNoContentImageSize ?? "0";
            $dmvFileDimensions=$noContent->shipRestaurantNoContentImageDimensions ?? "1089 x 1920";
            $dmvOrder=1;
            $dmvStatus=1;
            $data = [
                "shipCode" => $shipCode,
                "dmvID" => $dmvID,
                "dmvUUID" => $dmvUUID,
                "dmvDate" => $dmvDate,
                "dmvName" => $dmvName,
                "dmTypeUUID" => $dmTypeUUID,
                "dmvFile" => $dmvFile,
                "dmvFileOriginal" => $dmvFileOriginal,
                "dmvFileSize" => $dmvFileSize,
                "dmvFileDimensions" => $dmvFileDimensions,
                "dmvOrder" => $dmvOrder,
                "dmvStatus" => $dmvStatus,
            ];
            $data = [$data];
            http_response_code(200);
            echo json_encode($data);
            exit;

        }
        $data = $dailyMenuVerticals ? array_map(fn($dailyMenuVerticals) => $dailyMenuVerticals->data(), $dailyMenuVerticals) : [];

        http_response_code(200);
        echo json_encode($data);
        
    } // end getDmvFile function

    /**
     * Fetch all Daily Menu
     */
    public function getAll($headers)
    {
        #$this->validateToken($headers);
        $dailyMenuVerticals = (new DailyMenusVerticais())->find("deleted_at IS NULL")->fetch(true);
        $data = $dailyMenuVerticals ? array_map(fn($dailyMenuVerticals) => $dailyMenuVerticals->data(), $dailyMenuVerticals) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getAll function

    /**
     * Fetch a Daily Menu by ID
     */
    public function getByID($id,$headers)
    {
        #$this->validateToken($headers);
        $dailyMenuVertical = (new DailyMenusVerticais())->find("dmvID=:id AND deleted_at IS NULL","id={$id}")->fetch();
        if (!$dailyMenuVertical) {
            http_response_code(404);
            echo json_encode(["error" => "Vertical Daily Menu not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($dailyMenuVertical->data());
    } // end getById function

    /**
     * Fetch a Daily Menu by UUID
     */
    public function getByUUID($uuid,$headers)
    {
        #$this->validateToken($headers);
        $dailyMenuVertical = (new DailyMenusVerticais())->find("dmvUUID=:uuid AND deleted_at IS NULL ","uuid={$uuid}")->fetch();
        if (!$dailyMenuVertical) {
            http_response_code(404);
            echo json_encode(["error" => "Vertical Daily Menu not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($dailyMenuVertical->data());
    } // end getById function

    /**
     * Fetch a Daily Menu by shipCode
     */
    public function getByShipCode($code,$headers)
    {
        #$this->validateToken($headers);
        $dailyMenuVerticals = (new DailyMenusVerticais())->find("shipCode=:ship AND deleted_at IS NULL","ship={$code}")->fetch(true);
        if (!$dailyMenuVerticals) {
            http_response_code(404);
            echo json_encode(["error" => "Daily Menu Vartical not found"]);
            return;
        }
        $data = $dailyMenuVerticals ? array_map(fn($dailyMenuVerticals) => $dailyMenuVerticals->data(), $dailyMenuVerticals) : [];


        http_response_code(200);
        echo json_encode($data);
    } // end getById function

    

    /**
     * Create a new Daily Menu
     */
    public function create($data, $headers)
    {
        #$this->validateToken($headers);

        $dailyMenuVertical = new DailyMenusVerticais();
        // campos para o insert
        // dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
     
        foreach ($data as $field => $value) {
            $dailyMenuVertical->{$field} = $data[$field] ?? null;
        }

        if (!$dailyMenuVertical->save()) {
            if ($dailyMenuVertical->fail()) {
                $error = $dailyMenuVertical->fail()->getMessage();
            }
                #$error = $dailyMenuVertical->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to create Vertical Daily Menu", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Vertical Daily Menu created", "dmvID" => $dailyMenuVertical->dmvID]);
            return;
        }
    } // end create function

    /**
     * Update an existing Vertical Daily Menu
     */
    public function update($data, $headers)
    {
        #$this->validateToken($headers);
        $id = $data['dmvID'];
        unset($data['dmvID']);

        $dailyMenuVertical = (new DailyMenusVerticais())->findById($id);
        // dmvID, dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
        if (!$dailyMenuVertical) {
            http_response_code(404);
            echo json_encode(["error" => "Vertical Daily Menu not found"]);
            return;
        }

        foreach ($data as $field => $value) {
            $dailyMenuVertical->{$field} = $data[$field] ?? $dailyMenuVertical->{$field};
        }

        if (!$dailyMenuVertical->save()) {
            if ($dailyMenuVertical->fail()) {
                $error = $dailyMenuVertical->fail()->getMessage();
            }
                #$error = $dailyMenuVertical->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to update Vertical Daily Menu", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Vertical Daily Menu updated"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to update Vertical Daily Menu"]);
    } // end update function

    /**
     * Soft Delete
     */
    public function delete($id, $headers)
    {
        #$this->validateToken($headers);

        $dailyMenuVertical = (new DailyMenusVerticais())->findById($id);
        if (!$dailyMenuVertical) {
            http_response_code(404);
            echo json_encode(["error" => "Vertical Daily Menu not found"]);
            return;
        }

        $dailyMenuVertical->deleted_at = date("Y-m-d H:i:s");

        if ($dailyMenuVertical->save()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Vertical Daily Menu Soft deleted"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to Soft delete Vertical Daily Menu"]);

    } // end delete function

} // end LogsController