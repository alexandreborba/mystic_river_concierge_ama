<?php

namespace Src\Controllers;

use Src\Models\SysTokens; // validateToken requires
use Src\Models\ConciergeShips; // Model ConciergeShips

// para contagem
use Src\Models\DailyPrograms; // Model ConciergeShips
use Src\Models\DailyMenus; // Model ConciergeShips
use Src\Models\Shops; // Model ConciergeShips
use Src\Models\Spas; // Model ConciergeShips

use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
// 1920 x 800 HD
// 2160 x 900 4K

// openweathermap

class ConciergeShipsController
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
     * Fetch all Ship
     */
    public function getAll($headers)
    {
        #$this->validateToken($headers);
        $ConciergeShips = (new ConciergeShips())->find("deleted_at IS NULL")->fetch(true);
        $data = $ConciergeShips ? array_map(fn($ConciergeShips) => $ConciergeShips->data(), $ConciergeShips) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getAll function

    /**
     * Fetch a Ship by ID
     */
    public function getByID($id,$headers)
    {
        #$this->validateToken($headers);
        $ship = (new ConciergeShips())->find("shipID=:id AND deleted_at IS NULL","id={$id}")->fetch();
        if (!$ship) {
            http_response_code(404);
            echo json_encode(["error" => "Ship not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($ship->data());
    } // end getById function

    /**
     * Fetch a Ship by UUID
     */
    public function getByUUID($uuid,$headers)
    {
        #$this->validateToken($headers);
        $ship = (new ConciergeShips())->find("shipUUID=:uuid AND deleted_at IS NULL ","uuid={$uuid}")->fetch();
        if (!$ship) {
            http_response_code(404);
            echo json_encode(["error" => "Ship not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($ship->data());
    } // end getById function

    /**
     * Fetch a Ship by shipCode
     */
    public function getByShipCode($code,$headers)
    {
        #$this->validateToken($headers);
        $ConciergeShips = (new ConciergeShips())->find("shipCode=:ship AND deleted_at IS NULL","ship={$code}")->fetch(true);
        if (!$ConciergeShips) {
            http_response_code(404);
            echo json_encode(["error" => "Ship not found"]);
            return;
        }
        $data = $ConciergeShips ? array_map(fn($ConciergeShips) => $ConciergeShips->data(), $ConciergeShips) : [];


        http_response_code(200);
        echo json_encode($data);
    } // end getById function

    /**
     * Fetch a Logo File by Ship
     */
    public function getLogoFile($shipCode, $headers)
    {

        #$this->validateToken($headers);
        $ship = (new ConciergeShips())->find("shipCode=:sCode AND ConciergeShipstatus=:st AND deleted_at IS NULL","sCode={$shipCode}&st=1")->fetch();
        if (!$ship) {
            http_response_code(404);
            echo json_encode(["error" => "Ship Logo File Not found"]);
            return;
        }
        $result = [];

        $result['file'] = $ship->shipFileLogo;
        
        
        http_response_code(200);
        echo json_encode($result);

    } // end getLogoFile function

    /**
     * Fetch a Logo File by Ship
     */
    public function getMenuPosition($shipCode, $headers)
    {
        // $this->validateToken($headers); // se quiser ativar depois
        $ship = (new ConciergeShips())->find("shipCode=:sCode AND ConciergeShipstatus=:st AND deleted_at IS NULL", "sCode={$shipCode}&st=1")->fetch();
    
        if (!$ship) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(["error" => "Menu Position Not found"]);
            return;
        }
    
        $result = ['position' => $ship->shipMenuPosition];
    
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Fetch a Logo File by Ship
     */
    public function getMenuItems($shipCode, $headers)
    {
        // $this->validateToken($headers);

        $iDMs   = (new DailyMenus())->find("shipCode=:sCode AND dmStatus=:st AND deleted_at IS NULL", "sCode={$shipCode}&st=1")->count();
        $iDPs   = (new DailyPrograms())->find("shipCode=:sCode AND dpStatus=:st AND deleted_at IS NULL", "sCode={$shipCode}&st=1")->count();
        $iShops = (new Shops())->find("shipCode=:sCode AND shopStatus=:st AND deleted_at IS NULL", "sCode={$shipCode}&st=1")->count();
        $iSpas  = (new Spas())->find("shipCode=:sCode AND spaStatus=:st AND deleted_at IS NULL", "sCode={$shipCode}&st=1")->count();

        if (!$iDMs && !$iDPs && !$iShops && !$iSpas) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(["error" => "Ship Menu Items Not found"]);
            return;
        }

        $items = [];

        if ($iDMs > 0) {
            $items[] = ["name" => "optDailyMenu", "label" => "Daily Menu"];
        }
        if ($iDPs > 0) {
            $items[] = ["name" => "optDailyProgram", "label" => "Daily Program"];
        }
        if ($iSpas > 0) {
            $items[] = ["name" => "optSpa", "label" => "Spa"];
        }
        if ($iShops > 0) {
            $items[] = ["name" => "optShop", "label" => "Shop"];
        }

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(["items" => $items]);
    }

        /**
     * Fetch a Image File by Ship
     */
    public function getFile($shipCode, $headers)
    {
        $shipStatus = 1;
        #$this->validateToken($headers);
        $ship = (new ConciergeShips())->find("shipCode=:sCode AND shipStatus=:st AND deleted_at IS NULL","sCode={$shipCode}&st={$shipStatus}")->fetch();
        if (!$ship) {
            http_response_code(404);
            echo json_encode(["error" => "Ship Image File Not found to {$shipCode}"]);
            return;
        }
        $result = [];

        $result['file'] = $ship->shipFileImage;
        
        
        http_response_code(200);
        echo json_encode($result);

    } // end getLogoFile function

    /**
     * Fetch a Image File by Ship
     */
    public function getImageFile($shipCode, $headers)
    {

        #$this->validateToken($headers);
        $ship = (new ConciergeShips())->find("shipCode=:sCode AND shipStatus=:st AND deleted_at IS NULL","sCode={$shipCode}&st=1")->fetch();
        if (!$ship) {
            http_response_code(404);
            echo json_encode(["error" => "Ship Image File Not found"]);
            return;
        }
        $result = [];

        $result['file'] = $ship->shipFileImage;
        
        
        http_response_code(200);
        echo json_encode($result);

    } // end getLogoFile function

    /**
     * Create a new Ship
     */
    public function create($data, $headers)
    {
        #$this->validateToken($headers);

        $ship = new ConciergeShips();
        // campos para o insert
        // dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
     
        foreach ($data as $field => $value) {
            $ship->{$field} = $data[$field] ?? null;
        }

        if (!$ship->save()) {
            if ($ship->fail()) {
                $error = $ship->fail()->getMessage();
            }
                #$error = $ship->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to create Ship", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Ship created", "shipID" => $ship->shipID]);
            return;
        }
    } // end create function

    /**
     * Update an existing Ship
     */
    public function update($data, $headers)
    {
        #$this->validateToken($headers);
        $id = $data['shipID'];
        unset($data['shipID']);

        $ship = (new ConciergeShips())->findById($id);
        // shipID, dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
        if (!$ship) {
            http_response_code(404);
            echo json_encode(["error" => "Ship not found"]);
            return;
        }

        foreach ($data as $field => $value) {
            $ship->{$field} = $data[$field] ?? $ship->{$field};
        }

        if (!$ship->save()) {
            if ($ship->fail()) {
                $error = $ship->fail()->getMessage();
            }
                #$error = $ship->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to update Ship", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Ship updated"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to update Ship"]);
    } // end update function

    /**
     * Soft Delete
     */
    public function delete($id, $headers)
    {
        #$this->validateToken($headers);

        $ship = (new ConciergeShips())->findById($id);
        if (!$ship) {
            http_response_code(404);
            echo json_encode(["error" => "Ship not found"]);
            return;
        }

        $ship->deleted_at = date("Y-m-d H:i:s");

        if ($ship->save()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Ship Soft deleted"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to Soft delete Ship"]);

    } // end delete function

} // end LogsController