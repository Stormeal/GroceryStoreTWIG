<?php
/**
 * Created by PhpStorm.
 * User: alexe
 * Date: 22-11-2017
 * Time: 23:01
 */

require '../vendor/autoload.php';
use GuzzleHttp\Client;

$client = new Client();

$response = $client->request(
    'POST',
    'http://grocerystorerest.azurewebsites.net/GroceryService.svc/vegetables',
    [
        'json' => [
            'Name' => $_POST["name"],
            'Price' => $_POST["price"],
            'Type' => $_POST["type"],
        ],
    ]
);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('vegetables.html.twig');
$parametersToTwig = array("vegetables" => $response);
echo $template->render($parametersToTwig);

