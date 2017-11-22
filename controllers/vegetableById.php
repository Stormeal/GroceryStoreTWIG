<?php
/**
 * Created by PhpStorm.
 * User: alexe
 * Date: 22-11-2017
 * Time: 21:09
 */
$uri = "http://grocerystorerest.azurewebsites.net/GroceryService.svc/vegetables/";
$id = $_POST['id'];
$jsonData = file_get_contents($uri . $id);
$vegetable = json_decode($jsonData, true);
if (empty($vegetable)){
    $vegetableArray=null;
}else{
    $vegetableArray=array($vegetable);
}


require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    // 'cache' => '/path/to/compilation_cache',
    'auto_reload' => true
));
$template = $twig->loadTemplate('vegetable.html.twig');
$parametersToTwig = array("vegetables" => $vegetableArray);
echo $template->render($parametersToTwig);