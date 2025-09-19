<?php

namespace Src\Controllers;

use Src\Models\SysTokens; // validateToken requires
use Src\Models\Shops; // Model shops
use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
// 1920 x 800 HD
// 2160 x 900 4K

// openweathermap

class ShopsController
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
     * Fetch all Shop
     */
    public function getAll($headers)
    {
        #$this->validateToken($headers);
        $shops = (new Shops())->find("deleted_at IS NULL")->fetch(true);
        $data = $shops ? array_map(fn($shops) => $shops->data(), $shops) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getAll function

    /**
     * Fetch a Shop by ID
     */
    public function getByID($id,$headers)
    {
        #$this->validateToken($headers);
        $shop = (new Shops())->find("shopID=:id AND deleted_at IS NULL","id={$id}")->fetch();
        if (!$shop) {
            http_response_code(404);
            echo json_encode(["error" => "Shop not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($shop->data());
    } // end getById function

    /**
     * Fetch a Shop by UUID
     */
    public function getByUUID($uuid,$headers)
    {
        #$this->validateToken($headers);
        $shop = (new Shops())->find("shopUUID=:uuid AND deleted_at IS NULL ","uuid={$uuid}")->fetch();
        if (!$shop) {
            http_response_code(404);
            echo json_encode(["error" => "Shop not found"]);
            return;
        }

        http_response_code(200);
        echo json_encode($shop->data());
    } // end getById function

    /**
     * Fetch a Shop by shipCode
     */
    public function getByShipCode($code,$headers)
    {
        #$this->validateToken($headers);
        $shops = (new Shops())->find("shipCode=:ship AND deleted_at IS NULL","ship={$code}")->fetch(true);
        if (!$shops) {
            http_response_code(404);
            echo json_encode(["error" => "Shop not found"]);
            return;
        }
        $data = $shops ? array_map(fn($shops) => $shops->data(), $shops) : [];

        http_response_code(200);
        echo json_encode($data);
    } // end getById function

    /**
     * Fetch a Daily Program by Ship
     */
    public function getFile($shipCode, $headers)
    {
        #$this->validateToken($headers);
        $shop = (new Shops())->find("shipCode=:sCode AND shopStatus=:st AND deleted_at IS NULL","sCode={$shipCode}&st=1")->fetch();
        if (!$shop) {
            http_response_code(404);
            echo json_encode(["error" => "Shop File Not found"]);
            return;
        }
        $result = [];
        $result['file'] = $shop->shopFile;
        http_response_code(200);
        echo json_encode($result);
    } // end getById function

    /**
     * Create a new Shop
     */
    public function create($data, $headers)
    {
        #$this->validateToken($headers);

        $shop = new Shops();
        // campos para o insert
        // dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
     
        foreach ($data as $field => $value) {
            $shop->{$field} = $data[$field] ?? null;
        }

        if (!$shop->save()) {
            if ($shop->fail()) {
                $error = $shop->fail()->getMessage();
            }
                #$error = $shop->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to create Shop", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Shop created", "dmID" => $shop->dmID]);
            return;
        }
    } // end create function

    /**
     * Update an existing Shop
     */
    public function update($data, $headers)
    {
        #$this->validateToken($headers);
        $id = $data['dmID'];
        unset($data['dmID']);

        $shop = (new Shops())->findById($id);
        // dmID, dmTypeUUID, shipCode, operCode, dmTypeName, dmTypeStatus
        if (!$shop) {
            http_response_code(404);
            echo json_encode(["error" => "Shop not found"]);
            return;
        }

        foreach ($data as $field => $value) {
            $shop->{$field} = $data[$field] ?? $shop->{$field};
        }

        if (!$shop->save()) {
            if ($shop->fail()) {
                $error = $shop->fail()->getMessage();
            }
                #$error = $shop->fail()->getMessage();
                http_response_code(400);
                echo json_encode(["error" => "Failed to update Shop", "message" => $error]);
        }else{
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Shopupdated"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to update Shop"]);
    } // end update function

    /**
     * Soft Delete
     */
    public function delete($id, $headers)
    {
        #$this->validateToken($headers);

        $shop = (new Shops())->findById($id);
        if (!$shop) {
            http_response_code(404);
            echo json_encode(["error" => "Shop not found"]);
            return;
        }

        $shop->deleted_at = date("Y-m-d H:i:s");

        if ($shop->save()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Shop Soft deleted"]);
            return;
        }

        http_response_code(400);
        echo json_encode(["error" => "Failed to Soft delete Shop"]);

    } // end delete function

} // end LogsController