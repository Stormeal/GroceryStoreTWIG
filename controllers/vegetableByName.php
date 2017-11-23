<?php
/**
 * Created by PhpStorm.
 * User: alexe
 * Date: 23-11-2017
 * Time: 17:52
 */
$uri ="http://grocerystorerest.azurewebsites.net/GroceryService.svc/vegetables/";
$namefragment = $_POST['nameFragment'];
$jsondata = file_get_contents($uri . "name/" . $namefragment);
$books = json_decode($jsondata, true);


require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('vegetables.html.twig');
$parametersToTwig = array("vegetable" => $vegetables);
echo $template->render($parametersToTwig);