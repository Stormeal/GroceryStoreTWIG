<?php
/**
 * Created by PhpStorm.
 * User: alexe
 * Date: 24-11-2017
 * Time: 14:07
 */
$id = $_POST["id"];
$name = $_POST["name"];
$type = $_POST["type"];
$price = $_POST["price"];

$data = array("Name" => $name, "Type" => $type, "Price" => $price);
$json_string = json_encode($data);

$uri = "http://grocerystorerest.azurewebsites.net/GroceryService.svc/vegetables/";
$full_uri = $uri . $id;
$ch = curl_init($full_uri);
// curl is good for more complex operations than just plain GET
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_string))
);
$jsondata = curl_exec($ch);
$theNewVegetable = json_decode($jsondata, true);

$vegetableArray = array($theNewVegetable);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('vegetables.html.twig');
$parametersToTwig = array("vegetables" => $vegetableArray);
echo $template->render($parametersToTwig);



