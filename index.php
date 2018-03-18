<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Application\Service\Api\ApiRouter;
use Application\Service\Api\ApiRouterDto;
use Application\Service\Config\RequestMethod;

require_once "vendor/autoload.php";

$dto = new ApiRouterDto();
$dto->setRequestUri($_SERVER['REQUEST_URI']);
$dto->setRequestParams(
    array_merge(
        $_GET,
        $_POST,
        $_REQUEST
    )
);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $dto->setRequestMethod(RequestMethod::POST);
        break;
    case 'PUT':
        $dto->setRequestMethod(RequestMethod::PUT);
        break;
    case 'DELETE':
        $dto->setRequestMethod(RequestMethod::DELETE);
        break;
    default:
        $dto->setRequestMethod(RequestMethod::GET);
}

$apiRouter = new ApiRouter();

$apiRouter->run($dto);


