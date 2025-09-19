<?php
require_once "../vendor/autoload.php";
include_once "../src/Functions.php";
include_once "../src/Parameters.php";
include_once "../src/RouterConfig.php"; // $tablesRef
ini_set("display_errors", 0);

// Função auxiliar para retornar erro 404
function sendNotFound($table = null, $methodName = null, $controller = null)
{
    http_response_code(404);
    echo json_encode(["error" => "Route not found","data" => ["table"=>$table, "method"=>$methodName]]);
    //return false;
}

// Função auxiliar para retornar erro 500
function sendError($message)
{
    http_response_code(500);
    echo json_encode(["error" => $message]);
    //return false;
}

// Captura a URI e método
$uri = trim($_SERVER['REQUEST_URI'], '/'); // Remove barras extras
$method = $_SERVER['REQUEST_METHOD'];
$headers = getallheaders();
$input = json_decode(file_get_contents('php://input'), true);

# Separa os segmentos da URI
$segments = explode('/', $uri);
#echo sizeof($segments).BR;

# Verifica se há pelo menos dois segmentos (ex.: concierge/slides)
/*
if (sizeof($segments) < 2) {
    sendNotFound();
}
*/

// Extrai o nome do controlador e do método
$table = f_lower($segments[1]); // Primeiro segmento: nome da tabela
$methodName = $segments[2] ?? null; // Segundo segmento: nome do método ou ID

#echo 'table : '.$table.BR;
#echo 'method : '.$methodName.BR;


// Mapeia o controlador com base na tabela
$controllerClass = "Src\\Controllers\\".$tablesRef[$table]."Controller";

$critery = $segments[3] ?? null;

//echo $critery;exit;

//echo 'controller : '.$controllerClass.BR.BR;

// Verifica se o controlador existe
if (!class_exists($controllerClass)) {
    sendNotFound($table, $methodName, $controllerClass);
}

// Instancia o controlador
$controller = new $controllerClass();

// Verifica se o método existe no controlador
if ($methodName && !method_exists($controller, $methodName)) {
    sendNotFound($table, $methodName, $controllerClass);
}

// Executa o método correspondente
try {
    if ($methodName) {
        // Se o método exige um parâmetro (ex.: ID ou input)
        if (in_array($method, ['GET', 'DELETE']) && isset($critery)) {
            $result = $controller->$methodName($critery, $headers);
        } elseif (in_array($method, ['POST', 'PUT'])) {
            $result = $controller->$methodName($input, $headers);
        } else {
            $result = $controller->$methodName($headers);
        }
    } else {
        // Se nenhum método foi especificado
        sendNotFound($table, $methodName, $controllerClass);
    }

    // Retorna a resposta
    //echo json_encode($result);
} catch (\Exception $e) {
    sendError($e->getMessage());
}