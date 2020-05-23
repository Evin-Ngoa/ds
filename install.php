<?php
header('Content-type: text/html');

$database = include('config.php');

include('db_migrate.php');
include('db_seed.php');

 // Execute Main
 main($database);

 /**
  * Run installation scripts
  */
 function main($database){
    // Create Tables in Postgres
    echo "Creating tables in postgres! <br>";

    $createPsqlStatus = createPsqlF1F2F3F4Table($database);

    if($createPsqlStatus == 1){
         echo "Congratulations! Done Creating tables in postgres! <br>";
         
         // sleep(2);

         // Seed Tables in Postgres
         echo "Seeding data in postgres! <br>";
      
         $seedPsqlStatus = seedPsqlF1F2F3F4Table($database);

         if($seedPsqlStatus == 1){
               echo "Congratulations! Done Seeding tables in postgres! <br>";

               // sleep(2);

               // Create Tables in Mysql
               echo "Creating tables in Mysql! <br>";
         
               $createMysqlStatus = createMysqlF5F6Table($database);
         
               if($createMysqlStatus == 1){
                  
                     echo "Congratulations! Done Creating tables in Mysql! <br>";

                     // sleep(2);

                     // Seed Tables in Mysql
                     echo "Seeding data in Mysql! <br>";
                  
                     $seedMysqlStatus = seedMysqlF5F6Table($database);
                  
                     if($seedMysqlStatus == 1){
                        echo "Congratulations! Done Seeding tables in Mysql! <br>";
                     }else{
                        echo "Failed Seeding tables in Mysql! <br>";
                     }

                     echo "Success! Installation Complete! <br>";

               }else{
               echo "Failed Creating tables in Mysql! <br>";
               }

         }else{
            echo "Failed Seeding tables in postgres! <br>";
         }

    }else{
      echo "Failed Creating tables in postgres! <br>";
    }

 }
