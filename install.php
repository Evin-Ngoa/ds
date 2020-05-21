<?php
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
    echo "Creating tables in postgres!";
    sleep(1);
    createPsqlF1F2F3F4Table($database);
    sleep(1);
    echo "Done Creating tables in postgres!";
    sleep(2);

    // Seed Tables in Postgres
    echo "Seeding data in postgres!";
    sleep(1);
    seedPsqlF1F2F3F4Table($database);
    sleep(1);
    echo "Done Creating tables in postgres!";
    sleep(2);

    // Create Tables in Mysql
    echo "Creating tables in Mysql!";
    sleep(1);
    createMysqlF5F6Table($database);
    sleep(1);
    echo "Done Creating tables in Mysql!";
    sleep(2);

    // Seed Tables in Mysql
    echo "Seeding data in Mysql!";
    sleep(1);
    seedMysqlF5F6Table($database);
    sleep(1);
    echo "Done Creating tables in Mysql!";
    sleep(2);

    echo "Congratulations, Installation Complete!";

 }