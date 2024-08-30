<?php 
try{ 
define("HOST", "Localhost");
define("DBNAME", "hotel-booking");
define("USER", "root");
define("PASS", "");

$conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."", USER, PASS);

// if($conn == true){
//     echo "db connected";
// }else{
//     echo "error";
// }
}
catch(PDOException $e)
{
   echo $e->getMessage(); 
}
?>