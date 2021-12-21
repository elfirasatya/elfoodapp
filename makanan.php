<?php
require_once "method.php";
$food = new Makanan();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $food->get_food($id);
         }
         else
         {
            $food->get_foods();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $food->update_food($id);
         }
         else
         {
            $food->insert_food();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            $food->delete_food($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}
?>