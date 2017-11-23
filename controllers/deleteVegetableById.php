<?php
/**
 * Created by PhpStorm.
 * User: alexe
 * Date: 23-11-2017
 * Time: 23:32
 */

$id = $_GET["id"];

$uri = "http://grocerystorerest.azurewebsites.net/GroceryService.svc/vegetables";
$uri = $uri . "/" . $id;
echo $uri;
$ch = curl_init($uri);

// curl is good for more complex operations than just plain GET
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

$jsondata = curl_exec($ch);
$theDeletedVegetable = json_decode($jsondata, true);

// https://stackoverflow.com/questions/46553921/how-to-move-from-current-php-page-to-another-php-page-if-condition-true
$host = $_SERVER['HTTP_HOST'];
header("Location: http://{$host}/GroceryStoreTWIG/controllers/allvegetables.php");
return;