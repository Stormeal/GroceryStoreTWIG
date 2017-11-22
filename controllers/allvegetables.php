<?php
/**
 * Created by PhpStorm.
 * User: alexe
 * Date: 22-11-2017
 * Time: 20:30
 */

$uri = "http://grocerystorerest.azurewebsites.net/GroceryService.svc/vegetables";
$jsonData = file_get_contents($uri);
$convertToAssociativeArray = true;
$vegetables = json_decode($jsonData, $convertToAssociativeArray);


require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('vegetables.html.twig');
$parametersToTwig = array("vegetables" => $vegetables);
echo $template->render($parametersToTwig);