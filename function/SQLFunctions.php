<?php
/*Dispaly Error*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/config.php'); /*include file  */

function connectDB(){
        /*    always use in this way-> (HUPN);   */
  $link = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
   if($link->connect_error){
     die('connection failed: '. $link->connect_error);
   }
   /*echo "connected Successfully";*/
   return $link;
}
?>
