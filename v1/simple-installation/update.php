<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../class/config/Database.php';
// instantiate object
include_once '../class/SimpleInstallation.php';
include_once '../class/auth/Authentication.php';

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);

    echo json_encode(
        array(
            "status" => 405,
            "message" => "Method Not Allowed."
        )
    );
    exit();
}


$database = new Database();
$conn = $database->getConnection();

$apiKey = isset(getallheaders()['api-secret-key']) ? getallheaders()['api-secret-key'] : null;

$auth = new Authentication($conn, $apiKey);

$user = $auth->authenticate();

if (!$user) {
    http_response_code(401);

    echo json_encode(
        array(
            "status" => 401,
            "message" => "unauthorized.",
        )
    );
    die;
}

// get posted data
$data = json_decode(file_get_contents("php://input"),true);

if (!$data || !is_array($data)){
    http_response_code(422);

    echo json_encode(
        array(
            "status" => 422,
            "message" => "Unprocessable Entity.",
        )
    );
    die;
}

$installation = new SimpleInstallation($conn, $user);
$installation->setId($_GET['id']);
$installation->set($data);
if ($installation->validate() === true){
    $installation->update();
}